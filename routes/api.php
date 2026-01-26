<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EquipApiController;
use App\Http\Controllers\Api\EstadiApiController;
use App\Http\Controllers\Api\PartitApiController;
use App\Http\Controllers\Api\AuthController;

// Autenticació Pública
Route::post('/login', [AuthController::class, 'login']);

// Rutes Protegides (Requereixen Token)
Route::middleware('auth:sanctum')->group(function () {

    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // Recursos API
    Route::apiResource('equips', EquipApiController::class);
    Route::apiResource('estadis', EstadiApiController::class);
    Route::apiResource('partits', PartitApiController::class);
});
