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
        Schema::create('system_users', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('email')->unique();
            $table->string('username')->nullable()->unique();
            $table->string('prefix')->nullable();
            $table->string('name')->nullable();
            $table->string('password')->nullable();
            $table->string('provider')->nullable();
            $table->string('picture_url')->nullable();
            $table->string('provider_token')->nullable();
            $table->string('token');
            $table->string('unit');
            // $table->string('updated_at');
            // $table->string('created_at');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_users');
    }
};
