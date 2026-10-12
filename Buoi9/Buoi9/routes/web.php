<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Chuyển hướng trang chủ về danh sách trạm xe
Route::get('/', function () {
    return redirect()->route('stations.index');
});

// route station (User)
Route::resource('stations', StationController::class)->only(['index']);
Route::get('/api/stations', [StationController::class, 'filter'])->name('stations.filter');

// route admin station (Admin)
Route::prefix('admin')->name('admin.')->group(function () {
    // ===== TRASH =====
    Route::get('/stations/trash', [StationController::class, 'trash'])->name('stations.trash');
    Route::get('/stations/{id}/restore', [StationController::class, 'restore'])->name('stations.restore');
    Route::post('/stations/restore-selected', [StationController::class, 'restoreSelected'])->name('stations.restoreSelected');
    Route::post('/stations/restore-all', [StationController::class, 'restoreAll'])->name('stations.restoreAll');
    Route::delete('/stations/{id}/force', [StationController::class, 'forceDelete'])->name('stations.forceDelete');
    Route::delete('/stations/force-selected', [StationController::class, 'forceDeleteSelected'])->name('stations.forceDeleteSelected');
    Route::delete('/stations/force-all', [StationController::class, 'forceDeleteAll'])->name('stations.forceDeleteAll');

    // ========= CRUD =========
    Route::get('/stations', [StationController::class, 'adminIndex'])->name('stations.index');
    Route::resource('stations', StationController::class)->except(['index', 'show', 'filter']);
});