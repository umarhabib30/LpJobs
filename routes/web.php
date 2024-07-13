<?php

use App\Http\Controllers\Admin\AdminBusinessController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminEmployeeController;
use App\Http\Controllers\Admin\AdminItemController;
use App\Http\Controllers\Admin\AdminJobController;
use App\Http\Controllers\Admin\AdminJobStatusController;
use App\Http\Controllers\Admin\AdminSizeController;
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

/* ----------- Admin Routes ----------- */
Route::group(['prefix' => 'admin', 'middleware' => ['admin_auth']], function () {
    Route::get('/dashboard',    [AdminDashboardController::class,'index']);

    /* ----------- Business Routes ----------- */
    Route::get('business/index',         [AdminBusinessController::class,'index']);
    Route::get('business/create',        [AdminBusinessController::class,'create']);
    Route::post('business/store',        [AdminBusinessController::class,'store']);
    Route::get('business/edit/{id}',     [AdminBusinessController::class,'edit']);
    Route::post('business/update',       [AdminBusinessController::class,'update']);
    Route::get('business/delete/{id}',   [AdminBusinessController::class,'delete']);

    /* ----------- Jobs Routes ----------- */
    Route::get('jobs/index',             [AdminJobController::class,'index']);
    Route::get('job/create',             [AdminJobController::class,'create']);
    Route::post('job/store',             [AdminJobController::class,'store']);
    Route::get('job/details/{id}',       [AdminJobController::class,'details']);
    Route::post('job/add-notes',         [AdminJobController::class,'addNote']);
    Route::get('job/edit/{id}',          [AdminJobController::class,'edit']);
    Route::post('job/update',            [AdminJobController::class,'update']);
    Route::get('job/delete/{id}',        [AdminJobController::class,'delete']);

    /* ----------- Items Routes ----------- */
    Route::get('item/create',            [AdminItemController::class,'create']);
    Route::post('item/store',            [AdminItemController::class,'store']);
    Route::get('items/index',            [AdminItemController::class,'index']);
    Route::get('item/delete/{id}',       [AdminItemController::class,'delete']);
    Route::get('item/edit/{id}',         [AdminItemController::class,'edit']);
    Route::post('item/update',           [AdminItemController::class,'update']);

    /* ----------- Job status Routes ----------- */
    Route::get('status/create',            [AdminJobStatusController::class,'create']);
    Route::post('status/store',            [AdminJobStatusController::class,'store']);
    Route::get('status/index',             [AdminJobStatusController::class,'index']);
    Route::get('status/delete/{id}',       [AdminJobStatusController::class,'delete']);
    Route::get('status/edit/{id}',         [AdminJobStatusController::class,'edit']);
    Route::post('status/update',           [AdminJobStatusController::class,'update']);

    /* ----------- Size Routes ----------- */
    Route::get('size/create',            [AdminSizeController::class,'create']);
    Route::post('size/store',            [AdminSizeController::class,'store']);
    Route::get('size/index',             [AdminSizeController::class,'index']);
    Route::get('size/delete/{id}',       [AdminSizeController::class,'delete']);
    Route::get('size/edit/{id}',         [AdminSizeController::class,'edit']);
    Route::post('size/update',           [AdminSizeController::class,'update']);

    /* ----------- Employee Routes ----------- */
    Route::get('employee/create',            [AdminEmployeeController::class,'create']);
    Route::post('employee/store',            [AdminEmployeeController::class,'store']);
    Route::get('employee/index',             [AdminEmployeeController::class,'index']);
    Route::get('employee/delete/{id}',       [AdminEmployeeController::class,'delete']);
    Route::get('employee/edit/{id}',         [AdminEmployeeController::class,'edit']);
    Route::post('employee/update',           [AdminEmployeeController::class,'update']);
    Route::post('employee/password/update',  [AdminEmployeeController::class,'updatePassword']);
});
