<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\BlgUserController;
use App\Http\Controllers\Api\BlgAuthorController;
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
    'middleware' => [],  
], function () {
    Route::post('/login', [AuthenticationController::class, 'authLogin']);
    Route::get('/user/{userId}', [AuthenticationController::class, 'getUser'])->middleware(['auth:api']);
    Route::post('/logout', [AuthenticationController::class,'authLogout']);
    Route::post('/send-message', [AuthenticationController::class, 'sendMessageInfo']);
});


// User management routes

Route::group([
    'prefix' => 'users',
    'controller' => BlgUserController::class,
    'middleware' => ['auth:api', 'checkRoleAdmin']
], function ($router) {
    Route::post('/register', [BlgUserController::class, 'authRegister'])->middleware(['auth:api']);
    Route::get('/', [BlgUserController::class, 'index']);
    Route::get('/{id}', [BlgUserController::class, 'show']);
    Route::put('/update/{id}', [BlgUserController::class, 'updateUser'])->middleware(['auth:api']);
    Route::delete('/{id}', [BlgUserController::class, 'destroy']);
    Route::post('/reset-password/{email}', [BlgUserController::class, 'resetPassword'])->middleware(['auth:api']);
});

Route::group([
    'prefix' => 'authors',
    'controller' => BlgAuthorController::class,
    'middleware' => ['auth:api', 'checkRoleAdmin']
], function ($router) {
    Route::post('/create', [BlgAuthorController::class, 'createAuthor'])->middleware(['auth:api']);
    Route::get('/', [BlgAuthorController::class, 'getAllAuthors'])->middleware(['auth:api']);
    Route::put('/update/{id}', [BlgAuthorController::class, 'updateAuthor'])->middleware(['auth:api']);
});