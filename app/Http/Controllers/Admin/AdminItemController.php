<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AdminItemController extends Controller
{
    public function create()
    {
        $data = [
            'title' => 'Add item',
            'breadcrumbs' => array("admin/dashboard" => "Dashboard", 'admin/item/create' => 'Add item'),
            'active' => 'Items',
        ];
        return view('admin.items.create', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:items',
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->first());
            return redirect()->back()->withInput();
        }
        Item::create($request->all());
        return redirect()->back()->with('success', 'Item added successfully');
    }

    public function index()
    {
        $items = Item::latest()->get();
        $data = [
            'title' => 'Items list',
            'breadcrumbs' => array("admin/dashboard" => "Dashboard", 'admin/items/index' => 'Items'),
            'active' => 'Items',
            'items' => $items,
        ];
        return view('admin.items.index', $data);
    }
    public function delete($id)
    {
        try {
            $item = Item::find($id);
            $item->delete();
            return redirect()->back()->with('success', 'Item deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $item = Item::find($id);
        $data = [
            'title' => 'Edit item',
            'breadcrumbs' => array("admin/dashboard" => "Dashboard", 'admin/items/index' => 'Items', 'admin/item/edit/' . $item->id => 'Edit item'),
            'active' => 'Items',
            'item' => $item,
        ];
        return view('admin.items.edit', $data);
    }
    public function update(Request $request)
    {
        $item = Item::find($request->id);
        $validator = Validator::make($request->all(), [
            'name' => ['required',
            Rule::unique('items', 'name')->ignore($item->id)],
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->first());
            return redirect()->back()->withInput();
        }

        $item->update(['name' => $request->name]);
        return redirect()->back()->with('success', 'Item updated successfully');
    }
}
