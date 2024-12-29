<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('account_types', function (Blueprint $table) {
            $table->id();
            $table->string('account_name');
            $table->enum('category', ['KIDS', 'TEEN', 'COMMERCIAL']);
            $table->string('currency', 3);
            $table->text('description')->nullable();
            $table->enum('status', ['A', 'I', 'P'])->default('A');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('account_types');
    }
};
