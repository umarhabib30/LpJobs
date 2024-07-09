<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index(){
        $data=[
            'title' => 'Admin Dashboard',
            'breadcrumbs' => ['admin/dashboard'=>'Dashboard'],
            'active' => 'Dashboard',
        ];
        return view('admin.dashboard',$data);
    }
}
