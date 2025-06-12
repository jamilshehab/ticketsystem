<?php

use App\Http\Controllers\Client\ClientTicketController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Roles\DashboardController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
   Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
   Route::resource('client', ClientTicketController::class)->names([
    'index' => 'client.view',
    'create' => 'client.create',
    'store' => 'client.store',
    'edit' => 'client.edit',
    'show' => 'client.show',
    'destroy' => 'client.delete', // Use 'destroy' not 'delete'
]);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';
