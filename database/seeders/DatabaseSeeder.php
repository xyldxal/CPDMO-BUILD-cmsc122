<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    public function run()
    {

        // Call the ActivitySeeder
        $this->call(CSourcesSeeder::class);

        // Call the CSV data seeder
        $this->call(CsvDataSeeder::class);

        // Call the OvcpdMasterDevelopmentPlanSeeder
        $this->call(OvcpdMasterDevelopmentPlanSeeder::class);

        // Call the ProjectsSeeder
        $this->call(ProjectsSeeder::class);

        // Call the AccomplishmentsSeeder
        $this->call(AccomplishmentsSeeder::class);

        // Call the ChangeOrdersSeeder
        $this->call(ChangeOrdersSeeder::class);

        // Call the FundSourcesSeeder
        $this->call(FundSourcesSeeder::class);

        // Call the GeodataSeeder
        $this->call(GeodataSeeder::class);

        // Call the ImagesSeeder
        $this->call(ImagesSeeder::class);

        // Call the IssuesSeeder
        $this->call(IssuesSeeder::class);

        // Call the PaymentStatusSeeder
        $this->call(PaymentStatusSeeder::class);

        // Call the RecentUpdatesSeeder
        $this->call(RecentUpdatesSeeder::class);

        // Call the StatusSeeder
        $this->call(StatusSeeder::class);

        // Call the ProjectContractorSeeder
        $this->call(ProjectContractorSeeder::class);

        // Call the BillingrSeeder
        $this->call(BillingSeeder::class);

        // Call the ActivitySeeder
        $this->call(ActivitySeeder::class);
        
    }
}
