@extends('layouts.app')
@section('content')
<div class="row">
    <!-- ============================================================== -->
    <!-- basic table  -->
    <!-- ============================================================== -->
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Basic Table</h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered first">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Business</th>
                                <th>Item</th>
                                <th>Size</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th>User</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (! $jobs->isEmpty())

                            @foreach ($jobs as $job)
                                <tr>
                                    <td>{{ $job->id }}</td>
                                    <td>{{ $job->customer }}</td>
                                    <td>{{ $job->item }}</td>
                                    <td>{{ $job->size }}</td>
                                    <td>{{ $job->quantity }}</td>
                                    <td>{{ $job->status }}</td>
                                    <td>{{ $job->user }}</td>
                                    <td><a href="{{url('admin/job/edit',$job->id)}}"><button class="btn btn-primary w-100">Edit</button></a></td>
                                    <td><a href="{{url('admin/job/delete',$job->id)}}"><button class="btn btn-danger w-100">Delete</button></a></td>
                                    <td><a href="{{url('admin/job/details',$job->id)}}"><button class="btn btn-primary w-100">View</button></a></td>
                                </tr>
                            @endforeach
                            @else
                                No record found
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end basic table  -->
    <!-- ============================================================== -->
</div>
@endsection
