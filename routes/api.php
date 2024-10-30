<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ExtrasController;
use App\Http\Controllers\Api\PlayeraController;
use App\Http\Controllers\Api\PulseraController;
use App\Http\Controllers\Api\SudaderaController;
use App\Http\Controllers\Api\TazasController;
use App\Http\Controllers\Api\TermoController;
use App\Http\Controllers\Api\LoginController;


use App\Http\Resources\PlayeraResource;
use App\Models\Extras;
use App\Models\Pulsera;
use App\Models\Sudadera;


Route::post('login', [LoginController::class, 'store']);

Route::middleware('auth:sanctum')->group(function(){
    Route::get('Extras',[ExtrasController::class, 'index']);
    Route::get('Extras/{Extras}',[ExtrasController::class, 'show']);
    
    
    Route::post('Extras',[ExtrasController::class, 'index']);
    Route::post('Extras/{Extras}',[ExtrasController::class, 'show']);
    
    Route::patch('Extras',[ExtrasController::class, 'index']);
    Route::patch('Extras/{Extras}',[ExtrasController::class, 'show']);
    
    Route::delete('Extras',[ExtrasController::class, 'index']);
    Route::delete('Extras/{Extras}',[ExtrasController::class, 'show']);
    
    
    Route::get('Termo',[TermoController::class, 'index']);
    Route::get('Termo/{termo}',[TermoController::class, 'show']);
    
    Route::post('Termo',[TermoController::class, 'index']);
    Route::post('Termo/{termo}',[TermoController::class, 'show']);
    
    Route::patch('Termo',[TermoController::class, 'index']);
    Route::patch('Termo/{termo}',[TermoController::class, 'show']);
    
    Route::delete('Termo',[TermoController::class, 'index']);
    Route::delete('Termo/{termo}',[TermoController::class, 'show']);
    
    
    Route::get('Tazas',[TazasController::class, 'index']);
    Route::get('Tazas/{Tazas}',[TazasController::class, 'show']);
    
    Route::post('Tazas',[TazasController::class, 'index']);
    Route::post('Tazas/{Tazas}',[TazasController::class, 'show']);
    
    Route::patch('Tazas',[TazasController::class, 'index']);
    Route::patch('Tazas/{Tazas}',[TazasController::class, 'show']);
    
    Route::delete('Tazas',[TazasController::class, 'index']);
    Route::delete('Tazas/{Tazas}',[TazasController::class, 'show']);
    
    
    Route::get('Sudadera',[SudaderaController::class, 'index']);
    Route::get('Suadadera/{sudadera}',[SudaderaController::class, 'show']);
    
    Route::post('Sudadera',[SudaderaController::class, 'index']);
    Route::post('Suadadera/{sudadera}',[SudaderaController::class, 'show']);
    
    Route::patch('Sudadera',[SudaderaController::class, 'index']);
    Route::patch('Suadadera/{sudadera}',[SudaderaController::class, 'show']);
    
    Route::delete('Sudadera',[SudaderaController::class, 'index']);
    Route::delete('Suadadera/{sudadera}',[SudaderaController::class, 'show']);
    
    
    Route::get('Pulsera',[PulseraController::class, 'index']);
    Route::get('Pulsera/{Pulsera}',[PulseraController::class, 'show']);
    
    Route::post('Pulsera',[PulseraController::class, 'index']);
    Route::post('Pulsera/{Pulsera}',[PulseraController::class, 'show']);
    
    Route::patch('Pulsera',[PulseraController::class, 'index']);
    Route::patch('Pulsera/{Pulsera}',[PulseraController::class, 'show']);
    
    Route::delete('Pulsera',[PulseraController::class, 'index']);
    Route::delete('Pulsera/{Pulsera}',[PulseraController::class, 'show']);
    
    
    Route::get('Playera',[PlayeraController::class, 'index']);
    Route::get('Playera/{Playera}',[PlayeraController::class, 'show']);
    
    Route::post('Playera',[PlayeraController::class, 'index']);
    Route::post('Playera/{Playera}',[PlayeraController::class, 'show']);
    
    Route::patch('Playera',[PlayeraController::class, 'index']);
    Route::patch('Playera/{Playera}',[PlayeraController::class, 'show']);
    
    Route::delete('Playera',[PlayeraController::class, 'index']);
    Route::delete('Playera/{Playera}',[PlayeraController::class, 'show']);
    
    Route::apiResource('Termo',TermoController::class);
    Route::apiResource('Taza',TazasController::class);
    Route::apiResource('Sudadera',SudaderaController::class);
    Route::apiResource('Pulsera',PulseraController::class);
    Route::apiResource('Playera',PlayeraController::class);

});





/*
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
*/