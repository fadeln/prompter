<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Route::get('z', function (Request $request) {
//     return "hello";
// });

Route::resource('user', UserController::class)->middleware('auth:sanctum');

