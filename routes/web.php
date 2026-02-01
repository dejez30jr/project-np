<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\ContactController;

Route::get('/', [BerandaController::class, 'index']);

Route::post('/kirim-pesan', [ContactController::class, 'store'])->name('contact.send');
