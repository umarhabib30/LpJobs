<?php

namespace App\Http\Controllers\Customer;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\CustomerNote;
use App\Models\Job;
use App\Models\JobImage;
use App\Models\JobStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Laravel\Ui\Presets\React;

class CustomerJobController extends Controller
{

    public function index($id)
    {
        $business = Business::find($id);
        $jobs = $business->jobs;
        $data = [
            'title' => 'Jobs',
            'breadcrumbs' => array("customer/dashboard" => "Dashboard"),
            'active' => 'Dashboard',
            'jobs' => $jobs,
        ];
        return view('customer.jobs.index', $data);
    }


    public function addCustomerNote(Request $request)
    {
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


    public function show($id)
    {
        $job = Job::with('notes')->with('customerNotes')->find($id);
        $data = [
            'title' => 'Job Details',
            'breadcrumbs' => array("customer/dashboard" => "Dashboard", 'customer/job/details/' . $job->id => 'Job Details'),
            'active' => 'jobs',
            'job' => $job,
            'statusses' => JobStatus::all(),
            'users' => User::where('role', 2)->get(),
        ];
        return view('customer.jobs.details', $data);
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
}
