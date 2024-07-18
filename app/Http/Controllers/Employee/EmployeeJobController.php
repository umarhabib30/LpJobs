<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobAssignmentUpdates;
use App\Models\JobStatus;
use App\Models\JobStatusUpdates;
use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class EmployeeJobController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $jobs = Job::where('user_id', $user->id)->latest()->get();
        $data = [
            'title' => 'Jobs',
            'breadcrumbs' => array("employee/dashboard" => "Dashboard"),
            'active' => 'jobs',
            'jobs' => $jobs,
        ];
        return view('employee.job.index', $data);
    }

    public function details($id)
    {
        $job = Job::with('notes')->find($id);
        $data = [
            'title' => 'Job Details',
            'breadcrumbs' => array("employee/dashboard" => "Dashboard", 'employee/jobs/index' => 'Jobs', 'employee/job/details/' . $job->id => 'Job Details'),
            'active' => 'jobs',
            'job' => $job,
            'statusses' => JobStatus::all(),
            'users' => User::where('role', 2)->get(),
        ];
        return view('employee.job.details', $data);
    }

    public function addNote(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'note' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->first());
            return redirect()->back()->withInput();
        }
        Note::create($request->all());
        return redirect()->back()->with('success', 'Note added successfully');
    }

    public function updateStatus(Request $request)
    {
        $user = Auth::user();
        $job = Job::find($request->id);
        $job->update(['status_id' => $request->status_id]);
        JobStatusUpdates::create(['job_id' => $job->id, 'status_id' => $request->status_id, 'updated_by' => $user->id]);
        return response()->json('Job status updated successfully');
    }

    public function updateUser(Request $request)
    {
        $user = Auth::user();
        $job = Job::find($request->id);
        $job->update(['user_id' => $request->user_id]);
        JobAssignmentUpdates::create(['job_id' => $job->id, 'employee_id' => $request->user_id, 'updated_by' => $user->id]);
        return response()->json('Job status updated successfully');
    }
}
