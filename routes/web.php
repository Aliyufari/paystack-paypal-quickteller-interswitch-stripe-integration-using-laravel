<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\PaystackController;
use App\Http\Controllers\QuickTellerController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/stripe', [PageController::class, 'stripe'])->name('stripe');
Route::get('/paystack', [PageController::class, 'paystack'])->name('paystack');
Route::get('/quickteller', [PageController::class, 'quickteller'])->name('quickteller');

// Stripe Routes
Route::post('/stripe', [StripeController::class, 'pay'])->name('stripe.pay');
Route::get('/stripe/success', [StripeController::class, 'success'])->name('stripe.success');
Route::get('/stripe/cancel', [StripeController::class, 'cancel'])->name('stripe.cancel');

// Paystack Routes
Route::get('/paystack/callback', [PaystackController::class, 'callback'])->name('paystack.callback');
Route::get('/paystack/success', [PaystackController::class, 'success'])->name('paystack.success');
Route::get('/paystack/cancel', [PaystackController::class, 'cancel'])->name('paystack.cancel');

// QuickTeller InterSwictch Routes
Route::get('/quickteller/checkout', [QuickTellerController::class, 'pay'])->name('quickteller.pay');
Route::post('/quickteller/success', [QuickTellerController::class, 'success'])->name('quickteller.success');
Route::get('/quickteller/cancel', [QuickTellerController::class, 'cancel'])->name('quickteller.cancel');