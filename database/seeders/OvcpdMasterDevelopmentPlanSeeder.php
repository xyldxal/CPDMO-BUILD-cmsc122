<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class OvcpdMasterDevelopmentPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projects = [];
        $now = Carbon::now();
        for ($i = 1; $i <= 10; $i++) {
            $projects[] = [
                // PROJECT DETAILS
                'tracking_number' => Str::uuid()->toString(),
                'project_title' => 'Project Title ' . $i,
                'project_description' => 'Project Description ' . $i,
                'end_user_id' => rand(1, 10),
                'fund_source_id' => rand(1, 10),
                'budget' => rand(100000, 1000000),
                'bid_amount' => rand(100000, 1000000),
                'contractor' => 'Contractor ' . $i,
                
                // PLANNING PHASE
                'requirement_desc' => 'Requirement Description ' . $i,
                'complete_submission' => 'Yes',
                
                // DESIGN PHASE
                'detailed_drawings' => (bool) rand(0, 1),
                'scope_of_work' => (bool) rand(0, 1),
                'estimate' => (bool) rand(0, 1),
                'pert_cpm' => (bool) rand(0, 1),
                'proj_folder_submission' => $now->subDays(rand(1, 365)),
                'ovcpd_endorsement' => $now->subDays(rand(1, 365)),
                'budget_clearance' => $now->subDays(rand(1, 365)),
                'ovcaf_approval' => $now->subDays(rand(1, 365)),
                
                // BAC
                'opening' => $now->subDays(rand(1, 365)),
                'bid_eval' => $now->subDays(rand(1, 365)),
                'post_qualification' => $now->subDays(rand(1, 365)),
                'bidding' => $now->subDays(rand(1, 365)),

                // PROCUREMENT
                'issuance_of_noa' => $now->subDays(rand(1, 365)),
                'contract_completion' => $now->subDays(rand(1, 365)),
                'notice_to_proceed' => $now->subDays(rand(1, 365)),
                
                // IMPLEMENTATION PHASE
                'received_proj_folder' => $now->subDays(rand(1, 365)),
                'preconstruction_meet' => $now->subDays(rand(1, 365)),
                'percentage_complete' => rand(0, 100),
                'proj_status' => ['In Progress', 'Completed', 'On Hold'][rand(0, 2)],
                'payment_status' => 'Payment Status ' . $i,
                
                // SPMO
                'par_ics_attachment' => (bool) rand(0, 1),
                'date_accomplished' => $now->subDays(rand(1, 365)),
                
                // ACCEPTANCE
                'contract_end' => $now->addMonths(6),
                'completion_cert' => $now->addMonths(6),
                'final_bill_submission' => $now->addMonths(6),
                'par_ics_attachment_2' => (bool) rand(0, 1),
                'date_accomplished_2' => $now->addMonths(7),
                'payment_status_2' => (bool) rand(0, 1),
                'final_bill_payment_received' => $now->addMonths(8),
                
                // RELEASE OF RETENTION
                'retention_bill_submission' => $now->addMonths(9),
                'retention_bill_payment_received' => $now->addMonths(9),
                'created_by' => 1,
            ];
        }
        DB::table('ovcpd_tracked_projects')->insert($projects);
    }
}
