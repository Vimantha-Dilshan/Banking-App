<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customer_account_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_account_id')->constrained('customer_accounts');
            $table->enum('transaction_type', ['DEPOSIT', 'WITHDRAWAL', 'TRANSFER', 'FEE', 'INTEREST', 'ADJUSTMENT']);
            $table->enum('transaction_mode', ['IN', 'OUT']);
            $table->timestamp('transaction_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->decimal('amount', 15, 2);
            $table->decimal('balance_after_transaction', 15, 2);
            $table->string('reference_number', 255)->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', ['PENDING', 'COMPLETED', 'FAILED'])->default('COMPLETED');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_account_transactions');
    }
};
