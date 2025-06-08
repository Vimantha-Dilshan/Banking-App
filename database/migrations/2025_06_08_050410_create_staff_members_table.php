<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('staff_members', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('nic')->unique();
            $table->date('date_of_birth');
            $table->enum('gender', ['MALE', 'FEMALE', 'OTHER']);
            $table->string('position');
            $table->string('department');
            $table->unsignedBigInteger('branch_id');
            $table->enum('status', ['ACTIVE', 'INACTIVE', 'SUSPENDED']);
            $table->date('date_joined');
            $table->date('date_left')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('staff_members');
    }
};
