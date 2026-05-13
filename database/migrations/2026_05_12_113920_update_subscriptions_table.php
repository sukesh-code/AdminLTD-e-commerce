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
        Schema::table('subscriptions', function (Blueprint $table) {

            // Plan relation
            $table->foreignId('plan_id')
                ->nullable()
                ->after('user_id')
                ->constrained()
                ->nullOnDelete();

            // Plan name snapshot
            $table->string('plan_name')
                ->nullable()
                ->after('stripe_price_id');

            // Trial support
            $table->timestamp('trial_ends_at')
                ->nullable()
                ->after('current_period_end');

            // Cancelled time
            $table->timestamp('cancelled_at')
                ->nullable()
                ->after('cancel_at_period_end');

            // Subscription fully ended
            $table->timestamp('ends_at')
                ->nullable()
                ->after('cancelled_at');

            // Improve status enum
            $table->enum('status', [
                'active',
                'trialing',
                'past_due',
                'cancelled',
                'unpaid',
                'incomplete',
                'paused'
            ])->default('active')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subscriptions', function (Blueprint $table) {

            $table->dropForeign(['plan_id']);

            $table->dropColumn([
                'plan_id',
                'plan_name',
                'trial_ends_at',
                'cancelled_at',
                'ends_at',
            ]);
        });
    }
};
