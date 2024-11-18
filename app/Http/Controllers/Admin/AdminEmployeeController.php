<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = User::where('role', 2)->latest()->get();
        $data = [
            'title' => 'Employees list',
            'breadcrumbs' => array("admin/dashboard" => "Dashboard", 'admin/employee/index' => 'Employees'),
            'active' => 'employee',
            'employees' => $employees,
        ];
        return view('admin.employee.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Add Employee',
            'breadcrumbs' => array("admin/dashboard" => "Dashboard", 'admin/employee/create' => 'Add Employee'),
            'active' => 'employee',
        ];
        return view('admin/employee.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->first());
            return redirect()->back()->withInput();
        }

        User::create([
            'role' => 2,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect('admin/employee/index')->with('success', 'Employee added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = User::find($id);
        $data = [
            'title' => 'Edit Employee',
            'breadcrumbs' => array("admin/dashboard" => "Dashboard", 'admin/employee/index' => 'Employees', 'admin/employee/edit/' . $employee->id => 'Edit Employee'),
            'active' => 'employee',
            'employee' => $employee,
        ];
        return view('admin.employee.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->first());
            return redirect()->back();
        }

        $employee = User::find($request->id);
        if ($employee->email != $request->email) {
            $check = User::where('email', $request->email)->first();
            if ($check) {
                return redirect()->back()->with('error', 'Email already exist please provide unique email');
            } else {
                $employee->update(['name' => $request->name, 'email' => $request->email]);
                return redirect()->back()->with('success', 'Employee updated successfully');
            }
        } else {
            $employee->update($request->all());
            return redirect()->back()->with('success', 'Employee updated successfully');
        }
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

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        try {
            $employee = User::find($id);
            $employee->delete();
            return redirect()->back()->with('success', 'Employee deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }
}
