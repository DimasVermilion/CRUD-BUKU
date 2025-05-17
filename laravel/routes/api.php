<?php

use App\Http\Controllers\BukuController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('list-buku', [BukuController::class, 'index']);


Route::post('store-buku', [BukuController::class, 'store']);


Route::get('read-artikel/{id}',[BukuController::class,'show']);

Route::put('update-artikel/{id}',[BukuController::class,'update']);


Route::delete('delete-artikel/{id}',[BukuController::class,'destroy']);



Route::middleware('auth:sanctum')->group(function () {
});

Route::middleware('auth:sanctum')->group(function () {
});



