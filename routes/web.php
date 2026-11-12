<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::view('/', 'index')->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/catalog', 'catalog')->name('catalog');
Route::view('/services', 'services')->name('services');
Route::view('/reviews', 'reviews')->name('reviews');
Route::view('/cart', 'cart')->name('cart');
