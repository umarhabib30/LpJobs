<?php

use App\Http\Controllers\Admin\AdminBusinessController;
use App\Http\Controllers\Admin\AdminDashboardController;
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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* ------- Admin Routes -----------*/
Route::group(['prefix' => 'admin', 'middleware' => ['admin_auth']], function () {
    Route::get('/dashboard',    [AdminDashboardController::class,'index']);

    // ------ business routes
    Route::get('business/index',         [AdminBusinessController::class,'index']);
    Route::get('business/create',        [AdminBusinessController::class,'create']);
    Route::post('business/store',        [AdminBusinessController::class,'store']);
    Route::get('business/edit/{id}',     [AdminBusinessController::class,'edit']);
    Route::post('business/update',       [AdminBusinessController::class,'update']);
    Route::get('business/delete/{id}',   [AdminBusinessController::class,'delete']);
});
