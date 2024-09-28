<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Schema;
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

class HomeController extends Controller{
    protected $project_trackers;
    protected $projects;
    protected $accomplishments;
    protected $activities;
    protected $billings;
    protected $change_orders;
    protected $financial_details;
    protected $fund_sources;
    protected $geodata;
    protected $images;
    protected $issues;
    protected $payment_status;
    protected $project_contractor;
    protected $recent_updates;
    protected $status;
    protected $project_contractors;

    public function __construct()
    {
        $this->project_trackers = OVCPDProgressTracker::all();
        $this->projects = Project::all();
        $this->accomplishments = Accomplishment::all();
        $this->activities = Activity::all();
        $this->billings = Billing::all();
        $this->change_orders = ChangeOrder::all();
        $this->financial_details = FinancialDetail::all();
        $this->fund_sources = FundSource::all();
        $this->geodata = Geodata::all();
        $this->images = Image::all();
        $this->issues = Issue::all();
        $this->payment_status = PaymentStatus::all();
        $this->project_contractor = ProjectContractor::all();
        $this->recent_updates = RecentUpdate::all();
        $this->status = Status::all();
        $this->project_contractors = ProjectContractor::all();
    }

    public function display_projects(){
        $projects=$this->projects;
        $project_contractors=$this->project_contractors;
        $projects_columns = Schema::getColumnListing((new Project)->getTable());
        $project_contractor_columns = Schema::getColumnListing((new ProjectContractor)->getTable());
        return view("Projects", compact('projects', 'projects_columns', 'project_contractors', 'project_contractor_columns'));
    }

    public function index(){
        return redirect('/login');
    }
}
