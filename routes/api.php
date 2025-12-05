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
use App\Models\Termo;


Route::options('{all:.*}', function (){
    return response()->json();
});

Route::post('login',[LoginController::class,'store']);

Route::middleware('auth:sanctum')->group(function() {

Route::apiResource('Extras',ExtrasController::class);
Route::apiResource('Taza',TazasController::class);
Route::apiResource('Sudadera',SudaderaController::class);
Route::apiResource('Pulsera',PulseraController::class);
Route::apiResource('Playera',PlayeraController::class);
Route::apiResource('Termo',TermoController::class);



});

