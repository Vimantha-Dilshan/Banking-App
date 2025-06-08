<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('credit_card_billings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('card_id');
            $table->unsignedBigInteger('customer_id');
            $table->smallInteger('last_billed_year');
            $table->tinyInteger('last_billed_month');
            $table->enum('billing_status', ['SUCCESS', 'FAILED'])->default('FAILED');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('credit_card_billings');
    }
};
