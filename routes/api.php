<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function() {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
        
    Route::get('/users', [UserController::class, 'index']);
    Route::post('users/store', [UserController::class, 'store']);
    Route::get('/users/buscar', [UserController::class, 'buscar']);
    Route::get('/users/{id}', ([UserController::class, 'show']));
    Route::delete('/logout', [LoginController::class, 'destroy']);
});


Route::post('/login', [LoginController::class, 'login']);
Route::post('/signup', [UserController::class, 'signup']);


// Route::post('users/store', function () {
//     return response()->json(['chegou' => 'A rota está funcionando!']);
// });