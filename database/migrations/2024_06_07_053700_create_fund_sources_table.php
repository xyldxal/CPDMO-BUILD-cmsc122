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
        Schema::create('fund_sources', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('project_id');
            $table->foreign('project_id')
                ->references('id')
                ->on('projects')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedInteger('fund_source_id');
            $table->foreign('fund_source_id')
                ->references('id')
                ->on('c_fund_sources')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->boolean('is_funded')->nullable();
            $table->string('notes')->nullable();
            
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
        Schema::dropIfExists('fund_sources');
    }
};
