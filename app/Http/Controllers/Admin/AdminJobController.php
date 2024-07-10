<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Job;
use App\Models\JobStatus;
use App\Models\Note;
use App\Models\Size;
use App\Models\User;
use Illuminate\Http\Request;

class AdminJobController extends Controller
{
    public function index()
    {
        $jobs = Job::all();
        $data = [
            'title' => 'Jobs list',
            'breadcrumbs' => array("admin/dashboard" => "Dashboard", 'admin/jobs/index' => 'Jobs'),
            'active' => 'Jobs',
            'jobs' => $jobs,
        ];
        return view('admin.job.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Add Job',
            'breadcrumbs' => array("admin/dashboard" => "Dashboard", 'admin/job/create' => 'Add Job'),
            'active' => 'Jobs',
            'businesses' => Customer::all(),
            'items' => Item::all(),
            'sizes' => Size::all(),
            'users' => User::all(),
            'statusses' => JobStatus::all(),
        ];
        return view('admin.job.create', $data);
    }

    public function store(Request $request)
    {
        try {
            $job = Job::create($request->all());
            Note::create(['note' => $request->notes, 'job_id' => $job->id]);
            return redirect()->back()->with('success', 'Job added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function details($id)
    {
        $job = Job::find($id)->with('notes')->first();
        $data = [
            'title' => 'Job Details',
            'breadcrumbs' => array("admin/dashboard" => "Dashboard", 'admin/jobs/index' => 'Jobs', 'admin/job/details/' . $job->id => 'Job Details'),
            'active' => 'Job Details',
            'job' => $job,
        ];
        return view('admin.job.details', $data);
    }

    public function addNote(Request $request)
    {
        Note::create($request->all());
        return redirect()->back()->with('success', 'Note added successfully');
    }
    public function edit($id)
    {
        $job = Job::find($id);
        $data = [
            'title' => 'Edit Job',
            'breadcrumbs' => array("admin/dashboard" => "Dashboard", 'admin/jobs/index' => 'Jobs', 'admin/job/edit/' . $job->id => 'Edit Job'),
            'active' => 'Jobs',
            'job' => $job,
            'businesses' => Customer::all(),
            'items' => Item::all(),
            'sizes' => Size::all(),
            'users' => User::all(),
            'statusses' => JobStatus::all(),
        ];
        return view('admin.job.edit', $data);
    }
    public function update(Request $request){
        $job = Job::find($request->job_id);
        $job->update($request->all());
        return redirect()->back()->with('success', 'Job updated successfully');
    }
    public function delete($id)
    {
        $Job = Job::find($id);
        $Job->delete();
        return redirect()->back()->with('success', 'Job deleted successfully');
    }
}
