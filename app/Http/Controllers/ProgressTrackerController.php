<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Schema;
use App\Services\JsonFileService;
use App\Models\OVCPDProgressTracker;
use App\Models\Project;
use App\Models\Accomplishment;
use App\Models\Activity;
use App\Models\Billing;
use App\Models\ChangeOrder;
use App\Models\FinancialDetail;
use App\Models\FundSource;
use App\Models\Geodata;
use App\Models\Image;
use App\Models\Issue;
use App\Models\PaymentStatus;
use App\Models\ProjectContractor;
use App\Models\RecentUpdate;
use App\Models\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\OVCPDProgressTrackerController;

class ProgressTrackerController extends HomeController
{
    private $tracker_columns;
    private $project_columns;
    private $accomplishments_columns;
    private $activities_columns;
    private $billings_columns;
    private $change_orders_columns;
    private $financial_details_columns;
    private $fund_sources_columns;
    private $geodata_columns;
    private $images_columns;
    private $issues_columns;
    private $payment_status_columns;
    private $project_contractor_columns;
    private $recent_updates_columns;
    private $status_columns;

    public function __construct() //JsonFileService $jsonFileService
    {
        parent::__construct();
        // $this->jsonFileService = $jsonFileService;
        $this->tracker_columns = Schema::getColumnListing((new OVCPDProgressTracker)->getTable());
        $this->project_columns = Schema::getColumnListing((new Project)->getTable());
        // $this->accomplishments_columns = Schema::getColumnListing((new Accomplishment)->getTable());
        // $this->activities_columns = Schema::getColumnListing((new Activity)->getTable());
        // $this->billings_columns = Schema::getColumnListing((new Billing)->getTable());
        // $this->change_orders_columns = Schema::getColumnListing((new ChangeOrder)->getTable());
        // $this->financial_details_columns = Schema::getColumnListing((new FinancialDetail)->getTable());
        // $this->fund_sources_columns = Schema::getColumnListing((new FundSource)->getTable());
        // $this->geodata_columns = Schema::getColumnListing((new Geodata)->getTable());
        // $this->images_columns = Schema::getColumnListing((new Image)->getTable());
        // $this->issues_columns = Schema::getColumnListing((new Issue)->getTable());
        // $this->payment_status_columns = Schema::getColumnListing((new PaymentStatus)->getTable());
        // $this->project_contractor_columns = Schema::getColumnListing((new ProjectContractor)->getTable());
        // $this->recent_updates_columns = Schema::getColumnListing((new RecentUpdate)->getTable());
        // $this->status_columns = Schema::getColumnListing((new Status)->getTable());
    }

    public function handleHome()
    {
        if (auth()->check()) {
            return $this->progressTrackers();
        } else {
            return $this->index();
        }
    }

