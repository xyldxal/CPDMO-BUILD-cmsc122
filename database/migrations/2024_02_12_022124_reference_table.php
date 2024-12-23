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
        Schema::create('reference_table', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('prefix')->nullable();
            $table->string('token')->nullable();
            $table->string('unit')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reference_table');
    }
};
