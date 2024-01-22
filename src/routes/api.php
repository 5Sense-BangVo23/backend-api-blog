<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\BlgUserController;
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
Route::group([
    'prefix' => 'authentication',
    'controller' => AuthenticationController::class, 
    'middleware' => [],  // Add any middleware if needed
], function () {
    Route::post('/login', [AuthenticationController::class, 'authLogin']);
    Route::post('/send-message', [AuthenticationController::class, 'sendMessageInfo']);
});


// User management routes

Route::group([
    'prefix' => 'users',
    'controller' => BlgUserController::class,
    'middleware' => ['auth:api', 'checkRoleAdmin']
], function ($router) {
    Route::post('/register', [BlgUserController::class, 'authRegister']);
    Route::get('/', [BlgUserController::class, 'index']);
    Route::get('/{id}', [BlgUserController::class, 'show']);
    Route::put('/{id}', [BlgUserController::class, 'update']);
    Route::delete('/{id}', [BlgUserController::class, 'destroy']);
});