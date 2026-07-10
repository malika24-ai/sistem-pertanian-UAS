<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('login.authenticate');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');
    Route::post('/switch-user', [LoginController::class, 'switchUser'])->name('login.switch_user');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard/show', [DashboardController::class, 'show'])->name('dashboard.show');
    Route::get('/dashboard/edit', [DashboardController::class, 'edit'])->name('dashboard.edit');
    Route::put('/dashboard/update', [DashboardController::class, 'update'])->name('dashboard.update');

    Route::resource('/user', UserController::class)->middleware('role:Superadmin');
    
    Route::resource('/farm', App\Http\Controllers\FarmController::class)->middleware('role:Superadmin,Admin,Petani,Penyuluh Pertanian');
    Route::resource('/crop-type', App\Http\Controllers\CropTypeController::class)->middleware('role:Superadmin,Admin');
    Route::resource('/crop', App\Http\Controllers\CropController::class)->middleware('role:Superadmin,Admin');
    Route::resource('/planting-schedule', App\Http\Controllers\PlantingScheduleController::class)->middleware('role:Superadmin,Petani,Penyuluh Pertanian');
    Route::resource('/harvest-record', App\Http\Controllers\HarvestRecordController::class)->middleware('role:Superadmin,Petani,Penyuluh Pertanian');
    Route::resource('/fertilizer', App\Http\Controllers\FertilizerController::class)->middleware('role:Superadmin,Petani,Penyuluh Pertanian');
    Route::resource('/pesticide', App\Http\Controllers\PesticideController::class)->middleware('role:Superadmin,Petani,Penyuluh Pertanian');
    Route::resource('/weather-log', App\Http\Controllers\WeatherLogController::class)->middleware('role:Superadmin');
    Route::resource('/buyer', App\Http\Controllers\BuyerController::class)->middleware('role:Superadmin,Admin');
    Route::resource('/sales-transaction', App\Http\Controllers\SalesTransactionController::class)->middleware('role:Superadmin,Admin,Pembeli');
    Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
    Route::put('/setting/{setting}/update', [SettingController::class, 'update'])->name('setting.update');
});
