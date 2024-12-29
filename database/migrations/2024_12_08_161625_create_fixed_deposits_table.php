<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fixed_deposits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained();
            $table->decimal('deposit_amount', 15, 2);
            $table->decimal('interest_rate', 5, 2);
            $table->enum('deposit_term', ['6 MONTHS', '1 YEAR', '2 YEARS', '3 YEARS', '5 YEARS']);
            $table->enum('status', ['ACTIVE', 'MATURED', 'WITHDRAWN', 'CLOSED']);
            $table->date('start_date');
            $table->date('maturity_date');
            $table->decimal('maturity_amount', 15, 2);
            $table->boolean('closed')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fixed_deposits');
    }
};
