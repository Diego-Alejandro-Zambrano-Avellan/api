<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CinemaController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('cinemas', CinemaController::class);
Route::apiResource('cinemas.rooms', RoomController::class);
Route::post('cinemas/{cinema}/rooms', [RoomController::class, 'store']);
Route::get('rooms/{room}/available-seats', [ReservationController::class, 'availableSeats']);
Route::post('rooms/{room}/reserve', [ReservationController::class, 'store']);
Route::post('reserve', [ReservationController::class, 'reserve']);
