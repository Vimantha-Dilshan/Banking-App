<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customer_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->index();
            $table->foreignId('account_id')->constrained('account_types');
            $table->string('account_number')->index();
            $table->enum('status', ['A', 'I', 'P'])->default('A');
            $table->decimal('balance', 15, 2)->index();
            $table->string('branch')->nullable()->index();
            $table->date('start_date')->index();
            $table->date('deactivation_date')->nullable()->index();
            $table->text('deactivation_reason')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_accounts');
    }
};
