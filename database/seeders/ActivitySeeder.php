<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\OVCPDProgressTracker;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $activities = [];
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
            $activities[] = [
                'project_id' => $projectId,
                'suspension_date' => $now->copy()->addDays($counter)->toDateString(),
                'resumption_date_resumed' => $now->copy()->addDays($counter)->toDateString(),
                'resumption_revised_completion_date' => $now->copy()->addDays($counter)->toDateString(),
                'extension_date' => $now->copy()->addDays($counter)->toDateString(),
                'extension_duration' => rand(20,360),
                'revised_contract_duration' => rand(20,360),
                'reason' => 'Reason ' . $counter,
                'end_of_contract_time' => $now->copy()->addDays($counter)->toDateString(),
                
                'created_by' => 1,
                
            ];
            $counter++;
        }

        // Insert the data into the database
        DB::table('activities')->insert($activities);
    }
}
