<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {

            // Link subscription
            $table->foreignId('subscription_id')
                ->nullable()
                ->after('order_id')
                ->constrained()
                ->nullOnDelete();

            // Stripe invoice
            $table->string('stripe_invoice_id')
                ->nullable()
                ->after('stripe_payment_intent_id');

            // One time or subscription
            $table->enum('payment_type', [
                'one_time',
                'subscription'
            ])->default('one_time')
              ->after('currency');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {

            $table->dropForeign(['subscription_id']);

            $table->dropColumn([
                'subscription_id',
                'stripe_invoice_id',
                'payment_type'
            ]);
        });
    }
};
