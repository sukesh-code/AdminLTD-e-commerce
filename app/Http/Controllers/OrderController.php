<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CheckoutSession;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\ProductVariant; // if you have it
use App\Models\StripeWebhook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Stripe\Webhook;
use Stripe\PaymentIntent;

class OrderController extends Controller
{

    // {
    //     $user = Auth::user();

    //     $cart = Cart::where('user_id', $user->id)->get();

    //     if ($cart->isEmpty()) {
    //         return redirect()->route('e-commerce-page');
    //     }

    //     Stripe::setApiKey(config('stripe.secret_key'));


    //     $totalAmount = $cart->sum(fn($item) => $item->price * $item->quantity);

    //     $order = Order::create([
    //         'user_id' => $user->id,
    //         'order_address' => 'Default Address',
    //         'final_discount' => 0,
    //         'final_tax' => 0,
    //         'final_amount' => $totalAmount,
    //         'status' => 'pending',
    //     ]);

    //     //  Stripe line items
    //     $line_items = [];

    //     foreach ($cart as $item) {
    //           $product = ProductVariant::find($item->variant_id)?->product_rel;
    //         $line_items[] = [
    //             'price_data' => [
    //                 'currency' => 'inr',
    //                 'product_data' => [
    //                     'name' => 'Variant ID: ' . $item->variant_id,
    //                     'images' => [$product->thumbnail_url ?? null],
    //                 ],
    //                 'unit_amount' => $item->price * 100,
    //             ],
    //             'quantity' => $item->quantity,
    //         ];
    //     }

    //     //  Stripe session create
    //     $session = Session::create([
    //         'payment_method_types' => ['card'],
    //         'line_items' => $line_items,
    //         'mode' => 'payment',

    //         'customer'=>$user->stripe_customer_id,

    //         //  ORDER ID pass kar rahe hai
    //         'client_reference_id' => $order->id,
    //         'allow_promotion_codes' => true,

    //         'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
    //         'cancel_url' => route('stripe.cancel'),
    //     ]);

    //     //  checkout_sessions save
    //     CheckoutSession::create([
    //         'order_id' => $order->id,
    //         'stripe_session_id' => $session->id,
    //         'status' => 'pending',
    //         'success_url' => route('stripe.success'),
    //         'cancel_url' => route('stripe.cancel'),
    //     ]);

    //     return redirect($session->url);
    // }

