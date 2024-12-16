<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CSV_completed_projects_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Specify the path to your CSV file
        $csvFilePath = storage_path('app/csv/ref_table.csv');
    
        // Read CSV file
        $csvData = array_map('str_getcsv', file($csvFilePath));

        $project_no;
        $billing_percentage;
        $billing_as_of;
        $unit;
        $title;
        $contractor;
        $noa;
        $ntp;
        $contract_duration;
        $fund_source;
        $approved_budget;
        $bid_price;
        $revised_contract_amount;
        $remaining_days;
        $status;
        $issues;
        $recent_accomplishments;
        $project_in_charge;
        $local_id=0;
        $is_new;
        // Iterate through each row
        foreach ($csvData as $rowIndex => $row) {
            // Iterate through each column in the current row
            $current = (empty($row[0]) || $row[0] === "_" || $row[0] === "--") ? (-1) : $row[0];
            if($current<0){
                $current=$local_id;
            } elseif($current != $local_id){ 
                $is_new=TRUE;
                $local_id = $current;
                
            } else {
                $is_new=FALSE;
            }
    
            try{
                if ($is_new) {
                    // Insert the data into the database
                    DB::table('projects')->insert([
                        'project_title' => (empty($row[4]) || $row[4] === "_" || $row[4] === "--") ? NULL : $row[4],
                        'college_unit' => (empty($row[3]) || $row[3] === "_" || $row[3] === "--") ? NULL : $row[3],
                        'main_status' => 'COMPLETED',
                        'project_in_charge' => (empty($row[29]) || $row[29] === "_" || $row[29] === "--") ? NULL : $row[29],
                        'notice_of_award' => (empty($row[6]) || $row[6] === "_" || $row[6] === "--") ? NULL : $row[6],
                        'notice_to_proceed' => (empty($row[7]) || $row[7] === "_" || $row[7] === "--") ? NULL : $row[7],
                        'contract_duration' => (empty($row[8]) || $row[8] === "_" || $row[8] === "--") ? NULL : $row[8],
                        'approved_budget' => (empty($row[10]) || $row[10] === "_" || $row[10] === "--") ? NULL : $row[10],
                        'bid_price_php' => (empty($row[11]) || $row[11] === "_" || $row[11] === "--") ? NULL : $row[11],
                        'revised_contract_amount' => (empty($row[15]) || $row[15] === "_" || $row[15] === "--") ? NULL : $row[15],
                        'original_date_of_completion' => (empty($row[23]) || $row[23] === "_" || $row[23] === "--") ? NULL : $row[23],
                        'remaining_number_of_days' => (empty($row[25]) || $row[25] === "_" || $row[25] === "--") ? NULL : $row[25],
                    ]);
    
                    DB::table('projects')->insert([
                    ]);
                }
            } catch (\Exception $e){
                DB::rollBack();
                return response()->json(['error' => $e->getMessage()], 500);
            }
            
            
        }

        function changeOrder(){
            // while
            foreach ($csvData as $rowIndex => $row) {
                foreach ($row as $columnIndex => $column) {
                    // Output the row and column data
                    $this->info("Row $rowIndex, Column $columnIndex: $column");
                }
            }
        }





    }
}
