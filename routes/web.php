<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;

// Jalur navigasi untuk 4 halaman utama
Route::get('/', [TicketController::class, 'index'])->name('movies.index');
Route::get('/movie/{id}', [TicketController::class, 'show'])->name('movies.show');
Route::get('/movie/{id}/book', [TicketController::class, 'book'])->name('movies.book');
Route::post('/movie/{id}/checkout', [TicketController::class, 'checkout'])->name('movies.checkout');