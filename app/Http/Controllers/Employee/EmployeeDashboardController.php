<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeDashboardController extends Controller
{
    public function index()
    {
        $jobs = Job::latest()->get();
        $data = [
            'title' => 'Employee Dashboard',
            'breadcrumbs' => array("employee/dashboard" => "Dashboard"),
            'active' => 'Dashboard',
            'jobs' => $jobs,
        ];
        return view('employee.dashboard', $data);
    }

    public function requestJob($id)
    {
        $job = Job::find($id);
        $user = Auth::user();
        $request = JobRequest::where('job_id', $job->id)->where('assigned', false)->first();
        if($job->user_id == $user->id){
            return redirect()->back()->with('error', 'This job is already assigned to you');
        }
        if ($request) {
            return redirect()->back()->with('error', 'Request for this job already exist');
        }
        JobRequest::create(['job_id' => $job->id, 'employee_id' => $job->user->id, 'requested_by' => $user->id]);
        return redirect()->back()->with('success', 'Request is sent to admin for job assignment');
    }
}
