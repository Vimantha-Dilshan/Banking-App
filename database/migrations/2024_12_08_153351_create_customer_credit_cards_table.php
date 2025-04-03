<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customer_credit_cards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->index();
            $table->string('card_number')->unique()->index();
            $table->enum('card_type', ['VISA', 'MASTERCARD', 'AMEX', 'DISCOVER', 'MAESTRO', 'JCB']);
            $table->enum('status', ['ACTIVE', 'INACTIVE', 'SUSPENDED', 'CLOSED'])->default('ACTIVE');
            $table->decimal('credit_limit', 15, 2)->index();
            $table->decimal('available_credit', 15, 2)->index();
            $table->decimal('outstanding_balance', 15, 2)->default(0)->index();
            $table->decimal('interest_rate', 5, 2)->index();
            $table->string('expiry_date')->index();
            $table->string('cardholder_name')->index();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('credit_cards');
    }
};
