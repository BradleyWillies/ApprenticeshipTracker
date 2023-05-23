<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApprenticeModuleRequest;
use App\Models\ApprenticeModule;
use Illuminate\Http\Request;

class ApprenticeModuleController extends Controller
{
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
     * @param  \App\Models\ApprenticeModule  $apprenticeModule
     * @return \Illuminate\Http\Response
     */
    public function show(ApprenticeModule $apprenticeModule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ApprenticeModule  $apprenticeModule
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(ApprenticeModule $apprenticeModule)
    {
        $this->checkAccess($apprenticeModule);

        return view('apprentice-modules.edit', compact('apprenticeModule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ApprenticeModule  $apprenticeModule
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ApprenticeModuleRequest $request, ApprenticeModule $apprenticeModule)
    {
        $this->checkAccess($apprenticeModule);

        $apprenticeModule->update([
            'start_date' => $request->get('start_date'),
            'end_date' => $request->get('end_date'),
            'grade' => $request->get('grade'),
        ]);

        return redirect()->route('dashboard')->with('success', 'Module details updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ApprenticeModule  $apprenticeModule
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApprenticeModule $apprenticeModule)
    {
        //
    }

    private function checkAccess(ApprenticeModule $apprenticeModule):void
    {
        // if user doesn't have access to edit the module throw that error
        if($apprenticeModule->apprentice->user->id != auth()->user()->id)abort(403);
    }
}
