<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AttendeeController;
use App\Http\Controllers\BookingController;

Route::apiResource('events', EventController::class)->except(['create', 'edit']);
Route::apiResource('attendees', AttendeeController::class)->only(['store', 'show']);
Route::post('bookings', [BookingController::class, 'store']);
