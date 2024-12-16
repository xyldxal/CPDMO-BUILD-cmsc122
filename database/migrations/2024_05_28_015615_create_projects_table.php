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
            $table->increments('id');

            $table->string('tracking_number')->nullable();

            $table->foreign('tracking_number')
                ->references('tracking_number')
                ->on('ovcpd_tracked_projects')
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->string('project_title')->nullable();
            $table->string('project_description')->nullable();
            $table->integer('year')->nullable();

            $table->unsignedInteger('college_unit')->nullable();
            $table->foreign('college_unit')
                ->references('id')
                ->on('c_colleges')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->unsignedInteger('main_status')->nullable();
            $table->foreign('main_status')
                ->references('id')
                ->on('c_main_statuses')
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->string('project_in_charge')->nullable();

            $table->date('notice_of_award')->nullable();
            $table->date('notice_to_proceed')->nullable();
            $table->integer('additional_days')->nullable();
            $table->integer('contract_duration')->nullable();

            $table->decimal('approved_budget', 22, 2)->nullable();
            $table->decimal('bid_price_php', 22, 2)->nullable();

            $table->decimal('revised_contract_amount', 22, 2)->nullable();
            $table->date('original_date_of_completion')->nullable();

            $table->integer('remaining_number_of_days')->nullable();
            
            // User info and Timestamps
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();

            $table->foreign('created_by')->references('id')->on('system_users')->cascadeOnUpdate()->default(1);
            $table->foreign('updated_by')->references('id')->on('system_users')->cascadeOnUpdate();
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
