<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('change_orders', function (Blueprint $table) {
            $table->increments('change_order_id');
            $table->unsignedInteger('project_id');

            $table->foreign('project_id')
                ->references('project_id')
                ->on('projects')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->integer('change_order_number')->nullable();
            $table->double('amount')->nullable();
            $table->string('notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('change_orders');
    }
};
