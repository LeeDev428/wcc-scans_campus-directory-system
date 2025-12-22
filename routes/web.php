<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/homepage', function () {
    return view('homepage');
})->name('homepage');

Route::get('/campus-directory', function () {
    return view('campus-directory');
})->name('campus.directory');

Route::get('/campus-policies', function () {
    return view('campus-policies');
})->name('campus.policies');

Route::get('/submit-ticket', function () {
    return view('submit-ticket');
})->name('submit.ticket');

Route::post('/submit-ticket', [TicketController::class, 'store'])->name('ticket.store');

Route::get('/rate-experience', [TicketController::class, 'showRating'])->name('rate.experience');

Route::post('/rate-experience', [TicketController::class, 'storeRating'])->name('rating.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/tickets', [TicketController::class, 'adminIndex'])->name('tickets.index');
    Route::patch('/tickets/{ticket}/status', [TicketController::class, 'updateStatus'])->name('tickets.update-status');
    Route::delete('/tickets/{ticket}', [TicketController::class, 'destroy'])->name('tickets.destroy');
});

require __DIR__.'/auth.php';
