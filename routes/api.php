<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ExtrasController;
use App\Http\Controllers\Api\PlayeraController;
use App\Http\Controllers\Api\PulseraController;
use App\Http\Controllers\Api\SudaderaController;
use App\Http\Controllers\Api\TazasController;
use App\Http\Controllers\Api\TermoController;
use App\Http\Resources\PlayeraResource;
use App\Models\Extras;
use App\Models\Pulsera;
use App\Models\Sudadera;

Route::get('Extras',[ExtrasController::class, 'index']);
Route::get('Extras/{Extras}',[ExtrasController::class, 'show']);

Route::get('Termo',[TermoController::class, 'index']);
Route::get('Termo/{termo}',[TermoController::class, 'show']);

Route::get('Tazas',[TazasController::class, 'index']);
Route::get('Tazas/{Tazas}',[TazasController::class, 'show']);

Route::get('Sudadera',[SudaderaController::class, 'index']);
Route::get('Suadadera/{sudadera}',[SudaderaController::class, 'show']);

Route::get('Pulsera',[PulseraController::class, 'index']);
Route::get('Pulsera/{Pulsera}',[PulseraController::class, 'show']);

Route::get('Playera',[PlayeraController::class, 'index']);
Route::get('Playera/{Playera}',[PlayeraController::class, 'show']);

Route::apiResource('Termo',TermoController::class);
Route::apiResource('Taza',TazasController::class);
Route::apiResource('Sudadera',SudaderaController::class);
Route::apiResource('Pulsera',PulseraController::class);
Route::apiResource('Playera',PlayeraController::class);
/*
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
*/