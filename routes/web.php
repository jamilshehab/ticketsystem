<?php

use App\Http\Controllers\Agent\AgentController;
use App\Http\Controllers\Client\ClientTicketController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Roles\DashboardController;
use Illuminate\Support\Facades\Route;
 

Route::resource('client', controller: ClientTicketController::class)->middleware(['auth','role:client']);


Route::middleware(["auth","role:agent"])->group(function () {
Route::get("/agent",[AgentController::class,"index"])->name("agent.view");
});

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    //routes for clients view
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';

