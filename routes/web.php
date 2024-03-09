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

    Route::get('/hak-akses/role', [RoleController::class,'index'])->middleware(['role_or_permission:role.view']);
    Route::get('/hak-akses/role/create', [RoleController::class,'create'])->middleware(['role_or_permission:role.create']);
    Route::post('/hak-akses/role/store', [RoleController::class,'store'])->middleware(['role_or_permission:role.create']);
    Route::get('/hak-akses/role/edit/{roleName}', [RoleController::class,'edit'])->middleware(['role_or_permission:role.update']);
    Route::post('/hak-akses/role/update', [RoleController::class,'update'])->middleware(['role_or_permission:role.update']);
    Route::get('/hak-akses/role/delete/{roleName}', [RoleController::class,'delete'])->middleware(['role_or_permission:role.delete']);
    
    Route::get('/hak-akses/permission', [PermissionController::class,'index'])->middleware(['role_or_permission:permission.view']);
});

Route::get('/logout',[AuthController::class,'logout'])->name('logout');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
