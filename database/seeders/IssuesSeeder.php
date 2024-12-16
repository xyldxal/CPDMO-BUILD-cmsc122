<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class IssuesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $issues = [];
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
            $issues[] = [
                'project_id' => $projectId,
                'issue' => 'Issue No. ' . $counter,
                'is_resolved' => True,
                'created_by' => 1,
                
            ];
            $counter++;
        }

        // Insert the data into the database
        DB::table('issues')->insert($issues);
    }
}
