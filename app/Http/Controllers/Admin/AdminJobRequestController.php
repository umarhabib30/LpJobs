<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobRequest;
use Illuminate\Http\Request;

class AdminJobRequestController extends Controller
{
    public function pending()
    {
        $jobs = JobRequest::where('assigned', false)->latest()->get();
        $data = [
            'title' => 'Jobs list',
            'breadcrumbs' => array("admin/dashboard" => "Dashboard", 'admin/jobs/request/pending' => 'Job Requests'),
            'active' => 'job request',
            'jobs' => $jobs,
        ];
        return view('admin.job-request.pending', $data);
    }
    public function approved()
    {
        $jobs = JobRequest::where('assigned', true)->latest()->get();
        $data = [
            'title' => 'Jobs list',
            'breadcrumbs' => array("admin/dashboard" => "Dashboard", 'admin/jobs/request/approved' => 'Job Requests'),
            'active' => 'job request',
            'jobs' => $jobs,
        ];
        return view('admin.job-request.approved', $data);
    }
    public function approve($id)
    {
        try {
            $request = JobRequest::find($id);
            $job = Job::find($request->job_id);
            $job->update(['user_id' => $request->requested_by]);
            $request->update(['assigned' => true]);
            return redirect()->back()->with('success', 'Job request approved successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
