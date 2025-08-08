<?php

use App\Http\Controllers\Agent\AgentController;
use App\Http\Controllers\Client\ClientTicketController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\Manager\ManagerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Roles\DashboardController;
use App\Http\Controllers\UserRoleController;
use Illuminate\Support\Facades\Route;
 

Route::resource('client', controller: ClientTicketController::class)->middleware(['auth','role:client']);


Route::middleware(["auth","role:agent"])->group(function () {
Route::get("/agent",[AgentController::class,"index"])->name("agent.view");
Route::put('/agent/tickets/{id}', [AgentController::class, 'update'])->name('agent.update');
Route::get('/agent/tickets/{id}', [AgentController::class, 'show'])->name('agent.show');


});
Route::middleware(['auth', 'role:manager'])->group(function () {
    Route::get('/manager', [ManagerController::class, 'index'])->name('manager.view');
    Route::post('/manager/assign/{id}', [ManagerController::class, 'assign'])->name('tickets.assign');
    Route::get('/manager/show/{id}', [ManagerController::class, 'show'])->name('tickets.show');

    Route::get('/userRoles',[UserRoleController::class,'index'])->name('user.index');
    Route::post('/userRoles/assign/{id}',[UserRoleController::class,'assign'])->name('manager.update');
    Route::resource('department',DepartmentController::class)->except('show');
    
}); 


Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    //routes for clients view
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';

