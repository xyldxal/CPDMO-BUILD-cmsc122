<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\OVCPDProgressTracker;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AccomplishmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accomplishments = [];
        $now = Carbon::now();

        // Fetch all project IDs
        $projectIds = DB::table('projects')->pluck('project_id')->toArray();

        // Ensure there are enough project IDs
        if (count($projectIds) < 10) {
            $projectIds = array_pad($projectIds, 10, $projectIds[0]);
        }

        // Prepare data for insertion
        $counter = 1;
        foreach ($projectIds as $projectId) {
            $accomplishments[] = [
                'project_id' => $projectId,
                'as_of' => $now->copy()->addDays($counter)->toDateString(),
                'notes' => 'Placeholder Notes ' . $counter,
                'accomplishment_percentage' => rand(1,100),
                'accomplishment' => 'Accomplishment ' . $counter,
                'slippage' => rand(200000,14000000) + ($counter * 1000),
                'slippage_status' => 'Slippage Status ' . $counter,
                
            ];
            $counter++;
        }

        // Insert the data into the database
        DB::table('accomplishments')->insert($accomplishments);
    }
}
