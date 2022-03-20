<?php

use App\Http\Controllers\API\AutorizacionDescuentoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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

/*
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
*/
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/users/auth', AuthController::class );
    Route::get('/users/{user}', [UserController::class, 'show']);
    Route::get('/users', [UserController::class, 'index']);

    Route::resource('autorizaciones', AutorizacionDescuentoController::class);
});