    public function progressTrackers(){
        // $project_trackers=$this->project_trackers->toArray();
        // $projects=$this->projects->toArray();

        $tracker_columns= $this->tracker_columns;
        $project_trackers=$this->project_trackers;

        

        /**
         * Fix Table column header order here
         * Changes here should also reflect the rows pushed to JSON below
         * 43 total headers (removed accomplishment_id)
         */
        // $project_headers = ['progress', 'notes', 'billing_percentage', 'total_billings', 'as_of', 'college_unit', 'project_title', 'status', 'as_of', 'notes', 'daed_contractor', 'construction_contractor', 'construction_manager', 'contract_amount', 'contractor', 'contract_completion_date', 'notice_of_award', 'notice_to_proceed', 'additional_days', 'contract_duration', 'fund_source', 'is_funded', 'notes', 'approved_budget', 'bid_price_php', 'change_order_number', 'amount', 'notes', 'revised_contract_amount', 'suspension_date', 'resumption_date_resumed', 'resumption_revised_completion_date', 'extension_date', 'extension_duration', 'revised_contract_duration', 'reason', 'end_of_contract_time', 'original_date_of_completion', 'remaining_number_of_days', 'accomplishment', 'project_in_charge', 'credits', 'date', 'notes'];

        $project_headers = ['ID','Accomplishment Percentage', 'Notes', 'Billing Percentage', 'Total Billings', 'As Of', 'College Unit', 'Year', 'Project Title', 'Status', 'Status As Of', 'Notes', 'Dead Contractor', 'Construction Contractor', 'Construction Manager', 'Contract Amount', 'Contractor', 'Contract Completion Date', 'Notice of Award', 'Notice to Proceed', 'Additional Days', 'Contract Duration', 'Fund Source', 'Is Funded', 'Notes', 'Approved Budget', 'Bid Price (PHP)', 'Change Order Number', 'Amount', 'Notes', 'Revised Contract Amount', 'Suspension Date', 'Resumption Date', 'Resumption Revised Completion Date', 'Extension Date', 'Extension Duration', 'Revised Contract Duration', 'Reason', 'End of Contract Time', 'Original Date of Completion', 'Remaining Number of Days', 'Accomplishment', 'Project In Charge', 'Credits', 'Date', 'Notes'];

        
        // dd([
        //     'progressTrackerTable' => $JSON_to_compile,
        //     'json_file' => $json_file,
        //     'tracker_columns' => $tracker_columns,
        //     'project_trackers' => $project_trackers,
        //     'project_headers' => $project_headers
        // ]);
        // $this->jsonFileService->setJsonFile($json_file);
        // dd($this->jsonFileService->getJsonFile());
        // dd($this->jsonFile);
        $json_file = $this->getJson();
        $json_file_plan = (new OVCPDProgressTrackerController())->getJson();
        return view('Home', compact('json_file', 'tracker_columns', 'project_trackers', 'project_headers', 'json_file_plan'));
    }

