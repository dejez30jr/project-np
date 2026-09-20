<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\ClientRegisterController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BerandaController::class, 'index']);

Route::get('/client/register', [ClientRegisterController::class, 'create'])->name('client.register');

Route::post('/client/register', [ClientRegisterController::class, 'store'])
    ->name('client.register.store')
    ->middleware('throttle:client');

Route::get('/portfolio/{portfolio}', [BerandaController::class, 'show'])->name('portfolio.show');

Route::post('/kirim-pesan', [ContactController::class, 'store'])
    ->name('contact.send')
    ->middleware('throttle:contact');
