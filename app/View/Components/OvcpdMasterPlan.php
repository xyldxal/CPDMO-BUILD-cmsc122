<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Schema;
use Illuminate\View\Component;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Project;

class OvcpdMasterPlan extends OvcpdProgressTracker
{
    public $jsonFile;
    public $trackerColumns;
    public $projectTrackers;

    public function __construct(array $trackerColumns, Collection $projectTrackers, $jsonFile)
    {
        $this->trackerColumns = $trackerColumns;
        $this->projectTrackers = $projectTrackers;
        $this->projectTrackers->load('project');
        $this->jsonFile=$jsonFile;//json_encode($jsonFile, true);
        // dd($this->jsonFile);
    }
    public function render()
    {
        return view('components.ovcpd_master_plan', [
            'projectTitles' => $this->getProjectTitles(),
        ]);
    }
}