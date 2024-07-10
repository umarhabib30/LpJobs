<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BusinessNotes;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Note;
use Illuminate\Http\Request;

class AdminBusinessController extends Controller
{
    public function index()
    {
        $business = Customer::all();
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
        $data = [
            'title' => 'Business list',
            'breadcrumbs' => array("admin/dashboard" => "Dashboard", 'admin/business/create' => 'Add Business'),
            'active' => 'Add Business',
            'categories' => $categories,
        ];
        return view('admin.business.create', $data);
    }

    public function store(Request $request)
    {
        try {
            $customer= Customer::create($request->all());
            BusinessNotes::create(['notes' => $request->notes,'customer_id'=>$customer->id]);
            return redirect()->back()->with('success', 'Business added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());

        }
    }

    public function edit($id)
    {
        $business = Customer::find($id);
        $categories = Category::all();
        $data = [
            'title' => 'Business list',
            'breadcrumbs' => array("admin/dashboard" => "Dashboard", 'admin/business/create' => 'Add Business'),
            'active' => 'Add Business',
            'business' => $business,
            'categories' => $categories,
        ];
        return view('admin.business.edit', $data);
    }

    public function update(Request $request)
    {
        try {

            $business = Customer::find($request->business_id);
            $business->update($request->all());
            return redirect('admin/business/index')->with('success', 'Business updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());

        }
    }

    public function delete($id)
    {
        try {
            $business = Customer::find($id);
            $business->delete();
            return redirect()->back()->with('success', 'Business deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());

        }
    }
}
