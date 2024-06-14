<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\UsersController;
use App\Http\Controllers\Api\V1\AdminUsersController;
use App\Http\Controllers\CepController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PasswordController;




Route::get('/users', [UsersController::class, 'index']);
Route::get('/users/{id}', [UsersController::class, 'show']);
Route::post('/users', [UsersController::class, 'store']);
Route::delete('/users/{id}', [UsersController::class, 'destroy']);
Route::post('/usersAdmin', [AdminUsersController::class, 'store']);
Route::post('/adminUsers', [AdminUsers::class, 'store']);
Route::get('/getUsersAdmin', [AdminUsersController::class, 'index']);
Route::delete('/deleteAdminUsers/{id}', [AdminUsersController::class, 'destroy']);
Route::put('/editUser/{id}', [AdminUsersController::class, 'update']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/users/cpf/{cpf}', [AdminUsersController::class, 'findByCpf']);
    Route::get('/cep/{cep}', [CepController::class, 'getCep']);
});
Route::get('/forgot-password', [PasswordController::class, 'forgot']);
Route::post('/forgot-password', [PasswordController::class, 'reset']);