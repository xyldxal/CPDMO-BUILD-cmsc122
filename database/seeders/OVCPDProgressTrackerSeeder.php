<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class OvcpdTrackedProjectsSeeder extends Seeder
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
                'tracking_number' => Str::uuid()->toString(),
                
                // PLANNING PHASE
                'requirement_desc' => 'Requirement Description ' . $i,
                'complete_submission' => 'Yes',
                
                // DESIGN PHASE
                'detailed_drawings' => true,
                'scope_of_work' => true,
                'estimate' => true,
                'pert_cpm' => true,
                'proj_folder_submission' => $now->subDays(rand(1, 365)),
                'ovcpd_endorsement' => $now->subDays(rand(1, 365)),
                'budget_clearance' => $now->subDays(rand(1, 365)),
                'ovcaf_approval' => $now->subDays(rand(1, 365)),
                
                // BAC
                'opening' => true,
                'bid_eval' => true,
                'post_qualification' => true,
                'bidding' => true,
                
                // PROCUREMENT
                'contract_completion' => $now->subDays(rand(1, 365)),
                
                // IMPLEMENTATION PHASE
                'received_proj_folder' => $now->subDays(rand(1, 365)),
                'preconstruction_meet' => $now->subDays(rand(1, 365)),
                'percentage_complete' => rand(0, 100),
                'proj_status' => 'In Progress',
                'payment_status' => false,
                
                // SPMO
                'par_ics_attachment' => true,
                'date_accomplished' => $now,
                
                // ACCEPTANCE
                'contract_end' => $now->addMonths(6),
                'completion_cert' => $now->addMonths(6),
                'final_bill_submission' => $now->addMonths(6),
                'par_ics_attachment_2' => true,
                'date_accomplished_2' => $now->addMonths(7),
                'payment_status_2' => true,
                'final_bill_payment_received' => $now->addMonths(8),
                
                // RELEASE OF RETENTION
                'retention_bill_submission' => $now->addMonths(9),
                'retention_bill_payment_received' => $now->addMonths(9),
            ];
        }

        DB::table('ovcpd_tracked_projects')->insert($projects);
    }
}
