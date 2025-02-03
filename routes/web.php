<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ResidentController;
use App\Http\Controllers\Admin\ReportCategoryController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ReportStatusController;
use App\Http\Controllers\User\HomeController;

Route::get('/',[HomeController::class, 'index'])->name('home');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('/resident', ResidentController::class);
    Route::resource('/category', ReportCategoryController::class);
    Route::resource('/report', ReportController::class);

    // Perbaikan: Pastikan route `create` dideklarasikan sebelum `Route::resource()`
    Route::get('/report-status/create/{reportId}', [ReportStatusController::class, 'create'])->name('report-status.create');
    
    Route::resource('/report-status', ReportStatusController::class)->except('create');
});
