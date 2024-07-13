<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AdminJobStatusController extends Controller
{
    public function index()
    {
        $statuses = JobStatus::latest()->get();
        $data = [
            'title' => 'Job Status',
            'breadcrumbs' => array("admin/dashboard" => "Dashboard", 'admin/status/index' => 'Job Status'),
            'active' => 'status',
            'statuses' => $statuses,
        ];
        return view('admin.jobStatus.index', $data);
    }
    public function create()
    {
        $data = [
            'title' => 'Add Job Status',
            'breadcrumbs' => array("admin/dashboard" => "Dashboard", 'admin/status/create' => 'Add Job Status'),
            'active' => 'status',
        ];
        return view('admin.jobStatus.create', $data);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|unique:job_statuses',
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->first());
            return redirect()->back()->withInput();
        }
        JobStatus::create($request->all());
        return redirect()->back()->with('success', 'Job status added successfully');
    }
    public function edit($id)
    {
        $status = JobStatus::find($id);
        $data = [
            'title' => 'Edit Job Status',
            'breadcrumbs' => array("admin/dashboard" => "Dashboard", 'admin/status/index' => 'Job Status', 'admin/status/edit/' . $status->id => 'Edit job status'),
            'active' => 'status',
            'status' => $status,
        ];
        return view('admin.jobStatus.edit', $data);
    }
    public function update(Request $request)
    {
        $status = JobStatus::find($request->id);
        $validator = Validator::make($request->all(), [
            'status' => ['required',
            Rule::unique('job_statuses', 'status')->ignore($status->id)],
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->first());
            return redirect()->back()->withInput();
        }
        $status->update(['status' => $request->status]);
        return redirect()->back()->with('success', 'Job status updated successfully');
    }
    public function delete($id)
    {
        try {
            $status = JobStatus::find($id);
            $status->delete();
            return redirect()->back()->with('success', 'Job status deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
