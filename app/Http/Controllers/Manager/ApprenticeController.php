<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Apprentice;
use App\Models\ApprenticeManager;
use App\Models\ApprenticeModule;
use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApprenticeController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Apprentice  $apprentice
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Apprentice $apprentice)
    {
        // check that the current manager has access to view the apprentice's details
        $apprenticeManager = ApprenticeManager::where([
            ['apprentice_id', '=', $apprentice->id],
            ['manager_id', '=', auth()->user()->manager->id]
        ])->first();

        if(!$apprenticeManager)abort(403);

        $apprenticeModuleData = ApprenticeModule::orderBy('start_date')
            ->where('apprentice_id', $apprentice->id)
            ->get();

        return view('apprentice.show', compact('apprentice', 'apprenticeModuleData'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Apprentice  $apprentices
     * @return \Illuminate\Http\Response
     */
    public function edit(Apprentice $apprentices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Apprentice  $apprentices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apprentice $apprentices)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Apprentice  $apprentices
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apprentice $apprentices)
    {
        //
    }
}
