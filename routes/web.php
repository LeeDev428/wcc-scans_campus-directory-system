<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