    public function OrderCheckout()
    {
        $user = Auth::user();

        // Eager Loading
        $cart = Cart::with([
            'variant.product',
            'variant.attributes.attributeValue'
        ])->where('user_id', $user->id)->get();



        // Empty cart check
        if ($cart->isEmpty()) {
            return redirect()->route('e-commerce-page');
        }

        Stripe::setApiKey(config('stripe.secret_key'));

        // Total Amount
        $totalAmount = $cart->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        // Create Order
        $order = Order::create([
            'user_id' => $user->id,
            'order_address' => 'Default Address',
            'final_discount' => 0,
            'final_tax' => 0,
            'final_amount' => $totalAmount,
            'status' => 'pending',
        ]);

        // Stripe Line Items
        $line_items = [];

        foreach ($cart as $item) {


            // Product
            $product = $item->variant?->product;

            $productData = [
                'name' => $product->name ?? 'Product',
            ];



            if ($product && !empty($product->product_image)) {

                $imageUrl = asset('storage/' . $product->product_image);

                // Add only if valid
                if (!empty($imageUrl)) {
                    $productData['images'] = [$imageUrl];
                }
            }

            $line_items[] = [
                'price_data' => [
                    'currency' => 'inr',

                    'product_data' => [
                        'name' => $product->name ?? 'Product',
                        'images' => !empty($imageUrl) ? [$imageUrl] : [],
                    ],

                    'unit_amount' => (int) ($item->price * 100),
                ],

                'quantity' => $item->quantity,
            ];
        }

        // Stripe Checkout Session
        $session = Session::create([

            'payment_method_types' => ['card'],

            'line_items' => $line_items,

            'mode' => 'payment',

            'customer' => $user->stripe_customer_id,

            // Order ID
            'client_reference_id' => $order->id,

            'allow_promotion_codes' => true,

            'success_url' => route('stripe.success') .
                '?session_id={CHECKOUT_SESSION_ID}',

            'cancel_url' => route('stripe.cancel'),
        ]);

        // Save Checkout Session
        CheckoutSession::create([
            'order_id' => $order->id,
            'stripe_session_id' => $session->id,
            'status' => 'pending',
            'success_url' => route('stripe.success'),
            'cancel_url' => route('stripe.cancel'),
        ]);

        return redirect($session->url);
    }
    // ================= WEBHOOK =================
    public function handleWebhook(Request $request)
    {
        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');
        $endpoint_secret = config('stripe.webhook_secret');

        try {
            $event = Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
        } catch (\Exception $e) {
            Log::error('Webhook signature failed');
            return response('Invalid', 400);
        }

        //  Duplicate webhook रोकना
        if (StripeWebhook::where('event_id', $event->id)->exists()) {
            return response('Already processed', 200);
        }

        StripeWebhook::create([
            'event_id' => $event->id,
            'event_type' => $event->type,
            'payload' => json_encode($event),
            'processed' => 1,
        ]);

        // ================= PAYMENT SUCCESS =================
        if ($event->type === 'checkout.session.completed') {

            $session = $event->data->object;

            if ($session->payment_status !== 'paid') {
                return response('Payment not completed', 200);
            }

            // ORDER ID directly mil raha hai
            $orderId = $session->client_reference_id;

            $order = Order::find($orderId);

            if (!$order) {
                return response('Order not found', 404);
            }

            DB::beginTransaction();

            try {

                $cartItems = Cart::where('user_id', $order->user_id)->get();

                //  Order items save
                foreach ($cartItems as $item) {

                    OrderDetail::create([
                        'order_id' => $order->id,
                        'variant_id' => $item->variant_id,
                        'order_quantity' => $item->quantity,
                        'price_per_unit' => $item->price,
                        'discount' => 0,
                        'tax' => 0,
                    ]);

                    // stock update
                    $stock = \App\Models\ProductInventory::where('variant_id', $item->variant_id)
                        ->lockForUpdate()
                        ->first();

                    if ($stock && $stock->quantity >= $item->quantity) {
                        $stock->quantity -= $item->quantity;
                        $stock->save();
                    } else {
                        throw new \Exception('Stock issue');
                    }
                }

                //  Order update
                $order->update([
                    'status' => 'paid',
                    'final_amount' => $session->amount_total / 100
                ]);

                //  checkout_sessions update
                CheckoutSession::where('stripe_session_id', $session->id)
                    ->update(['status' => 'completed']);

                //  Payment save
                Payment::create([
                    'order_id' => $order->id,
                    'stripe_session_id' => $session->id,
                    'stripe_payment_intent_id' => $session->payment_intent,
                    'amount' => $session->amount_total / 100,
                    'currency' => $session->currency,
                    'status' => 'paid',
                    'payment_method' => 'card',
                    'paid_at' => now(),
                ]);

                //  cart clear
                Cart::where('user_id', $order->user_id)->delete();

                DB::commit();

                Log::info('Order completed: ' . $order->id);
            } catch (\Exception $e) {

                DB::rollBack();
                Log::error('Webhook error: ' . $e->getMessage());

                return response('Error', 500);
            }
        }

        return response('Webhook handled', 200);
    }

    // ================= SUCCESS =================

    public function stripeSuccess(Request $request)
    {
        $sessionId = $request->get('session_id');

        if (!$sessionId) {
            return redirect()->route('user.order.page')
                ->with('error', 'Session not found');
        }

        $checkout = CheckoutSession::where('stripe_session_id', $sessionId)->first();

        if (!$checkout) {
            return redirect()->route('user.order.page')
                ->with('error', 'Order not found');
        }

        return redirect()->route('invoice.page', $checkout->order_id);
    }

    // ================= CANCEL =================
    public function stripeCancel()
    {
        return redirect()->route('view.cart.page')
            ->with('error', 'Payment cancelled');
    }

    // ================= USER ORDERS =================
    public function userOrders()
    {
        $orders = Order::with(['orderDetails_rel.product', 'user_rel'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('e-commerce.user.user-order', compact('orders'));
    }

    public function updateStatus(Request $request)
    {

        $request->validate([
            'status' => 'required|in:pending,delivered,cancelled,Out for Delivery,'
        ]);
        $order = Order::find($request->order_id);

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        $order->status = $request->status;
        $order->save();

        return response()->json(['success' => true]);
    }
}
