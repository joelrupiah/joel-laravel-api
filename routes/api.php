<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::get('admin/get-categories', [CategoryController::class, 'index']);
Route::post('admin/create-category', [CategoryController::class, 'store']);
Route::post('admin/update-category/{id}', [CategoryController::class, 'update']);
Route::delete('admin/delete-category/{id}', [CategoryController::class, 'destroy']);

Route::get('admin/get-clients', [ClientController::class, 'index']);
Route::post('admin/create-client', [ClientController::class, 'store']);
Route::post('admin/update-client/{id}', [ClientController::class, 'update']);
Route::delete('admin/delete-client/{id}', [ClientController::class, 'destroy']);

Route::get('admin/get-projects', [ProjectController::class, 'index']);
Route::post('admin/create-project', [ProjectController::class, 'store']);
Route::post('admin/update-project/{id}', [ProjectController::class, 'update']);
Route::delete('admin/delete-project/{id}', [ProjectController::class, 'destroy']);