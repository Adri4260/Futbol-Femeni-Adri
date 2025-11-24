<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipController;
use App\Http\Controllers\EstadiController;
use App\Http\Controllers\JugadoraController;
use App\Http\Controllers\PartitController;

Route::get('/', function () {
    return redirect()->route('equips.index');
});

// ---------- EQUIPS (mini-guia base) ----------
Route::get('/equips', [EquipController::class, 'index'])->name('equips.index');
Route::get('/equips/create', [EquipController::class, 'create'])->name('equips.create');
Route::post('/equips', [EquipController::class, 'store'])->name('equips.store');
Route::get('/equips/{id}', [EquipController::class, 'show'])->name('equips.show');


// ---------- ESTADIS ----------
Route::get('/estadis', [EstadiController::class, 'index'])->name('estadis.index');
Route::get('/estadis/crear', [EstadiController::class, 'create'])->name('estadis.create');
Route::post('/estadis', [EstadiController::class, 'store'])->name('estadis.store');

// ---------- JUGADORES ----------
Route::get('/jugadores', [JugadoraController::class, 'index'])->name('jugadores.index');
Route::get('/jugadores/crear', [JugadoraController::class, 'create'])->name('jugadores.create');
Route::post('/jugadores', [JugadoraController::class, 'store'])->name('jugadores.store');

// ---------- PARTITS ----------
Route::get('/partits', [PartitController::class, 'index'])->name('partits.index');
Route::get('/partits/crear', [PartitController::class, 'create'])->name('partits.create');
Route::post('/partits', [PartitController::class, 'store'])->name('partits.store');

Route::resource('equips', EquipController::class);
Route::resource('estadis', EstadiController::class);
Route::resource('jugadores', JugadoraController::class);
Route::resource('partits', PartitController::class);
