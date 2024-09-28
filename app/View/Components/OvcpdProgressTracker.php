<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Database\Eloquent\Collection;

class OvcpdProgressTracker extends Component
{
    public $trackerColumns;
    public $projectTrackers;

    //when changing anything in component classes, use php artisan optimize=clear after
    //in ccomponent class = camelCase
    //in parent blade.php = kebab-case
    //in component view file = camelCase
    //in controller i use = under_scores

    public function __construct(array $trackerColumns, Collection $projectTrackers)
    {
        $this->trackerColumns = $trackerColumns;
        $this->projectTrackers = $projectTrackers;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.ovcpd_progress_tracker');
    }
}
