<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivityController extends Controller
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
    public function store(Request $request)
    {
        $tracker = Project::findorFail($project_id);
        $validated = $request->validate([
            'suspension_date' => 'date|nullable',
            'resumption_date_resumed' => 'date|nullable',
            'resumption_revised_completion_date' => 'date|nullable',
            'extension_date' => 'date|nullable',
            'extension_duration' => 'nullable|numeric|max:9999999',
            'revised_contract_duration' => 'nullable|numeric|max:9999999',
            'reason' => 'string|nullable|max:720',
            'end_of_contract_time' => 'date|nullable',
        ]);

        $validated['project_id'] = $tracker->$project_id;

        Project::create($validated);
        return Redirect::route('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
