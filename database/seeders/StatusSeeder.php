<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [];
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
            $statuses[] = [
                'project_id' => $projectId,
                'as_of' => $now->copy()->addDays($counter)->toDateString(),
                'notes' => 'Placeholder Notes ' . $counter,
                'status' => 'Status No. ' . $counter,
                'created_by' => 1,
                
                
            ];
            $counter++;
        }

        // Insert the data into the database
        DB::table('statuses')->insert($statuses);
    }
}
