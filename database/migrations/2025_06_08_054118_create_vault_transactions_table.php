<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vault_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id');
            $table->foreignId('vault_id');
            $table->enum('transaction_type', ['IN', 'OUT']);
            $table->decimal('amount', 15, 2);
            $table->decimal('balance_after', 15, 2);
            $table->string('reason');
            $table->text('description')->nullable();
            $table->string('reference_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable(); // Optional foreign key if users table exists
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vault_transactions');
    }
};
