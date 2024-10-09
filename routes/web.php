<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
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
    Route::match(['get', 'post'],'/add-category/{id?}', [CategoryController::class, 'AddCategory']);
    Route::get('/all-category', [CategoryController::class, 'AllCategory']);
    Route::get('/delete-category/{id?}', [CategoryController::class, 'DeleteCategory']);
    Route::match(['get', 'post'], '/add-tag/{id?}', [TagController::class, 'AddTag']);
    Route::match(['get', 'post'],'/add-product/{id?}', [ProductController::class, 'AddProduct']);
    Route::get('/all-product', [ProductController::class, 'AllProduct']);
    Route::get('/delete-product/{id?}', [ProductController::class, 'DeleteProduct']);
    Route::match(['get', 'post'],'/add-stock/{id?}', [StockController::class, 'store']);
    Route::resource('coupons', CouponController::class);
});



require __DIR__.'/auth.php';
