<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PaymentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payment_statuses = [];
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
            $payment_statuses[] = [
                'project_id' => $projectId,
                'date' => $now->copy()->addDays($counter)->toDateString(),
                'notes' => 'Placeholder Notes ' . $counter,
                'status' => 'Payment Status ' . $counter,
                
            ];
            $counter++;
        }

        // Insert the data into the database
        DB::table('payment_statuses')->insert($payment_statuses);
    }
}
