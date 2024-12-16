<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\OVCPDProgressTracker;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ChangeOrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $change_orders = [];
        $now = Carbon::now();

        // Fetch all project IDs
        $projectIds = DB::table('projects')->pluck('id')->toArray();

        // Ensure there are enough project IDs
        if (count($projectIds) < 10) {
            $projectIds = array_pad($projectIds, 10, $projectIds[0]);
        }

        // Prepare data for insertion
        
        foreach ($projectIds as $projectId) {
            $co_randomizer = rand(1,5);
            $counter=0;
            while($co_randomizer != 0){
                $change_orders[] = [
                    'project_id' => $projectId,
                    'change_order_number' => $counter,
                    'amount' => rand(200000,5000000) + ($co_randomizer * 1000),
                    'notes' => 'Placeholder Note ' . $counter,
                    'created_by' => 1,
                    
                ];
                $co_randomizer--;
                $counter++;
            }
        }

        // Insert the data into the database
        DB::table('change_orders')->insert($change_orders);
    }
}
