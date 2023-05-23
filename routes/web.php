<?php

use App\Http\Controllers\ApprenticeModuleController;
use App\Http\Controllers\DashboardController;
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
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/module/{apprenticeModule}', [ApprenticeModuleController::class, 'edit'])->name('apprentice_module.edit');
    Route::patch('/module/{apprenticeModule}', [ApprenticeModuleController::class, 'update'])->name('apprentice_module.update');
    Route::delete('/module/{apprenticeModule}', [ApprenticeModuleController::class, 'destroy'])->name('apprentice_module.destroy');
});

require __DIR__.'/auth.php';
