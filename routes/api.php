<?php

use App\Http\Controllers\Api\SalaController;
use App\Http\Controllers\Api\ReservaSalaController;
use Illuminate\Support\Facades\Route;

// Rotas para a API de reserva_salas
Route::prefix('reserva_salas')->group(function () {
    Route::get('/', [ReservaSalaController::class, 'index']); 
    Route::get('/{salas}', [ReservaSalaController::class, 'show']); 
    Route::post('/', [ReservaSalaController::class, 'store']);
    Route::put('/{salas}', [ReservaSalaController::class, 'update']);
    Route::delete('/{salas}', [ReservaSalaController::class, 'destroy']); 
});

// Rotas para a API de salas
Route::prefix('salas')->group(function () {
    Route::get('/', [SalaController::class, 'index']);
    Route::get('/{sala}', [SalaController::class, 'show']);
    Route::post('/', [SalaController::class, 'store']);
    Route::put('/{id}', [SalaController::class, 'update']);  
    Route::delete('/{sala}', [SalaController::class, 'destroy']);
});
