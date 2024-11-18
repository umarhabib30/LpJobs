<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Item;
use App\Models\Job;
use App\Models\JobAssignmentUpdates;
use App\Models\JobImage;
use App\Models\JobStatus;
use App\Models\JobStatusUpdates;
use App\Models\Note;
use App\Models\Size;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Helpers\FileHelper;

class AdminJobController extends Controller
{
    public function index()
    {
        $jobs = Job::latest()->get();
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
            'businesses' => Business::all(),
            'items' => Item::all(),
            'sizes' => Size::all(),
            'users' => User::where('role', 2)->get(),
            'statusses' => JobStatus::all(),
        ];
        return view('admin.job.create', $data);
    }

    public function store(Request $request)
    {

        $user = Auth::user();
        try {
        $job = Job::create($request->all());
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $image) {
                $mimeType = $file->getMimeType();
                if (str_starts_with($mimeType, 'image/')) {
                    $fileType = 'img';
                } else {
                    $fileType = 'other';
                }
                $path = FileHelper::save($file, 'images');
                JobImage::create([
                    'user_id' => $user->id,
                    'job_id' => $job->id,
                    'file' => $path,
                    'note' => $request->image_notes[$key],
                    'file_type' =>  $fileType,
                ]);
            }
        }
        Note::create(['note' => $request->notes, 'job_id' => $job->id, 'user_id' => $user->id]);
        return redirect()->back()->with('success', 'Job added successfully');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function details($id)
    {
        $job = Job::where('id',$id)->with('notes')->first();
        $data = [
            'title' => 'Job Details',
            'active' => 'Job Details',
            'job' => $job,
        ];
        return view('admin.job.details', $data);
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

    public function edit($id)
    {
        $job = Job::find($id);
        $data = [
            'title' => 'Edit Job',
            'breadcrumbs' => array("admin/dashboard" => "Dashboard", 'admin/jobs/index' => 'Jobs', 'admin/job/edit/' . $job->id => 'Edit Job'),
            'active' => 'Jobs',
            'custom' => 'Job no:'.$job->id,
            'job' => $job,
            'businesses' => Business::all(),
            'items' => Item::all(),
            'sizes' => Size::all(),
            'users' => User::where('role', 2)->get(),
            'statusses' => JobStatus::all(),
        ];
        return view('admin.job.edit', $data);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'material' => 'required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->first());
            return redirect()->back()->withInput();
        }
        $job = Job::find($request->job_id);

        if ($job->status_id != $request->status_id) {
            JobStatusUpdates::create(['job_id' => $job->id, 'status_id' => $request->status_id, 'updated_by' => $user->id]);
        }

        if ($job->user_id != $request->user_id) {
            JobAssignmentUpdates::create(['job_id' => $job->id, 'employee_id' => $request->user_id, 'updated_by' => $user->id]);
        }

        $job->update($request->all());
        return redirect()->back()->with('success', 'Job updated successfully');
    }

    public function delete($id)
    {
        $Job = Job::find($id);
        $Job->delete();
        return redirect()->back()->with('success', 'Job deleted successfully');
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
