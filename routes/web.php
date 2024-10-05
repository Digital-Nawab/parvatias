<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
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
});



require __DIR__.'/auth.php';
