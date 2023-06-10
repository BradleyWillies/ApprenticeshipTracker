<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;
use Illuminate\View\View;

class NavNotification extends Component
{
    /**
     * Create the component instance.
     */
    public function __construct(
        public int $count = 0,
    ) {
        $cacheKey = auth()->user()->id;

        $this->count = Cache::get('notification-count-' . $cacheKey, function () use ($cacheKey) {
            $query = DB::table('notifications');

            if (auth()->user()->apprentice) {
                $query
                    ->where('apprentice_id', '=', auth()->user()->apprentice->id)
                    ->where('apprentice_responded', '=', false)
                    ->groupBy('manager_id');
            }
            else {
                $query
                    ->where('manager_id', '=', auth()->user()->manager->id)
                    ->where('apprentice_responded', '=', true)
                    ->groupBy('apprentice_id');

            }

            $queryCount = $query->get()->count();

            Cache::put('notification-count-' . $cacheKey, $queryCount);

            return $queryCount;
        });
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('components.nav-notification');
    }
}
