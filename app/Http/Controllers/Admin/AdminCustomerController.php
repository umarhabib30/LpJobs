<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class AdminCustomerController extends Controller
{
    public function index()
    {
        $customers = User::where('role',3)->get();
        $data = [
            'title' => 'Customer list',
            'breadcrumbs' => array("admin/dashboard" => "Dashboard", 'admin/customer/index' => 'Customers'),
            'active' => 'Customer',
            'customers' => $customers,
        ];
        return view('admin.customer.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'customer list',
            'breadcrumbs' => array("admin/dashboard" => "Dashboard", 'admin/customer/create' => 'Add Customer'),
            'active' => 'Customer',
        ];
        return view('admin.customer.create', $data);
    }

    public function store(Request $request)
    {

        // $validator = Validator::make($request->all(), [
        //     'customer_name' => 'required',
        //     'address' => 'required',
        //     'road' => 'required',
        //     'town' => 'required',
        //     'city' => 'required',
        //     'post_code' => 'required',
        //     'mobile' => 'required',
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => ['required', 'string', 'min:8', 'confirmed'],
        // ]);

        // if ($validator->fails()) {
        //     Session::flash('error', $validator->errors()->first());
        //     return redirect()->back()->withInput();
        // }
        try {
            $customer = User::create([
                'name'=> $request->customer_name,
                'role' => '3',
                'email'=> $request->email,
                'password' => Hash::make($request->password)
            ]);

            $customer_details = CustomerDetail::create([
                    'user_id' => $customer->id,
                    'address'=> $request->address,
                    'road' => $request->road,
                    'town' => $request->town,
                    'city' => $request->city,
                    'post_code' => $request->post_code,
                    'mobile' => $request->mobile,
            ]);
            return redirect('admin/customer/index')->with('success', 'customer added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());

        }
    }

    public function edit($id)
    {
        $customer = User::find($id);

        $data = [
            'title' => 'customer list',
            'breadcrumbs' => array("admin/dashboard" => "Dashboard", 'admin/customer/index' => 'customer', 'admin/customer/edit/' . $customer->id => "Edit customer"),
            'active' => 'Customer',
            'customer' => $customer,
        ];
        return view('admin.customer.edit', $data);
    }

    public function update(Request $request)
    {
        $customer = User::find($request->id);
        $customer_detail = CustomerDetail::where('user_id',$customer->id)->first();

        // $validator = Validator::make($request->all(), [
        //     'name' => 'required',
        //     'address' => 'required',
        //     'road' => 'required',
        //     'town' => 'required',
        //     'city' => 'required',
        //     'post_code' => 'required',
        //     'mobile' => 'required',
        //     'email' => ['required', 'string', 'email', 'max:255',Rule::unique('users', 'email')->ignore($customer->id)],
        // ]);

        // if ($validator->fails()) {
        //     Session::flash('error', $validator->errors()->first());
        //     return redirect()->back()->withInput();
        // }

        $customer->update([
            'name'=> $request->name,
            'email'=> $request->email,
        ]);

        $customer_detail->update([
            'address'=> $request->address,
            'road' => $request->road,
            'town' => $request->town,
            'city' => $request->city,
            'post_code' => $request->post_code,
            'mobile' => $request->mobile,
        ]);

        return redirect('admin/customer/index')->with('success', 'customer updated successfully');
    }

    public function delete($id)
    {
        try {
            $customer = User::find($id);
            $customer->delete();
            return redirect()->back()->with('success', 'customer deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());

        }
    }

    public function getProfile($id){
        $data = [
            'title' => 'Customer',
        ];
        $data['customer'] = User::find($id);
        return view('admin.customer.complete-profile',$data);
    }

    public function storeProfile(Request $request){
         $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->first());
            return redirect()->back()->withInput();
        }

        $customer = User::find($request->id);
        if($customer){
            $customer->update([
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            Auth::login($customer);
            return redirect('customer/dashboard');
        }

    }
}
