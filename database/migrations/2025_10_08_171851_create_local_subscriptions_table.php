<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('subscriptions_local', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->string('stripe_subscription_id')->nullable();
            $table->string('stripe_customer_id')->nullable();
            $table->string('price_id')->nullable();
            $table->string('status')->nullable();
            $table->timestamp('current_period_end')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('subscriptions_local');
    }
};
