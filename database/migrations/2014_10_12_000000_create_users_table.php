<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('image')->nullable();
            $table->unsignedBigInteger('role_id')->default(2);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('is_verified')->default(0);
            $table->string('otp')->nullable();
            $table->boolean('status')->default(true);
            $table->string('expire_otp')->nullable();
            $table->string('token')->nullable();
            $table->timestamp('last_activity')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
