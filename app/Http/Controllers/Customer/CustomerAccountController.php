<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CustomerAccountController extends Controller
{
    public function index(){
        $customer = Auth::user();
        $data = [
            'title' => 'Account',
            'breadcrumbs' => array("customer/account" => "Account"),
            'active' => 'Account',
            'user_id' => $customer->id,
        ];
        return view('customer.account.index', $data);
    }

    public function updatePassword(Request $request){
        $validator = Validator::make($request->all(), [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->first());
            return redirect()->back();
        }

        $employee = User::find($request->id);
        $employee->update(['password'=> Hash::make($request->password)]);
        return redirect()->back()->with('success', 'Password updated successfully');
    }
}
