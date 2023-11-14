<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PrecioController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProyectoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/v1/precios', [PrecioController::class, 'getPrecios']);

Route::get('/v1/usuarios', [UsuarioController::class, 'getUsers']);

Route::get('/v1/proyectos', [ProyectoController::class, 'getProyectos']);
Route::get('/v1/proyectos/{id}', [ProyectoController::class, 'getUnProyecto']);
Route::post('/v1/proyectos/create', [ProyectoController::class, 'createProyecto']);
Route::put('/v1/proyectos/update/{id}', [ProyectoController::class, 'updateProyecto']);
Route::delete('/v1/proyectos/delete/{id}', [ProyectoController::class, 'deleteProyecto']);

Route::get('/v1/items', [ItemController::class, 'getItems']);
Route::post('/v1/items/create', [ItemController::class, 'createItem']);
Route::put('/v1/items/update/{id}', [ItemController::class, 'updateItem']);
Route::delete('/v1/items/delete/{id}', [ItemController::class, 'deleteItem']);



