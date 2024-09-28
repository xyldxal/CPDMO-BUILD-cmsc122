<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CsvDataSeeder extends Seeder
{
    public function run()
    {
        // Specify the path to your CSV file
        $csvFilePath = storage_path('app/csv/ref_table.csv');

        // Read CSV file
        $csvData = array_map('str_getcsv', file($csvFilePath));

        foreach ($csvData as $row) {
            // Check if email, unit, and token columns are not empty and email contains "@gmail.com"
            if (!empty($row[0]) && !empty($row[3]) && !empty($row[2])) {
                // Insert the data into the database
                DB::table('reference_table')->insert([
                    'email' => $row[0],
                    'prefix' => $row[1],
                    'token' => $row[2],
                    'unit' => $row[3],
                ]);
            }
        }
    }
}
