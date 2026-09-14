<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/students/db', [StudentController::class, 'indexDb']);

Route::get('/pages/about', [PageController::class,'about']);

Route::get('/students/create', [StudentController::class, 'create']);

Route::post('/students', [StudentController::class, 'store']);