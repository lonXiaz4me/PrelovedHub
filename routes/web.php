<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public pages (guests can open these)
|--------------------------------------------------------------------------
*/
Route::get('/', HomeController::class)->name('home');
Route::view('/browse', 'pages.browse')->name('browse');
Route::view('/settings', 'pages.settings')->name('settings');

/*
|--------------------------------------------------------------------------
| Logged-in only (guests are redirected to the login page)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::view('/shop', 'pages.shop')->name('shop');
    Route::view('/sell', 'pages.sell')->name('sell');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
