<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RecentUpdatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $recent_updates = [];
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
            $recent_updates[] = [
                'project_id' => $projectId,
                'credits' => 'Credit No. ' . $counter,
                'date' => $now->copy()->addDays($counter)->toDateString(),
                'notes' => 'Placeholder Notes ' . $counter,
                
                
            ];
            $counter++;
        }

        // Insert the data into the database
        DB::table('recent_updates')->insert($recent_updates);
    }
}
