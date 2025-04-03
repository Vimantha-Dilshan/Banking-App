<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mastercard_credit_cards', function (Blueprint $table) {
            $table->id();
            $table->string('card_number', 20)->unique()->index();
            $table->date('expiry_date')->index();
            $table->string('cvv', 10);
            $table->enum('status', ['AVAILABLE', 'ALLOCATED', 'EXPIRED', 'BLOCKED'])->default('AVAILABLE');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mastercard_credit_cards');
    }
};
