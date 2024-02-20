<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\StripeController;

Route::get('/', [PageController::class, 'stripe']);

Route::post('/stripe', [StripeController::class, 'pay'])->name('stripe.pay');
Route::get('/stripe/success', [StripeController::class, 'success'])->name('stripe.success');
Route::get('/stripe/cancel', [StripeController::class, 'cancel'])->name('stripe.cancel');