<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ExtrasController;
use App\Http\Controllers\Api\PlayeraController;
use App\Http\Controllers\Api\PulseraController;
use App\Http\Controllers\Api\SudaderaController;
use App\Http\Controllers\Api\TazasController;
use App\Http\Controllers\Api\TermoController;


Route::get('Termo',[TermoController::class, 'index']);
Route::get('Termo/{termo}',[TermoController::class, 'show']);

/*
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
*/