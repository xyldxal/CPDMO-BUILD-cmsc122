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
            $table->increments('id');
            $table->unsignedInteger('project_id');

            $table->foreign('project_id')
                ->references('id')
                ->on('projects')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('daed_contractor')->nullable();
            $table->string('construction_contractor')->nullable();
            $table->string('construction_manager')->nullable();
            $table->decimal('contract_amount', 22, 2)->nullable();
            $table->string('contractor')->nullable();
            $table->date('contract_completion_date')->nullable();
            
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
        Schema::dropIfExists('project_contractors');
    }
};
