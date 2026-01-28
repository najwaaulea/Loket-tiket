<?php

use App\Http\Controllers\{EventCategoryController,EventController,CustomerController,OrderController};
use Illuminate\Support\Facades\Route;

Route::get('/loket', fn() => redirect()->route('events.index'));

Route::resource('event-categories', EventCategoryController::class)->except(['show']);
Route::resource('events', EventController::class)->except(['show']);
Route::resource('customers', CustomerController::class)->except(['show']);
Route::resource('orders', OrderController::class)->except(['show']);

Route::patch('orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');

