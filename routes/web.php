<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    Route::get('/', function (){
        return redirect()->route('dashboard');
    });

    Route::get('/dashboard', action: [RoleController::class,'index'])->middleware(['auth', 'verified','role:admin'])->name( 'dashboard');
    Route::get('/client', action: [RoleController::class,'index'])->middleware(['auth', 'verified','role:client' ])->name('client');
    Route::get('/manager', action: [RoleController::class,'index'])->middleware(['auth', 'verified','role:manager'])->name('manager');
    Route::get('/agent', action: [RoleController::class,'index'])->middleware(['auth', 'verified','role:agent'])->name('agent');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
