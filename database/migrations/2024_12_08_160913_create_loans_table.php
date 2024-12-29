<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained();
            $table->decimal('loan_amount', 15, 2);
            $table->decimal('interest_rate', 5, 2);
            $table->enum('loan_type', ['PERSONAL', 'MORTGAGE', 'CAR', 'STUDENT', 'BUSINESS']);
            $table->enum('status', ['PENDING', 'APPROVED', 'REJECTED', 'COMPLETED']);
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('monthly_repayment', 15, 2);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
