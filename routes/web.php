<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;

// Главная страница с формой
Route::get('/', [BookingController::class, 'show'])->name('home');

// Обработка формы бронирования
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

// Страница успеха
Route::get('/booking/{booking}/success', [BookingController::class, 'success'])->name('booking.success');
