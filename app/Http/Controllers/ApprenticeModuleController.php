<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApprenticeModuleRequest;
use App\Models\ApprenticeModule;
use App\Models\Module;
use Illuminate\Http\Request;

class ApprenticeModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ensure that the current user is an apprentice otherwise show unauthorised error
        if(!auth()->user()->apprentice)abort(403);

        // get modules which aren't already associated with the current apprentice
        $modules = Module::whereNotIn('id', function ($query) {
            $query->select('module_id')
                ->from('apprentice_module')
                ->where('apprentice_id', auth()->user()->apprentice->id);
        })
            ->orderBy('title')
            ->get();

        return view('apprentice-modules.show', compact('modules'));
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
        // ensure that the current user is an apprentice otherwise show unauthorised error
        if(!auth()->user()->apprentice)abort(403);

        $selectedModules = $request->input('modules', []);
        $startDates = $request->input('start_dates', []);
        $endDates = $request->input('end_dates', []);

        foreach ($selectedModules as $moduleId) {
            $module = Module::find($moduleId);
            auth()->user()->apprentice->modules()->attach($module, [
                'start_date' => $startDates[$moduleId],
                'end_date' => $endDates[$moduleId],
            ]);
        }

        return redirect()->route('apprentice_dashboard')->with('success', 'Modules added');
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

        return redirect()->route('apprentice_dashboard')->with('success', 'Module details updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ApprenticeModule  $apprenticeModule
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApprenticeModule $apprenticeModule)
    {
        $this->checkAccess($apprenticeModule);

        $apprenticeModule->delete();

        return redirect()->route('apprentice_dashboard')->with('success', 'Module removed');
    }

    private function checkAccess(ApprenticeModule $apprenticeModule):void
    {
        // if user doesn't have access to edit the module throw that error
        if($apprenticeModule->apprentice->user->id != auth()->user()->id)abort(403);
    }
}
