<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\TicketController;

// Главная страница
Route::get('/', [BookingController::class, 'show'])->name('home');

// Бронирование коньков
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

// Покупка билетов
Route::post('/ticket', [TicketController::class, 'store'])->name('ticket.store');

// Страница успеха
Route::get('/booking/{booking}/success', [BookingController::class, 'success'])->name('booking.success');
