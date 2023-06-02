<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Apprentice;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        // ensure that the user is a manager, otherwise show the forbidden error screen
        if (!auth()->user()->manager) abort(403);

        $notifications = DB::table('notifications')
            ->where('manager_id', '=', auth()->user()->manager->id)
            ->where('apprentice_responded', '=', true)
            ->groupBy('apprentice_id')
            ->get();

        $apprentices = [];

        if ($notifications->count() > 0) {
            foreach ($notifications as $notification) {
                $apprentices[] = Apprentice::where('id', $notification->apprentice_id)->first();
            }
        }

        return view('manager/notifications', compact('notifications', 'apprentices'));
    }

    /**
     * Delete the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        $notification = Notification::find($request->notificationId);
        $notification->delete();

        return redirect()->route('manager_notifications')->with('success', 'Notification deleted');
    }
}
