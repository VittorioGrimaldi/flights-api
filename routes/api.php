<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/hello-world', function (Request $request) {
    return 'Hello World!!';
});

Route::group(['prefix' => 'v1'], function () {
    Route::post('register', [AuthController::class, 'register']);
});
