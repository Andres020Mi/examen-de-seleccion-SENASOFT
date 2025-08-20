<?php

use App\Http\Controllers\EventoController;
use App\Http\Controllers\proyectosController;
use App\Http\Controllers\semilleros;
use App\Http\Controllers\integrantes;
use App\Http\Controllers\proyectoPertenesco;
use App\Http\Controllers\TrabajoController;
use App\Models\integrante;
use Illuminate\Support\Facades\Route;




Route::middleware(['auth', 'role:user1'])->group(function () {});



// Listar semilleros
Route::get('/semilleros', [semilleros::class, 'index'])->name('modulos.semilleros.index');

// Formulario para crear semillero
Route::get('/semilleros/create', [semilleros::class, 'create'])->name('modulos.semilleros.create');

// Guardar semillero
Route::post('/semilleros', [semilleros::class, 'store'])->name('modulos.semilleros.store');

// Eliminar semillero
Route::delete('/semilleros/{semillero}', [semilleros::class, 'destroy'])->name('modulos.semilleros.destroy');






// Listar proyectos
Route::get('/proyectos', [proyectosController::class, 'index'])->name('modulos.proyectos.index');

// Formulario para crear proyecto
Route::get('/proyectos/create', [proyectosController::class, 'create'])->name('modulos.proyectos.create');

// Guardar proyecto
Route::post('/proyectos', [proyectosController::class, 'store'])->name('modulos.proyectos.store');


// Editar
Route::get('/proyectos/{proyecto}/edit', [proyectosController::class, 'edit'])->name('modulos.proyectos.edit');
Route::put('/proyectos/{proyecto}', [proyectosController::class, 'update'])->name('modulos.proyectos.update');



// Eliminar proyecto
Route::delete('/proyectos/{proyecto}', [proyectosController::class, 'destroy'])->name('modulos.proyectos.destroy');




// proyectos a los que perteneesco 

// Listar proyectos
Route::get('/proyectos/pertenesco', [proyectoPertenesco::class, 'index'])->name('modulos.proyecto_pertenesco.index');




Route::prefix('modulos')->name('modulos.')->group(function () {
    Route::get('integrantes', [integrantes::class, 'index'])->name('integrantes.index');
    Route::get('integrantes/create', [integrantes::class, 'create'])->name('integrantes.create');
    Route::post('integrantes', [integrantes::class, 'store'])->name('integrantes.store');
    Route::delete('integrantes/{integrante}', [integrantes::class, 'destroy'])->name('integrantes.destroy');
});




// trabajos


// Mostrar todos los proyectos con sus trabajos
Route::get('/trabajos', [TrabajoController::class, 'index'])->name('modulos.trabajos.index');

// Registrar trabajo para un proyecto
Route::get('/trabajos/{proyecto}/create', [TrabajoController::class, 'create'])->name('modulos.trabajos.create');
Route::post('/trabajos/{proyecto}', [TrabajoController::class, 'store'])->name('modulos.trabajos.store');










Route::prefix('modulos/eventos')->name('modulos.eventos.')->group(function () {
    Route::get('/', [EventoController::class, 'index'])->name('index');       // Listar eventos
       Route::get('/calendario', [EventoController::class, 'calendario'])->name('calendario');       // Listar eventos
    Route::get('/create', [EventoController::class, 'create'])->name('create'); // Formulario de creación
    Route::post('/', [EventoController::class, 'store'])->name('store');        // Guardar evento
    Route::get('/{id}/edit', [EventoController::class, 'edit'])->name('edit');  // Editar (opcional)
    Route::put('/{id}', [EventoController::class, 'update'])->name('update');   // Actualizar (opcional)
    Route::delete('/{id}', [EventoController::class, 'destroy'])->name('destroy'); // Eliminar
});


Route::patch('/proyectos/{proyecto}/fase', [\App\Http\Controllers\proyectosController::class, 'updateFase'])
    ->name('modulos.proyectos.updateFase');



Route::get('/', function () {
    return view('welcome');
});



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
