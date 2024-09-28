<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $trackerId)
    {
        $tracker = OVCPDProgressTracker::findOrFail($trackerId);

        $validated=$request->validate([ 
            // TRACKING_NUMBER IS REMOVED AND WILL BE INHERITING TRACKING_NUMBER FROM OVCPDPROGRESSTRACKER 

            'project_title' => 'string|max:720',
            'project_description' => 'string|nullable|max:2000',

            'college_unit' => 'string|nullable|max:128',
            'main_status' => 'string|nullable|max:128',

            'project_in_charge' => 'string|nullable|max:720',

            'notice_of_award' => 'date|nullable|max:720',
            'notice_to_proceed' => 'date|nullable|max:720',
            'additional_days' => 'numeric|nullable|max:99999999',
            'contract_duration' => 'numeric|nullable|max:720',

            'approved_budget' => 'numeric|nullable|max:720',
            'bid_price_php' => 'numeric|nullable|max:720',

            'revised_contract_amount' => 'numeric|nullable|max:720',
            'original_date_of_completion' => 'date|nullable|max:720',

            'remaining_number_of_days' => 'numeric|nullable|max:720',
        ]);
        $validated['tracking_number'] = $tracker->tracking_number;

        OVCPDProgressTracker::create($validated);

        return Redirect::route('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
}
