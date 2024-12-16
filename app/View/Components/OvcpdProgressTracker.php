<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Schema;
use Illuminate\View\Component;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Project;

class OvcpdProgressTracker extends Component
{
    public $trackerColumns;
    public $projectTrackers;
    public $jsonFile;

    //when changing anything in component classes, use php artisan optimize=clear after
    //in ccomponent class = camelCase
    //in parent blade.php = kebab-case
    //in component view file = camelCase
    //in controller i use = under_scores

    public function __construct($jsonFile, array $trackerColumns, Collection $projectTrackers)
    {
        $this->jsonFile=json_decode($jsonFile, true);
        $this->trackerColumns = $trackerColumns;
        $this->projectTrackers = $projectTrackers;
        $this->projectTrackers->load('project');
        // dd($this->projectTrackers);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.ovcpd_progress_tracker', [
            'projectTitles' => $this->getProjectTitles(),
        ]);
    }
    protected function getProjectTitles()
    {
        return $this->projectTrackers->map(function ($tracker) {
            return [
                'tracking_number' => $tracker->tracking_number,
                'project_title' => $tracker->project ? $tracker->project->title : null, // Use the project relationship
            ];
        });
    }
}
