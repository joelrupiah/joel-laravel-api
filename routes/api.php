<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;

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