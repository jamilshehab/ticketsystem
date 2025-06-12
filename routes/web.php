<?php

use App\Http\Controllers\Client\ClientTicketController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Roles\DashboardController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/client/view', [ClientTicketController::class, 'index'])->name('client.view');
    Route::get('/client/add', [ClientTicketController::class, 'create'])->name('client.create');
    Route::post('/client/add', [ClientTicketController::class, 'store'])->name('client.store');
    Route::get('/client/add', [ClientTicketController::class, 'create'])->name('client.create');
    Route::post('/client/add', [ClientTicketController::class, 'store'])->name('client.edit');
    Route::get('/client/{id}/edit', [ClientTicketController::class, 'edit'])->name('client.edit');
    Route::post('/client/edit', [ClientTicketController::class, 'update'])->name('client.edit');
    Route::get('/client/{id}', [ClientTicketController::class, 'show'])->name('client.show');
    Route::delete('/client/{id}',[ClientTicketController::class,'delete'])->name('client.destroy');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';
