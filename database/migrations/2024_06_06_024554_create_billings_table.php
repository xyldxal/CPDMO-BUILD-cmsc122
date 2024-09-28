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
        Schema::create('billings', function (Blueprint $table) {
            $table->increments('billing_id');
            
            $table->unsignedInteger('project_id');

            $table->foreign('project_id')
                ->references('project_id')
                ->on('projects')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->double('total_billings')->nullable();
            $table->float('billing_percentage')->nullable();
            $table->double('billed_variation_orders')->nullable();
            $table->double('awarded')->nullable();
            $table->float('percent_savings')->nullable();
            $table->date('as_of')->nullable();
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
        Schema::dropIfExists('billings');
    }
};
