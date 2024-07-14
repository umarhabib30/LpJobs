<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeDashboardController extends Controller
{
    public function index(){
        $data=[
            'title' => 'Employee Dashboard',
            'breadcrumbs' => array("employee/dashboard" => "Dashboard"),
            'active' => 'Dashboard',
        ];
        return view('employee.dashboard',$data);
    }
}
