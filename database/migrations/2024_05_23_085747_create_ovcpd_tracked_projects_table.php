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
            $table->string('tracking_number')->unique()->primary();
            $table->string('requirement_desc')->nullable();
            $table->string('complete_submission')->nullable();

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
            $table->date('contract_completion')->nullable();

            // IMPLEMENTATION PHASE
            $table->date('received_proj_folder')->nullable();
            $table->date('preconstruction_meet')->nullable();
            $table->float('percentage_complete')->nullable();
            $table->string('proj_status')->nullable();
            $table->string('payment_status')->nullable();

            // SPMO
            $table->string('par_ics_attachment')->nullable();
            $table->date('date_accomplished')->nullable();

            // ACCEPTANCE
            $table->date('contract_end')->nullable();
            $table->date('completion_cert')->nullable();
            $table->date('final_bill_submission')->nullable();
            $table->string('par_ics_attachment_2')->nullable();
            $table->date('date_accomplished_2')->nullable();
            $table->string('payment_status_2')->nullable();
            $table->date('final_bill_payment_received')->nullable();

            // RELEASE OF RETENTION
            $table->date('retention_bill_submission')->nullable();
            $table->date('retention_bill_payment_received')->nullable();
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
