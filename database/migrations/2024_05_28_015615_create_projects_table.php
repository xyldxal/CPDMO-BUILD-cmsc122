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
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('project_id');

            $table->string('tracking_number')->nullable();

            $table->foreign('tracking_number')
                ->references('tracking_number')
                ->on('ovcpd_tracked_projects')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('project_title')->nullable();
            $table->string('project_description')->nullable();

            $table->string('college_unit')->nullable();
            $table->string('main_status')->nullable();

            $table->string('project_in_charge')->nullable();

            $table->date('notice_of_award')->nullable();
            $table->date('notice_to_proceed')->nullable();
            $table->integer('additional_days')->nullable();
            $table->integer('contract_duration')->nullable();

            $table->double('approved_budget')->nullable();
            $table->double('bid_price_php')->nullable();

            $table->double('revised_contract_amount')->nullable();
            $table->date('original_date_of_completion')->nullable();

            $table->integer('remaining_number_of_days')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
