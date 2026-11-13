<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CatalogController;

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

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::patch('/users/{user}/role', [UserController::class, 'updateRole'])->name('users.updateRole');
//    Route::get('/catalog/create', [CatalogController::class, 'create'])->name('catalog.create');
//    Route::post('/catalog', [CatalogController::class, 'store'])->name('catalog.store');
});

Route::middleware(['auth', 'role:admin,manager'])->group(function () {
    Route::get('/catalog/create', [CatalogController::class, 'create'])->name('catalog.create');
    Route::post('/catalog', [CatalogController::class, 'store'])->name('catalog.store');

    Route::get('/catalog/{product}/edit', [CatalogController::class, 'edit'])->name('catalog.edit');
    Route::put('/catalog/{product}', [CatalogController::class, 'update'])->name('catalog.update');
    Route::delete('/catalog/{product}', [CatalogController::class, 'destroy'])->name('catalog.destroy');
});

require __DIR__.'/auth.php';

Route::view('/', 'index')->name('home');
Route::view('/about', 'about')->name('about');
//Route::view('/catalog', 'catalog')->name('catalog');
Route::view('/services', 'services')->name('services');
Route::view('/reviews', 'reviews')->name('reviews');
Route::view('/cart', 'cart')->name('cart');
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');
