<?php

use App\Http\Controllers\Admin\AdminBusinessController;
use App\Http\Controllers\Admin\AdminCustomerController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminEmployeeController;
use App\Http\Controllers\Admin\AdminItemController;
use App\Http\Controllers\Admin\AdminJobController;
use App\Http\Controllers\Admin\AdminJobRequestController;
use App\Http\Controllers\Admin\AdminJobStatusController;
use App\Http\Controllers\Admin\AdminSizeController;
use App\Http\Controllers\Customer\CustomerDashboardController;
use App\Http\Controllers\Customer\CustomerJobController;
use App\Http\Controllers\Employee\EmployeeDashboardController;
use App\Http\Controllers\Employee\EmployeeJobController;
use Illuminate\Support\Facades\Auth;
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
    Route::get('/dashboard', [AdminDashboardController::class, 'index']);

    /* ----------- Business Routes ----------- */
    Route::get('business/index', [AdminBusinessController::class, 'index']);
    Route::get('business/create', [AdminBusinessController::class, 'create']);
    Route::post('business/store', [AdminBusinessController::class, 'store']);
    Route::get('business/edit/{id}', [AdminBusinessController::class, 'edit']);
    Route::post('business/update', [AdminBusinessController::class, 'update']);
    Route::get('business/delete/{id}', [AdminBusinessController::class, 'delete']);

    /* ----------- Customer Routes ----------- */
    Route::get('customer/index', [AdminCustomerController::class, 'index']);
    Route::get('customer/create', [AdminCustomerController::class, 'create']);
    Route::post('customer/store', [AdminCustomerController::class, 'store']);
    Route::get('customer/edit/{id}', [AdminCustomerController::class, 'edit']);
    Route::post('customer/update', [AdminCustomerController::class, 'update']);
    Route::get('customer/delete/{id}', [AdminCustomerController::class, 'delete']);

    /* ----------- Jobs Routes ----------- */
    Route::get('jobs/index', [AdminJobController::class, 'index']);
    Route::get('job/create', [AdminJobController::class, 'create']);
    Route::post('job/store', [AdminJobController::class, 'store']);
    Route::get('job/details/{id}', [AdminJobController::class, 'details']);
    Route::post('job/add-notes', [AdminJobController::class, 'addNote']);
    Route::get('job/edit/{id}', [AdminJobController::class, 'edit']);
    Route::post('job/update', [AdminJobController::class, 'update']);
    Route::get('job/delete/{id}', [AdminJobController::class, 'delete']);

    /* ----------- Job Request Routes ----------- */
    Route::get('job/request/pending', [AdminJobRequestController::class,'pending']);
    Route::get('job/request/approved', [AdminJobRequestController::class,'approved']);
    Route::get('job/request/approve/{id}', [AdminJobRequestController::class,'approve']);

    /* ----------- Items Routes ----------- */
    Route::get('item/create', [AdminItemController::class, 'create']);
    Route::post('item/store', [AdminItemController::class, 'store']);
    Route::get('items/index', [AdminItemController::class, 'index']);
    Route::get('item/delete/{id}', [AdminItemController::class, 'delete']);
    Route::get('item/edit/{id}', [AdminItemController::class, 'edit']);
    Route::post('item/update', [AdminItemController::class, 'update']);

    /* ----------- Job status Routes ----------- */
    Route::get('status/create', [AdminJobStatusController::class, 'create']);
    Route::post('status/store', [AdminJobStatusController::class, 'store']);
    Route::get('status/index', [AdminJobStatusController::class, 'index']);
    Route::get('status/delete/{id}', [AdminJobStatusController::class, 'delete']);
    Route::get('status/edit/{id}', [AdminJobStatusController::class, 'edit']);
    Route::post('status/update', [AdminJobStatusController::class, 'update']);

    /* ----------- Size Routes ----------- */
    Route::get('size/create', [AdminSizeController::class, 'create']);
    Route::post('size/store', [AdminSizeController::class, 'store']);
    Route::get('size/index', [AdminSizeController::class, 'index']);
    Route::get('size/delete/{id}', [AdminSizeController::class, 'delete']);
    Route::get('size/edit/{id}', [AdminSizeController::class, 'edit']);
    Route::post('size/update', [AdminSizeController::class, 'update']);

    /* ----------- Employee Routes ----------- */
    Route::get('employee/create', [AdminEmployeeController::class, 'create']);
    Route::post('employee/store', [AdminEmployeeController::class, 'store']);
    Route::get('employee/index', [AdminEmployeeController::class, 'index']);
    Route::get('employee/delete/{id}', [AdminEmployeeController::class, 'delete']);
    Route::get('employee/edit/{id}', [AdminEmployeeController::class, 'edit']);
    Route::post('employee/update', [AdminEmployeeController::class, 'update']);
    Route::post('employee/password/update', [AdminEmployeeController::class, 'updatePassword']);
});

Route::group(['prefix' => 'employee', 'middleware' => ['employee_auth']], function () {

    Route::get('/dashboard',        [EmployeeDashboardController::class, 'index']);
    Route::get('/job/request/{id}', [EmployeeDashboardController::class, 'requestJob']);

     /* ----------- Job Routes ----------- */
     Route::get('jobs/index',                   [EmployeeJobController::class,'index']);
     Route::get('job/details/{id}',             [EmployeeJobController::class,'details']);
     Route::post('job/add-notes',               [EmployeeJobController::class,'addNote']);
     Route::post('job/add-customer-notes',      [EmployeeJobController::class,'addCustomerNote']);
     Route::post('job/update-status',           [EmployeeJobController::class,'updateStatus']);
     Route::post('job/update-user',             [EmployeeJobController::class,'updateUser']);
     Route::post('job/upload-file',             [EmployeeJobController::class,'uploadFile']);
});

Route::group(['prefix' => 'customer', 'middleware' => ['customer_auth']], function () {
    Route::get('/dashboard',[CustomerDashboardController::class,'index']);

     /* ----------- Job Routes ----------- */
    Route::get('/business/jobs/{id}',       [CustomerJobController::class,'index']);
    Route::get('/job/details/{id}',         [CustomerJobController::class,'show']);
    Route::post('job/add-customer-notes',   [CustomerJobController::class,'addCustomerNote']);
    Route::post('job/upload-file',          [CustomerJobController::class,'uploadFile']);
});

Route::group(['prefix' => 'manager', 'middleware' => ['manager_auth']], function () {

});
