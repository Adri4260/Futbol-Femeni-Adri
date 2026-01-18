<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EquipController;
use App\Http\Controllers\EstadiController;
use App\Http\Controllers\JugadoraController;
use App\Http\Controllers\PartitController;
use App\Models\Equip; // <--- IMPORTANT: Importar el model Equip
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('equips.index');
});

// --- RUTA DEL DASHBOARD AMB CLASSIFICACIÓ ORDENADA ---
Route::get('/dashboard', function () {
    // Aquesta línia és la CLAU. Calcula els punts i ordena de major a menor.
    $equips = Equip::all()->sortByDesc('punts')->values();

    return view('dashboard', compact('equips'));
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- RUTES PÚBLIQUES (Canviar idioma) ---
Route::get('language/{locale}', function ($locale) {
    if (in_array($locale, ['ca', 'es', 'en'])) {
        session(['locale' => $locale]);
    }
    return back();
})->name('language');

// --- RUTES PÚBLIQUES (Vistes Generals) ---
Route::get('/equips', [EquipController::class, 'index'])->name('equips.index');
Route::get('/estadis', [EstadiController::class, 'index'])->name('estadis.index');
Route::get('/jugadores', [JugadoraController::class, 'index'])->name('jugadores.index');
Route::get('/partits', [PartitController::class, 'index'])->name('partits.index');
Route::get('/historic', [PartitController::class, 'historic'])->name('partits.historic');
Route::get('/partits/{partit}/acta', [PartitController::class, 'acta'])->name('partits.acta');

// --- ADMIN I MANAGER (Gestió d'Equips i Jugadores) ---
Route::middleware(['auth', 'role:admin,manager'])->group(function () {
    // Equips
    Route::get('/equips/create', [EquipController::class, 'create'])->name('equips.create');
    Route::post('/equips', [EquipController::class, 'store'])->name('equips.store');
    Route::get('/equips/{equip}/edit', [EquipController::class, 'edit'])->name('equips.edit');
    Route::put('/equips/{equip}', [EquipController::class, 'update'])->name('equips.update');
    Route::delete('/equips/{equip}', [EquipController::class, 'destroy'])->name('equips.destroy');

    // Jugadores
    Route::get('/jugadores/crear', [JugadoraController::class, 'create'])->name('jugadores.create');
    Route::post('/jugadores', [JugadoraController::class, 'store'])->name('jugadores.store');
    Route::get('/jugadores/{jugadora}/editar', [JugadoraController::class, 'edit'])->name('jugadores.edit');
    Route::put('/jugadores/{jugadora}', [JugadoraController::class, 'update'])->name('jugadores.update');
    Route::delete('/jugadores/{jugadora}', [JugadoraController::class, 'destroy'])->name('jugadores.destroy');
});

// --- NOMÉS ADMIN (Gestió d'Estadis i Crear/Esborrar Partits) ---
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Estadis
    Route::get('/estadis/crear', [EstadiController::class, 'create'])->name('estadis.create');
    Route::post('/estadis', [EstadiController::class, 'store'])->name('estadis.store');
    Route::get('/estadis/{estadi}/editar', [EstadiController::class, 'edit'])->name('estadis.edit');
    Route::put('/estadis/{estadi}', [EstadiController::class, 'update'])->name('estadis.update');
    Route::delete('/estadis/{estadi}', [EstadiController::class, 'destroy'])->name('estadis.destroy');

    // Partits (Crear i Esborrar només per a Admin)
    Route::get('/partits/crear', [PartitController::class, 'create'])->name('partits.create');
    Route::post('/partits', [PartitController::class, 'store'])->name('partits.store');
    Route::delete('/partits/{partit}', [PartitController::class, 'destroy'])->name('partits.destroy');
});

// --- ADMIN I ÀRBITRE (Editar Partits) ---
Route::middleware(['auth', 'role:admin,arbitre'])->group(function () {
    Route::get('/partits/{partit}/editar', [PartitController::class, 'edit'])->name('partits.edit');
    Route::put('/partits/{partit}', [PartitController::class, 'update'])->name('partits.update');
});

// Rutes comodí al final
Route::get('/equips/{id}', [EquipController::class, 'show'])->name('equips.show');
Route::get('/estadis/{estadi}', [EstadiController::class, 'show'])->name('estadis.show');

require __DIR__ . '/auth.php';
