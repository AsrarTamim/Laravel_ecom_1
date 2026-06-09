<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

// Product
Route::get('/products',[ProductController::class, 'index'])->name('products.index');
Route::middleware(['auth', 'admin'])->group(function () {
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
});
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// Category
Route::middleware(['auth', 'admin'])->group(function () {
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::get('/categories',[CategoryController::class, 'index'])->name('categories.index');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{id}',[CategoryController::class, 'destory']) -> name('categories.destroy');
});

//cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

//checkout
Route::get('/checkout', [OrderController::class, 'create'])->name('checkout');
Route::post('/checkout', [OrderController::class, 'store'])->name('orders.store');

//order
Route::get('/orders', [OrderController::class, 'index'])->middleware('auth')->name('orders.index');
Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');

//Auth
Route::get('/register', [AuthController::class, 'showRegister']) ->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//admin
Route::get('/admin/orders', [OrderController::class, 'adminIndex'])->middleware(['auth', 'admin'])->name('admin.orders');

//dashboard
Route::get('/admin', [DashboardController::class, 'index'])->middleware(['auth', 'admin'])->name('admin.dashboard');