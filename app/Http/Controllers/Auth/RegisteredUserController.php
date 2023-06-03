<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Models\Apprentice;
use App\Models\Manager;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use function Symfony\Component\Translation\t;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterUserRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            if ($request->role == 'apprentice') {
                $apprentice = Apprentice::create([
                    'user_id' => $user->id,
                    'candidate_number' => $request->candidate_number,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                ]);
            } else {
                $manager = Manager::create([
                    'user_id' => $user->id
                ]);
            }
            DB::commit();
        }
        catch (\Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route($user->apprentice ? 'apprentice_dashboard' : 'manager_dashboard');
    }
}
