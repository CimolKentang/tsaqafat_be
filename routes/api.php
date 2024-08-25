<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BiographyController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\GenerationController;
use App\Http\Resources\DataResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/biographies', [BiographyController::class, 'index']);
Route::get('/biographies/{id}', [BiographyController::class, 'show']);
Route::post('/biographies', [BiographyController::class, 'store']);
Route::put('/biographies/{id}', [BiographyController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/biographies/{id}', [BiographyController::class, 'destroy'])->middleware('auth:sanctum');

Route::get('/', function() {
  return new DataResource(false, "Unauthorized", null);
})->name('login');

Route::get('/field', [FieldController::class, 'index']);
Route::get('/field/{id}', [FieldController::class, 'show']);
Route::post('/field', [FieldController::class, 'store']);
Route::put('/field/{id}', [FieldController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/field/{id}', [FieldController::class, 'destroy'])->middleware('auth:sanctum');

Route::get('/generation', [GenerationController::class, 'index']);
Route::get('/generation/{id}', [GenerationController::class, 'show']);
Route::post('/generation', [GenerationController::class, 'store']);
Route::put('/generation/{id}', [GenerationController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/generation/{id}', [GenerationController::class, 'destroy'])->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
