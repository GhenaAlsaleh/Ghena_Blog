<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/categories', [CategoryController::class,"index"]);
Route::post('/categories', [CategoryController::class,"store"]);
Route::get('/categories/{id}', [CategoryController::class,"show"]);
Route::put('/categories/{id}', [CategoryController::class,"update"]);
Route::delete('/categories/{id}', [CategoryController::class,"destroy"]);

Route::get('/tags', [TagController::class,"index"]);
Route::post('/tags', [TagController::class,"store"]);
Route::get('/tags/{id}', [TagController::class,"show"]);
Route::put('/tags/{id}', [TagController::class,"update"]);
Route::delete('/tags/{id}', [TagController::class,"destroy"]);