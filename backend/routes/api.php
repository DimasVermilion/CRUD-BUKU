<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Semua route menggunakan middleware auth:sanctum
// Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Buku
    Route::get('list-buku', [BukuController::class, 'index']);
    Route::post('store-buku', [BukuController::class, 'store']);
    Route::get('read-buku/{id}', [BukuController::class, 'show']);
    Route::put('update-buku/{id}', [BukuController::class, 'update']);
    Route::delete('delete-buku/{id}', [BukuController::class, 'destroy']);

    // Kategori
    Route::get('list-category', [CategoryController::class, 'index']);
    Route::get('list-category-book/{id}', [CategoryController::class, 'showBook']);
    Route::post('store-category', [CategoryController::class, 'store']);
    Route::get('read-category/{id}', [CategoryController::class, 'show']);
    Route::put('update-category/{id}', [CategoryController::class, 'update']);
    Route::delete('delete-category/{id}', [CategoryController::class, 'destroy']);

    // Auth (Login, Register, Logout)
    Route::post('logout', [AuthController::class, 'logout']);
// });

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);