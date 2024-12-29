<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('credit_cards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->string('card_number')->unique();
            $table->enum('card_type', ['VISA', 'MASTERCARD', 'AMEX', 'DISCOVER', 'MAESTRO', 'JCB']);
            $table->enum('status', ['ACTIVE', 'INACTIVE', 'SUSPENDED', 'CLOSED'])->default('ACTIVE');
            $table->decimal('credit_limit', 15, 2);
            $table->decimal('available_credit', 15, 2);
            $table->decimal('outstanding_balance', 15, 2)->default(0);
            $table->decimal('interest_rate', 5, 2);
            $table->string('expiry_date');
            $table->string('cardholder_name');
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
