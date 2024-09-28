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
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('activity_id');
            $table->unsignedInteger('project_id');

            $table->foreign('project_id')
                ->references('project_id')
                ->on('projects')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->date('suspension_date')->nullable();
            $table->date('resumption_date_resumed')->nullable();
            $table->date('resumption_revised_completion_date')->nullable();
            $table->date('extension_date')->nullable();
            $table->integer('extension_duration')->nullable();
            $table->integer('revised_contract_duration')->nullable();
            $table->string('reason')->nullable();
            $table->date('end_of_contract_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
};
