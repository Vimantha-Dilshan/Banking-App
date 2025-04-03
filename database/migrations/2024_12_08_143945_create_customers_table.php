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
            $table->enum('salutation', ['MR', 'MISS', 'MRS', 'REV'])->nullable()->index();
            $table->string('first_name')->index();
            $table->string('last_name')->index();
            $table->string('occupation')->nullable()->index();
            $table->string('employer_name')->nullable()->index();
            $table->string('email')->unique()->index();
            $table->string('phone')->nullable()->index();
            $table->string('national_id')->unique()->index();
            $table->string('address_line_1')->index();
            $table->string('address_line_2')->nullable()->index();
            $table->string('city')->index();
            $table->string('postal_code')->nullable()->index();
            $table->string('province')->nullable()->index();
            $table->string('country')->default('Sri Lanka')->index();
            $table->date('date_of_birth')->index();
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
