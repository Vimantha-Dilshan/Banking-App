<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->enum('salutation', ['MR', 'MISS', 'MRS', 'REV'])->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('occupation')->nullable();
            $table->string('employer_name')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('national_id')->unique();
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->string('city');
            $table->string('postal_code')->nullable();
            $table->string('province')->nullable();
            $table->string('country')->default('Sri Lanka');
            $table->date('date_of_birth');
            $table->enum('gender', ['MALE', 'FEMALE', 'OTHER']);
            $table->boolean('is_vip')->default(false);
            $table->boolean('disabled')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
