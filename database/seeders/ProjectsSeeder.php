<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\OVCPDProgressTracker;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projects = [];
        $now = Carbon::now();

        $project_trackers = OVCPDProgressTracker::all();
        $tracker_columns = Schema::getColumnListing((new OVCPDProgressTracker)->getTable());
        $project_trackers->toArray();
        // $length = 40;
        // print($project_trackers);
        $array = json_decode($project_trackers, true);
        $fkeys = [];
        foreach ($array as $item) {
            $fkeys[] = $item['tracking_number'];
        }
        // print_r($fkeys);
        //substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length),
        $counter = 0;
        foreach($fkeys as $fkey) {
            $projects[] = [
                'tracking_number' => $fkey,
                'project_title' => 'Project Title ' . $counter,
                'project_description' => 'Project Description ' . $counter,
                'college_unit' => 'College ' . $counter,
                'main_status' => 'Status ' . $counter,
                'project_in_charge' => 'Person ' . $counter,
                'notice_of_award' => date("Y-m-d H:i:s",rand(329447722,1717982122)),
                'notice_to_proceed' => date("Y-m-d H:i:s",rand(329447722,1717982122)),
                'additional_days' => rand(1, 50),
                'contract_duration' => rand(1,365),
                'approved_budget' => rand(200000,14000000),
                'bid_price_php' => rand(200000,14000000),
                'revised_contract_amount' => rand(100000,10000000),
                'original_date_of_completion' => date("Y-m-d H:i:s",rand(329447722,1717982122)),
                'remaining_number_of_days' => rand(329447722,1717982122),
            ];
            $counter+=1;
        }
        DB::table('projects')->insert($projects);
    }
}
