<?php

use App\Http\Controllers\Apprentice\DashboardController as ApprenticeDashboard;
use App\Http\Controllers\Manager\ApprenticeController;
use App\Http\Controllers\ApprenticeModuleController;
use App\Http\Controllers\Manager\DashboardController as ManagerDashboard;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

if (env('APP_ENV') === 'production') {
    \URL::forceScheme('https');
}

Route::get('/', function () {
    return view('index');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/modules', [ApprenticeDashboard::class, 'index'])->name('apprentice_dashboard');
    Route::get('/apprentices', [ManagerDashboard::class, 'index'])->name('manager_dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/module/{apprenticeModule}', [ApprenticeModuleController::class, 'edit'])->name('apprentice_module.edit');
    Route::patch('/module/{apprenticeModule}', [ApprenticeModuleController::class, 'update'])->name('apprentice_module.update');
    Route::delete('/module/{apprenticeModule}', [ApprenticeModuleController::class, 'destroy'])->name('apprentice_module.destroy');
    Route::get('/add-modules', [ApprenticeModuleController::class, 'index'])->name('apprentice_module.index');
    Route::post('/add-modules', [ApprenticeModuleController::class, 'store'])->name('apprentice_module.store');


    Route::get('/apprentices/{apprentice}', [ApprenticeController::class, 'show'])->name('apprentices.show');

    Route::get('/my-apprentices', [ApprenticeController::class, 'listManagerApprentices'])->name('manager_apprentices');
    Route::get('/remove-apprentice/{apprentice}', [ApprenticeController::class, 'removeManagerApprentice'])->name('remove_manager_apprentice');
    Route::get('/add-apprentice', [ApprenticeController::class, 'addManagerApprentice'])->name('add_manager_apprentice');

    Route::get('/apprentice-notifications', [\App\Http\Controllers\Apprentice\NotificationController::class, 'index'])->name('apprentice_notifications');
    Route::get('/apprentice-notifications/update', [\App\Http\Controllers\Apprentice\NotificationController::class, 'update'])->name('update_notification');
    Route::get('/manager-notifications', [\App\Http\Controllers\Manager\NotificationController::class, 'index'])->name('manager_notifications');
    Route::get('/apprentice-notifications/delete', [\App\Http\Controllers\Manager\NotificationController::class, 'delete'])->name('delete_notification');
});

require __DIR__.'/auth.php';
