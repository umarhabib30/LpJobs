<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AdminSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sizes = Size::latest()->get();
        $data = [
            'title' => 'Size',
            'breadcrumbs' => array("admin/dashboard" => "Dashboard", 'admin/size/index' => 'Size'),
            'active' => 'size',
            'sizes' => $sizes,
        ];
        return view('admin.size.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Add Size',
            'breadcrumbs' => array("admin/dashboard" => "Dashboard", 'admin/size/create' => 'Add Size'),
            'active' => 'size',
        ];
        return view('admin.size.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'size' => 'required|unique:sizes',
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->first());
            return redirect()->back()->withInput();
        }
        Size::create($request->all());
        return redirect()->back()->with('success', 'Size added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $size = Size::find($id);
        $data = [
            'title' => 'Edit Size',
            'breadcrumbs' => array("admin/dashboard" => "Dashboard", 'admin/size/index' => 'Size', 'admin/size/edit' . $size->id => 'Edit Size'),
            'active' => 'size',
            'size' => $size,
        ];
        return view('admin.size.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $size = Size::find($request->id);
        $validator = Validator::make($request->all(), [
            'size' => ['required',
            Rule::unique('sizes', 'size')->ignore($size->id)],
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->first());
            return redirect()->back()->withInput();
        }

        $size->update(['size' => $request->size]);
        return redirect()->back()->with('success', 'Size updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        try {
            $size = Size::find($id);
            $size->delete();
            return redirect()->back()->with('success', 'Size deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
