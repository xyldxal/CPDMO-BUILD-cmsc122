<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccomplishmentController extends Controller
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
    public function store(Request $request, $project_id)
    {
        $tracker = Project::findorFail($project_id);
        $validated = $request->validate([
            'accomplishment_percentage' => 'numeric|nullable|max:100',
            'accomplishment' => 'string|nullable|max:720',
            'slippage' => 'nullable|numeric|max:9999999999999.99',
            'slippage_status' => 'string|nullable|max:720',
            'as_of' => 'date|nullable',
            'notes' => 'string|nullable|max:720'
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
