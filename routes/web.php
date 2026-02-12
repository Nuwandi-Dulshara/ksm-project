<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DonatorController;
use App\Http\Controllers\IncomeController;

Route::get('/', [AuthController::class, 'showLogin'])->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/dashboard', [AuthController::class, 'dashboard'])
    ->middleware('auth')
    ->name('dashboard');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::resource('roles', RoleController::class);

Route::resource('users', UserController::class);

Route::resource('donators', DonatorController::class);

Route::resource('incomes', IncomeController::class);