    public function getJson(){
        $p_ids = $this->projects->modelKeys();
        // $p_ids = $this->projects->intersect(Project::whereIn('tracking_number', $t_ids)->get())->pluck('id')->toArray();
        $JSON_to_compile = array();

        // dd($this->projects->where('id', 127));
        
        // dd($this->billings->where('project_id', 127)->pluck('billing_percentage')->toArray());
        
        //count($accomplishments)
        foreach($p_ids as $i){
            $progressTrackerTable = array();
            //0-1
            array_push($progressTrackerTable, 
                $this->projects->where('id', $i)->pluck('id')->toArray(), 
                [$this->accomplishments->where('project_id', $i)->sortByDesc('id')->pluck('progress')->first()],
                [$this->accomplishments->where('project_id', $i)->sortByDesc('id')->pluck('notes')->first()]);
            //2-4
            array_push($progressTrackerTable, 
                [$this->billings->where('project_id', $i)->sortByDesc('id')->pluck('billing_percentage')->first()],
                [$this->billings->where('project_id', $i)->sortByDesc('id')->pluck('total_billings')->first()],
                [$this->billings->where('project_id', $i)->sortByDesc('id')->pluck('as_of')->first()]);
                
                // $this->billings->where('project_id', $i)->pluck('total_billings')->toArray(), 
                // $this->billings->where('project_id', $i)->pluck('as_of')->toArray());
            //5-6
            array_push($progressTrackerTable, 
                // $this->projects->where('id', $i)->pluck('college_unit')->toArray(), 
                // $this->projects->where('id', $i)->pluck('year')->toArray(), 
                // $this->projects->where('id', $i)->pluck('project_title')->toArray());
                [$this->projects->where('id', $i)->sortByDesc('id')->pluck('college_unit')->first()],
                [$this->projects->where('id', $i)->sortByDesc('id')->pluck('year')->first()],
                [$this->projects->where('id', $i)->sortByDesc('id')->pluck('project_title')->first()]);
            //7-9
            array_push($progressTrackerTable, 
                [$this->status->where('project_id', $i)->sortByDesc('id')->pluck('status')->first()],
                [$this->status->where('project_id', $i)->sortByDesc('id')->pluck('as_of')->first()],
                [$this->status->where('project_id', $i)->sortByDesc('id')->pluck('notes')->first()]);
            //10-15
            array_push($progressTrackerTable, 
                $this->project_contractor->where('project_id', $i)->pluck('daed_contractor')->toArray(),  
                $this->project_contractor->where('project_id', $i)->pluck('construction_contractor')->toArray(), 
                $this->project_contractor->where('project_id', $i)->pluck('construction_manager')->toArray(), 
                [$this->project_contractor->where('project_id', $i)->sortByDesc('id')->pluck('contract_amount')->first()], 
                $this->project_contractor->where('project_id', $i)->pluck('contractor')->toArray(), 
                [$this->project_contractor->where('project_id', $i)->sortByDesc('id')->pluck('contract_completion_date')->first()]);
            //16-19
            array_push($progressTrackerTable, 
                [$this->projects->where('id', $i)->sortByDesc('id')->pluck('notice_of_award')->first()],
                [$this->projects->where('id', $i)->sortByDesc('id')->pluck('notice_to_proceed')->first()],
                [$this->projects->where('id', $i)->sortByDesc('id')->pluck('additional_days')->first()],
                [$this->projects->where('id', $i)->sortByDesc('id')->pluck('contract_duration')->first()]);
            //20-22
            array_push($progressTrackerTable, 
                [$this->fund_sources->where('project_id', $i)->sortByDesc('id')->pluck('fund_source')->first()],
                [$this->fund_sources->where('project_id', $i)->sortByDesc('id')->pluck('is_funded')->first()], 
                $this->fund_sources->where('project_id', $i)->pluck('notes')->toArray());
            //23-24
            array_push($progressTrackerTable, 
                [$this->projects->where('id', $i)->sortByDesc('id')->pluck('approved_budget')->first()],
                [$this->projects->where('id', $i)->sortByDesc('id')->pluck('bid_price_php')->first()]);
            //25-27
            array_push($progressTrackerTable, 
                $this->change_orders->where('project_id', $i)->pluck('change_order_number')->toArray(), 
                $this->change_orders->where('project_id', $i)->pluck('amount')->toArray(), 
                $this->change_orders->where('project_id', $i)->pluck('notes')->toArray());
            //28
            array_push($progressTrackerTable, 
                [$this->projects->where('id', $i)->sortByDesc('id')->pluck('revised_contract_amount')->first()]);
            //29-36
            array_push($progressTrackerTable, 
                [$this->activities->where('project_id', $i)->sortByDesc('id')->pluck('suspension_date')->first()],
                [$this->activities->where('project_id', $i)->sortByDesc('id')->pluck('resumption_date_resumed')->first()],
                [$this->activities->where('project_id', $i)->sortByDesc('id')->pluck('resumption_revised_completion_date')->first()],
                [$this->activities->where('project_id', $i)->sortByDesc('id')->pluck('extension_date')->first()],
                [$this->activities->where('project_id', $i)->sortByDesc('id')->pluck('extension_duration')->first()],
                [$this->activities->where('project_id', $i)->sortByDesc('id')->pluck('revised_contract_duration')->first()],
                [$this->activities->where('project_id', $i)->sortByDesc('id')->pluck('reason')->first()],
                [$this->activities->where('project_id', $i)->sortByDesc('id')->pluck('end_of_contract_time')->first()]);
            //37-38
            array_push($progressTrackerTable, 
                [$this->projects->where('id', $i)->sortByDesc('id')->pluck('original_date_of_completion')->first()],
                [$this->projects->where('id', $i)->sortByDesc('id')->pluck('remaining_number_of_days')->first()]);
            //39
            array_push($progressTrackerTable, 
                $this->accomplishments->where('project_id', $i)->pluck('accomplishment')->toArray());
            //40
            array_push($progressTrackerTable, 
                $this->projects->where('id', $i)->pluck('project_in_charge')->toArray());
            //41-43
            array_push($progressTrackerTable, 
                [$this->recent_updates->where('project_id', $i)->sortByDesc('id')->pluck('credits')->first()],
                [$this->recent_updates->where('project_id', $i)->sortByDesc('id')->pluck('date')->first()],
                [$this->recent_updates->where('project_id', $i)->sortByDesc('id')->pluck('notes')->first()]);
            
            array_push($JSON_to_compile, $progressTrackerTable);
            
        }

        // dd($JSON_to_compile);
        $json_file = json_encode($JSON_to_compile, );
        return $json_file;
    }

    public function ongoing_projects(){
        return view('components.ongoing-projects');
    }
}
