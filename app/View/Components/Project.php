<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Database\Eloquent\Collection;

class Project extends Component
{
    // public $projectColumns;
    // public $projects;
    public $jsonFile;
    public $projectHeaders;

    public function __construct($jsonFile, $projectHeaders){
        $this->jsonFile=json_decode($jsonFile, true);
        // $this->jsonFile=$jsonFile;
        $this->projectHeaders=$projectHeaders;
        // dd($this->$jsonFile);
    }
    // public function __construct(
    //     array $projectColumns, Collection $projects, 
    //     array $accomplishmentsColumns, Collection $accomplishments, 
    //     array $activitiesColumns, Collection $activities, 
    //     array $billingsColumns, Collection $billings, 
    //     array $changeOrdersColumns, Collection $changeOrders, 
    //     array $financialDetailsColumns, Collection $financialDetails, 
    //     array $fundSourcesColumns, Collection $fundSources, 
    //     array $geodataColumns, Collection $geodata, 
    //     array $imagesColumns, Collection $images, 
    //     array $issuesColumns, Collection $issues, 
    //     array $paymentStatusColumns, Collection $paymentStatus, 
    //     array $projectContractorColumns, Collection $projectContractor, 
    //     array $recentUpdatesColumns, Collection $recentUpdates, 
    //     array $statusColumns, Collection $status, 
    //     )
    // {
    //     $this->projectColumns = $projectColumns;
    //     $this->projects = $projects;

    //     $this->accomplishmentsColumns = $accomplishmentsColumns;
    //     $this->accomplishments = $accomplishments;

    //     $this->activitiesColumns = $activitiesColumns;
    //     $this->activities = $activities;

    //     $this->billingsColumns = $billingsColumns;
    //     $this->billings = $billings;

    //     $this->changeOrdersColumns = $changeOrdersColumns;
    //     $this->changeOrders = $changeOrders;

    //     $this->financialDetailsColumns = $financialDetailsColumns;
    //     $this->financialDetails = $financialDetails;

    //     $this->fundSourcesColumns = $fundSourcesColumns;
    //     $this->fundSources = $fundSources;

    //     $this->geodataColumns = $geodataColumns;
    //     $this->geodata = $geodata;

    //     $this->imagesColumns = $imagesColumns;
    //     $this->images = $images;

    //     $this->issuesColumns = $issuesColumns;
    //     $this->issues = $issues;

    //     $this->paymentStatusColumns = $paymentStatusColumns;
    //     $this->paymentStatus = $paymentStatus;

    //     $this->projectContractorColumns = $projectContractorColumns;
    //     $this->projectContractor = $projectContractor;
        
    //     $this->recentUpdatesColumns = $recentUpdatesColumns;
    //     $this->recentUpdates = $recentUpdates;

    //     $this->statusColumns = $statusColumns;
    //     $this->status = $status;
    // }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.project');
    }
}
