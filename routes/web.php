<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

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

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'addProduct'])->name('cart.add');
    Route::patch('/cart/{cart}', [CartController::class, 'updateQuantity'])->name('cart.update');
    Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');

    Route::get('/checkout', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/checkout', [OrderController::class, 'store'])->name('orders.store');

    Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('orders.my');
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

    Route::get('/admin/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::patch('/admin/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
});

require __DIR__.'/auth.php';

Route::view('/', 'index')->name('home');
Route::view('/about', 'about')->name('about');
//Route::view('/catalog', 'catalog')->name('catalog');
Route::view('/services', 'services')->name('services');
Route::view('/reviews', 'reviews')->name('reviews');
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');
