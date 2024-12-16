<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\OVCPDProgressTracker;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class FundSourcesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fund_sources = [];
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
            $fund_sources[] = [
                'project_id' => $projectId,
                'fund_source_id' => rand(1, 10),
                'is_funded' => True,
                'notes' => 'Placeholder Notes ' . $counter,
                'created_by' => 1,
                
            ];
            $counter++;
        }

        // Insert the data into the database
        DB::table('fund_sources')->insert($fund_sources);
    }
}
