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
        Schema::create('ovcpd_tracked_projects', function (Blueprint $table) {
            // $table->id();
            // PROJECT DETAILS
            $table->string('tracking_number')->unique()->primary();
            $table->string('project_title')->nullable();
            $table->string('project_description', length: 2000)->nullable();
            $table->unsignedInteger('end_user_id')->nullable();
            $table->foreign('end_user_id')
                ->references('id')
                ->on('c_end_users')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->unsignedInteger('fund_source_id')->nullable();
            $table->foreign('fund_source_id')
                ->references('id')
                ->on('c_fund_sources')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->decimal('budget', 22, 2)->nullable();
            $table->decimal('bid_amount', 22, 2)->nullable();
            $table->string('contractor', length: 1000)->nullable();

            // PLANNNIG
            $table->string('requirement_desc', length: 2000)->nullable();
            $table->string('complete_submission', length: 1000)->nullable();

            // DESIGN PHASE
            $table->boolean('detailed_drawings')->nullable();
            $table->boolean('scope_of_work')->nullable();
            $table->boolean('estimate')->nullable();
            $table->boolean('pert_cpm')->nullable();
            $table->date('proj_folder_submission')->nullable();
            $table->date('ovcpd_endorsement')->nullable();
            $table->date('budget_clearance')->nullable();
            $table->date('ovcaf_approval')->nullable();

            // BAC
            $table->date('opening')->nullable();
            $table->date('bid_eval')->nullable();
            $table->date('post_qualification')->nullable();
            $table->date('bidding')->nullable();

            // PROCUREMENT
            $table->date('issuance_of_noa')->nullable();
            $table->date('contract_completion')->nullable();
            $table->date('notice_to_proceed')->nullable();

            // IMPLEMENTATION PHASE
            $table->date('received_proj_folder')->nullable();
            $table->date('preconstruction_meet')->nullable();
            $table->float('percentage_complete')->nullable();
            $table->string('proj_status', length: 2000)->nullable();
            $table->string('payment_status', length: 1000)->nullable();

            // SPMO
            $table->boolean('par_ics_attachment')->nullable();
            $table->date('date_accomplished')->nullable();

            // ACCEPTANCE
            $table->date('contract_end')->nullable();
            $table->date('completion_cert')->nullable();
            $table->date('final_bill_submission')->nullable();
            $table->boolean('par_ics_attachment_2')->nullable();
            $table->date('date_accomplished_2')->nullable();
            $table->string('payment_status_2', length: 1000)->nullable();
            $table->date('final_bill_payment_received')->nullable();

            // RELEASE OF RETENTION
            $table->date('retention_bill_submission')->nullable();
            $table->date('retention_bill_payment_received')->nullable();
            
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
        Schema::dropIfExists('ovcpd_tracked_projects');
    }
};
