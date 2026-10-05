<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TinTucAdminController;
use App\Http\Controllers\Admin\DanhMucController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Nhóm Route bảo vệ bằng auth và phân quyền role:admin cho khu vực Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn() => redirect()->route('admin.dashboard'))->name('home');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('tin', TinTucAdminController::class);
    Route::resource('danhmuc', DanhMucController::class);
    Route::post('tin/{tin}/restore', [TinTucAdminController::class, 'restore'])->name('tin.restore');
    Route::delete('tin/{tin}/force', [TinTucAdminController::class, 'forceDelete'])->name('tin.force-delete');
});

require __DIR__.'/auth.php';