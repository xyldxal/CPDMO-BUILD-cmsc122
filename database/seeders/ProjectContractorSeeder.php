<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProjectContractorSeeder extends Seeder
{
    public function run()
    {
        $project_contractor = [];
        $now = Carbon::now();

        // Fetch all project IDs
        $projectIds = DB::table('projects')->pluck('id')->toArray();

        // Ensure there are enough project IDs
        if (count($projectIds) < 10) {
            $projectIds = array_pad($projectIds, 10, $projectIds[0]);
        }

        // Prepare data for insertion
        $counter = 1;
        foreach ($projectIds as $projectId) {
            $project_contractor[] = [
                // 'project_contractor_id' => $counter,
                'project_id' => $projectId,
                'daed_contractor' => 'Daed Contractor ' . $counter,
                'construction_contractor' => 'Construction Contractor ' . $counter,
                'construction_manager' => 'Manager ' . $counter,
                'contract_amount' => rand(200000,14000000) + ($counter * 1000),
                'contractor' => 'Contractor ' . $counter,
                'contract_completion_date' => $now->copy()->addDays($counter)->toDateString(),
                'created_by' => 1,
            ];
            $counter++;
        }

        // Insert the data into the database
        DB::table('project_contractors')->insert($project_contractor);
    }
}
