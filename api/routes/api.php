<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});

Route::get('/', function () {
  return response()->json(['message' => 'API', 'status' => 'Conectado']);
});

/*users*/
Route::prefix('users')->group(function () {
  Route::get('/all', [UserController::class, 'getAll'])->name('users/all');
  Route::post('/insert', [UserController::class, 'insert'])->name('users/insert');
  Route::prefix('{id}')->group(function () {
    Route::get('/', [UserController::class, 'getId'])->name('users/id');
    Route::put('/update', [UserController::class, 'update'])->name('users/id/update');
    Route::delete('/destroy', [UserController::class, 'destroy'])->name('users/id/destroy');
  });
});