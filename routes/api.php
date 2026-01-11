<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EquipApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/equips', [EquipApiController::class, 'index']);
Route::get('/equips/{id}', [EquipApiController::class, 'show']);
