<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Stripe\Subscription;
use Stripe\Webhook;

class SubscriptionController extends Controller
{


    public function subscribe(Request $request)
    {
        $user = auth()->user();

        Stripe::setApiKey(config('stripe.secret_key'));

        // 1. create Stripe customer if not exists
        if (!$user->stripe_customer_id) {
            $customer = \Stripe\Customer::create([
                'email' => $user->email,
                'name' => $user->name,
            ]);

            $user->update([
                'stripe_customer_id' => $customer->id
            ]);
        }

        // 2. get price based on plan (NOW SIMPLE HARD CODE)
        $price = $request->plan === 'pro'
            ? 'price_xxx_pro_month'
            : 'price_xxx_pro_year';

        // 3. create subscription checkout
        $session = Session::create([
            'mode' => 'subscription',
            'customer' => $user->stripe_customer_id,

            'payment_method_types' => ['card', 'upi'],

            'line_items' => [[
                'price' => $price,
                'quantity' => 1,
            ]],

            'success_url' => route('subscription.success'),
            'cancel_url' => route('subscription.cancel'),
        ]);

        return redirect($session->url);
    }

    public function handle(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $secret = config('stripe.webhook_secret');

        try {
            $event = Webhook::constructEvent(
                $payload,
                $sigHeader,
                $secret
            );
        } catch (\Exception $e) {
            Log::error('Webhook Error: ' . $e->getMessage());
            return response('Invalid', 400);
        }

        // ==============================
        // 1. SUBSCRIPTION CREATED
        // ==============================
        if ($event->type === 'customer.subscription.created') {

            $sub = $event->data->object;

            Subscription::updateOrCreate(
                [
                    'stripe_subscription_id' => $sub->id
                ],
                [
                    'user_id' => $this->getUserId($sub->customer),

                    'stripe_customer_id' => $sub->customer,
                    'stripe_price_id' => $sub->items->data[0]->price->id,

                    'status' => $sub->status,

                    'current_period_start' => date('Y-m-d H:i:s', $sub->current_period_start),
                    'current_period_end' => date('Y-m-d H:i:s', $sub->current_period_end),

                    'cancel_at_period_end' => $sub->cancel_at_period_end,
                ]
            );
        }

        // ==============================
        // 2. SUBSCRIPTION UPDATED (renew / cancel)
        // ==============================
        if ($event->type === 'customer.subscription.updated') {

            $sub = $event->data->object;

            Subscription::where('stripe_subscription_id', $sub->id)
                ->update([
                    'status' => $sub->status,
                    'current_period_end' => date('Y-m-d H:i:s', $sub->current_period_end),
                    'cancel_at_period_end' => $sub->cancel_at_period_end,
                ]);
        }

        // ==============================
        // 3. SUBSCRIPTION DELETED
        // ==============================
        if ($event->type === 'customer.subscription.deleted') {

            $sub = $event->data->object;

            Subscription::where('stripe_subscription_id', $sub->id)
                ->update([
                    'status' => 'canceled'
                ]);
        }

        return response('success', 200);
    }

    // helper function (simple mapping)
    private function getUserId($stripeCustomerId)
    {
        return \App\Models\User::where('stripe_customer_id', $stripeCustomerId)
            ->value('id');
    }
}
