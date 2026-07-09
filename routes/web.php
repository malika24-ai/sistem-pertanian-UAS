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
    
    Route::resource('/farm', App\Http\Controllers\FarmController::class);
    Route::resource('/crop-type', App\Http\Controllers\CropTypeController::class);
    Route::resource('/crop', App\Http\Controllers\CropController::class);
    Route::resource('/planting-schedule', App\Http\Controllers\PlantingScheduleController::class);
    Route::resource('/harvest-record', App\Http\Controllers\HarvestRecordController::class);
    Route::resource('/fertilizer', App\Http\Controllers\FertilizerController::class);
    Route::resource('/pesticide', App\Http\Controllers\PesticideController::class);
    Route::resource('/weather-log', App\Http\Controllers\WeatherLogController::class);
    Route::resource('/buyer', App\Http\Controllers\BuyerController::class);
    Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
    Route::put('/setting/{setting}/update', [SettingController::class, 'update'])->name('setting.update');
});
