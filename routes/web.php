<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login',[AuthController::class,'index'])->name('login');
Route::get('/register',[AuthController::class,'register'])->name('register');
Route::post('/login',[AuthController::class,'loginLogic']);
Route::post('/register',[AuthController::class,'registerLogic']);


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

    Route::get('/hak-akses/role', [RoleController::class,'index'])->name('hak-akses.role');
    Route::get('/hak-akses/permission', [PermissionController::class,'index'])->name('hak-akses.permission');
});

Route::get('/logout',[AuthController::class,'logout'])->name('logout');