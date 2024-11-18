<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AdminBusinessController extends Controller
{
    public function index()
    {
        $business = Business::all();
        $data = [
            'title' => 'Business list',
            'breadcrumbs' => array("admin/dashboard" => "Dashboard", 'admin/business/index' => 'Businesses'),
            'active' => 'Business',
            'businesses' => $business,
        ];
        return view('admin.business.index', $data);
    }

    public function create()
    {
        $categories = Category::all();
        $customers = User::where('role', 3)->get();
        if ($customers->isEmpty()) {
            return redirect()->back()->with('error', 'Please add a customer first');
        }
        $data = [
            'title' => 'Business list',
            'breadcrumbs' => array("admin/dashboard" => "Dashboard", 'admin/business/create' => 'Add Business'),
            'active' => 'Business',
            'categories' => $categories,
            'customers' => $customers,
        ];
        return view('admin.business.create', $data);
    }

    public function store(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'user_id' => 'required',
        //     'business_name' => 'required',
        //     'address' => 'required',
        //     'road' => 'required',
        //     'town' => 'required',
        //     'city' => 'required',
        //     'post_code' => 'required',
        //     'tel' => 'required',
        //     'mobile' => 'required',
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:businesses'],
        //     'web' => 'required|url',
        //     'notes' => 'required',
        // ]);

        // if ($validator->fails()) {
        //     Session::flash('error', $validator->errors()->first());
        //     return redirect()->back()->withInput();
        // }
        try {
            Business::create($request->all());
            return redirect()->back()->with('success', 'Business added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $business = Business::find($id);
        $categories = Category::all();
        $data = [
            'title' => 'Business list',
            'breadcrumbs' => array("admin/dashboard" => "Dashboard", 'admin/business/index' => 'Business', 'admin/business/edit/' . $business->id => "Edit business"),
            'active' => 'Business',
            'business' => $business,
            'categories' => $categories,
        ];
        return view('admin.business.edit', $data);
    }

    public function update(Request $request)
    {
   
        $business = Business::find($request->business_id);
        // $validator = Validator::make($request->all(), [
        //     'business_name' => 'required',
        //     'address' => 'required',
        //     'road' => 'required',
        //     'town' => 'required',
        //     'city' => 'required',
        //     'post_code' => 'required',
        //     'tel' => 'required',
        //     'mobile' => 'required',
        //     'email' => ['required', 'string', 'email', 'max:255', Rule::unique('customers', 'email')->ignore($business->id)],
        //     'web' => 'required|url',
        //     'notes' => 'required',
        // ]);

        // if ($validator->fails()) {
        //     Session::flash('error', $validator->errors()->first());
        //     return redirect()->back()->withInput();
        // }

        $business->update($request->all());
        return redirect('admin/business/index')->with('success', 'Business updated successfully');
    }

    public function delete($id)
    {
        try {
            $business = Business::find($id);
            $business->delete();
            return redirect()->back()->with('success', 'Business deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
