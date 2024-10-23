<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerDashboardController extends Controller
{
    public function index(){
        $user = Auth::user();
        $businesses = Business::where('user_id',$user->id)->get();
        $data = [
            'title' => 'Customer Dashboard',
            'breadcrumbs' => array("customer/dashboard" => "Dashboard"),
            'active' => 'Dashboard',
            'businesses' => $businesses,
        ];
        return view('customer.dashboard', $data);
    }
}
