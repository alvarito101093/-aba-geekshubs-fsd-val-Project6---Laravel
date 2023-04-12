<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// AuthController
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

// Is Admin
// Route::group([
//     'middleware' => ['auth:sanctum', 'isAdmin']
// ], function () {
//     Route::post('/logout', [AuthController::class, 'logout']);
// });

// User Controller
Route::middleware('auth:sanctum')->get('/profile', [UserController::class, 'myProfile']);
Route::middleware('auth:sanctum')->put('/profile/update', [UserController::class, 'updateprofile']);
Route::middleware('auth:sanctum')->post('/comments/create', [UserController::class, 'createComment']);
Route::middleware('auth:sanctum')->get('/comments/view', [UserController::class, 'getMyMessages']);
Route::middleware('auth:sanctum')->get('/comments/party/{id}', [UserController::class, 'getMessagesByPartyId']);
Route::middleware('auth:sanctum', 'isAdmin')->put('/comments/update/{id}', [UserController::class, 'updateMessaggesByIdAdmin']);


Route::middleware('auth:sanctum', 'isAdmin')->get('/users/all', [UserController::class, 'getAllUsers']);
Route::middleware('auth:sanctum', 'isAdmin')->get('/users/all/details/{id}', [UserController::class, 'getUserDetailsById']);
Route::middleware('auth:sanctum', 'isAdmin')->delete('/users/all/destroy/{id}', [UserController::class, 'deleteUserById']);


//Test
Route::get('/welcome', function () {
    return view('welcome');
});
