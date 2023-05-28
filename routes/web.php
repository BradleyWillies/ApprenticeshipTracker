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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/modules', [ApprenticeDashboard::class, 'index'])->name('apprenticeDashboard');
    Route::get('/apprentices', [ManagerDashboard::class, 'index'])->name('managerDashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/module/{apprenticeModule}', [ApprenticeModuleController::class, 'edit'])->name('apprentice_module.edit');
    Route::patch('/module/{apprenticeModule}', [ApprenticeModuleController::class, 'update'])->name('apprentice_module.update');
    Route::delete('/module/{apprenticeModule}', [ApprenticeModuleController::class, 'destroy'])->name('apprentice_module.destroy');

    Route::get('/apprentices/{apprentice}', [ApprenticeController::class, 'show'])->name('apprentices.show');
});

require __DIR__.'/auth.php';
