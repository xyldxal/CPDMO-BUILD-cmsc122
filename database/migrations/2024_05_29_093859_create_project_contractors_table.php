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
        Schema::create('project_contractors', function (Blueprint $table) {
            $table->increments('project_contractor_id');
            $table->unsignedInteger('project_id');

            $table->foreign('project_id')
                ->references('project_id')
                ->on('projects')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('daed_contractor')->nullable();
            $table->string('construction_contractor')->nullable();
            $table->string('construction_manager')->nullable();
            $table->double('contract_amount')->nullable();
            $table->string('contractor')->nullable();
            $table->date('contract_completion_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_contractors');
    }
};
