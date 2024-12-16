<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\OVCPDProgressTracker;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CSourcesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fund_sources = [];
        $colleges = [];
        $main_statuses = [];
        $end_users = [];
        $now = Carbon::now();
        // Prepare data for insertion
        $counter = 1;
        while ($counter <= 10) {
            $fund_sources[] = [
                'id' => $counter,
                'fund_source' => 'Fund Source ' . $counter,
                'description' => 'Description ' . $counter,
                'created_by' => 1,
            ];
            $colleges[] = [
                'id' => $counter,
                'shortname' => 'College ' . $counter,
                'description' => 'Description ' . $counter,
                'created_by' => 1,
            ];
            $main_statuses[] = [
                'id' => $counter,
                'status' => 'Main Status ' . $counter,
                'created_by' => 1,
            ];
            $end_users[] = [
                'id' => $counter,
                'shortname' => 'End User ' . $counter,
                'description' => 'Description ' . $counter,
                'created_by' => 1,
            ];
            $counter++;
        }

        // Insert the data into the database
        DB::table('c_fund_sources')->insert($fund_sources);
        DB::table('c_colleges')->insert($colleges);
        DB::table('c_main_statuses')->insert($main_statuses);
        DB::table('c_end_users')->insert($end_users);
    }
}
