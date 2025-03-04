<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ProductController;

Route::get('/', [ProductController::class, 'index']);
Route::get('/user/{userId}/products', [ProductController::class, 'showUserProducts'])->name('user.products');

Route::get('/login', function () {
    return 'Need token';
})->name('login');
