<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stripe_webhooks', function (Blueprint $table) {
            $table->id();

            $table->string('event_id')->unique();
            $table->string('event_type');

            $table->json('payload');

            $table->boolean('processed')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stripe_webhooks');
    }
};
