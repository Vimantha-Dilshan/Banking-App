<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customer_debit_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained();
            $table->string('linked_account')->index();
            $table->string('card_number')->unique()->index();
            $table->enum('card_type', ['VISA', 'MASTERCARD', 'AMEX', 'DISCOVER', 'MAESTRO', 'JCB']);
            $table->enum('status', ['ACTIVE', 'INACTIVE', 'SUSPENDED', 'CLOSED']);
            $table->string('expiry_date')->index();
            $table->string('cardholder_name')->index();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('debit_cards');
    }
};
