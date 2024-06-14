<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PainelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\Api\V1\UsersController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\V1\AdminUsersController;
use App\Http\Controllers\CepController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/cadastro', function () {
    return view('cadastro');
});
Route::get('/logar', function () {
    return view('login');
});
Route::post('/users', [UsersController::class, 'store'])->name('register');
Route::middleware(['auth'])->group(function () {
    Route::get('/users', [UsersController::class, 'index'])->name('getUsers');

    Route::get('/users/{id}/delete', [UsersController::class, 'deleteConfirmation'])->name('deleteConfirmation');
    Route::delete('/users/{id}', [UsersController::class, 'destroy'])->name('destroy');
    Route::get('/gerenciar', function () {return view('gerenciar');});
    Route::get('/cadastroUser', function () {return view('cadastroUser');});
    Route::get('/users/cpf/{cpf}', [AdminUsersController::class, 'findByCpf'])->name('findByCpf');
    Route::post('/usersAdmin', [AdminUsersController::class, 'store'])->name('usersAdmin');
    Route::get('/getUsersAdmin', [AdminUsersController::class, 'index'])->name('getUsersAdmin');
    Route::delete('/deleteAdminUsers/{id}', [AdminUsersController::class, 'destroy']);
    Route::get('/editUser/{id}', [AdminUsersController::class, 'edit'])->name('editUser');
    Route::put('/editUser/{id}', [AdminUsersController::class, 'update'])->name('updateUser');
    Route::get('/cep/{cep}', [CepController::class, 'getCep'])->name('getCep');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/painel', [PainelController::class, 'index'])->name('painel');
});


Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');


Route::post('/login', [AuthController::class, 'login'])->name('login');
