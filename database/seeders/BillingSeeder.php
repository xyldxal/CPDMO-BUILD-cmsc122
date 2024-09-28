<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\OVCPDProgressTracker;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BillingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $billings = [];
        $now = Carbon::now();

        // Fetch all project IDs
        $projectIds = DB::table('projects')->pluck('project_id')->toArray();

        // Ensure there are enough project IDs
        if (count($projectIds) < 10) {
            $projectIds = array_pad($projectIds, 10, $projectIds[0]);
        }

        // Prepare data for insertion
        $counter=0;
        foreach ($projectIds as $projectId) {
            
            $billings[] = [
                'project_id' => $projectId,
                'total_billings' => rand(200000,5000000) + ($counter * 1000),
                'billing_percentage' => rand(1,100),
                'billed_variation_orders' => $counter,
                'awarded' => rand(200000,5000000) + ($counter * 1000),
                'percent_savings' => rand(1,100),
                'as_of' => $now->copy()->addDays($counter)->toDateString(),
                'notes' => 'Placeholder Note ' . $counter,
                
            ];
            $counter++;
            
        }

        // Insert the data into the database
        DB::table('billings')->insert($billings);
    }
}
