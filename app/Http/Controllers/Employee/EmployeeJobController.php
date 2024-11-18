<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Models\CustomerNote;
use App\Models\Job;
use App\Models\JobAssignmentUpdates;
use App\Models\JobImage;
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
        $jobs = Job::where('assigned_to_id', $user->id)->latest()->get();
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
        $job = Job::with('notes')->with('customerNotes')->find($id);
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
        return redirect()->back()->with('success', 'Admin note added successfully');
    }

    public function addCustomerNote(Request $request){
        $validator = Validator::make($request->all(), [
            'note' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->first());
            return redirect()->back()->withInput();
        }
        CustomerNote::create($request->all());
        return redirect()->back()->with('success', 'Customer note added successfully');
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

    public function uploadFile(Request $request)
    {
        $user = Auth::user();

        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $key => $file) {
                $mimeType = $file->getMimeType();
                if (str_starts_with($mimeType, 'image/')) {
                    $fileType = 'img';
                } else {
                    $fileType = 'other';
                }
                $path = FileHelper::save($file, 'images');
                JobImage::create([
                    'user_id' => $user->id,
                    'job_id' => $request->job_id,
                    'file' => $path,
                    'note' => $request->image_notes[$key],
                    'file_type' => $fileType,
                ]);
            }
        }
        return redirect()->back()->with('success','File uploaded successfully');
    }

    public function hideImage($id){
        $image = JobImage::find($id);
        $image->update([
            'hide' => true
        ]);
        return redirect()->back()->with('success','Image hidden successfully');
    }
}
