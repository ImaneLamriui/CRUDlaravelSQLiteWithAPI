<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\materiaController;

Route::get('/materias', [materiaController::class, 'index']);

Route::get('/materias/{id}',[materiaController::class, 'show']);

Route::post('/materias', [materiaController::class, 'store']);

Route::put('/materias/{id}', [materiaController::class, 'update']);

Route::patch('/materias/{id}', [materiaController::class, 'updatesParcial']);

Route::delete('/materias/{id}',[materiaController::class, 'destroy']);
