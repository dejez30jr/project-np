<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BerandaController::class, 'index']);

Route::get('/portfolio/{portfolio}', [BerandaController::class, 'show'])->name('portfolio.show');

Route::post('/kirim-pesan', [ContactController::class, 'store'])
    ->name('contact.send')
    ->middleware('throttle:contact');
