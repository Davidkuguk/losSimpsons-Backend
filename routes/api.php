<?php

use App\Http\Controllers\PersonajeController;
use Illuminate\Support\Facades\Route;

Route::get('/personajes', [PersonajeController::class, 'index']);
Route::post('/personajes', [PersonajeController::class, 'apiStore']);
Route::delete('/personajes/{personaje}', [PersonajeController::class, 'apiDestroy']);
