<?php

namespace App\Http\Controllers\Apprentice;

use App\Http\Controllers\Controller;
use App\Models\ApprenticeManager;
use App\Models\Manager;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        // ensure that the user is an apprentice, otherwise show the forbidden error screen
        if(!auth()->user()->apprentice)abort(403);

        $apprenticeNotifications = Notification::where([
            'apprentice_id' => auth()->user()->apprentice->id,
            'apprentice_responded' => false,
        ])->get();

        $notificationManagers = [];

        if ($apprenticeNotifications->count() > 0 ) {
            $managerIds = [];
            foreach ($apprenticeNotifications as $notification) {
                if(!in_array($notification->manager_id, $managerIds)) $managerIds[] = $notification->manager_id;
            }

            $notificationManagers = Manager::whereIn('id', $managerIds)->get();
        }

        return view('apprentice/notifications', compact('notificationManagers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notification $notification)
    {
        // if accepted: assign the apprentice to the manager and update the notification
        if ($request->accepted) {
            $apprenticeManager = new ApprenticeManager;
            $apprenticeManager->apprentice_id = Auth::user()->apprentice->id;
            $apprenticeManager->manager_id = $request->managerId;
            $apprenticeManager->save();

            Notification::where([
                'apprentice_id' => Auth::user()->apprentice->id,
                'manager_id' => $request->managerId,
            ])->update([
                'apprentice_responded' => true,
                'apprentice_accepted' => true
            ]);
        }
        // if not accepted: just update the notification
        else {
            Notification::where([
                'apprentice_id' => Auth::user()->apprentice->id,
                'manager_id' => $request->managerId,
            ])->update([
                'apprentice_responded' => true,
                'apprentice_accepted' => false
            ]);
        }

        return redirect()->route('apprentice_notifications')->with('success', 'Manager ' . ($request->accepted ? 'accepted' : 'rejected'));
    }
}
