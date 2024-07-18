@extends('layouts.app')
@section('content')
<div class="row">
    <!-- ============================================================== -->
    <!-- basic table  -->
    <!-- ============================================================== -->
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Job Requests</h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered first">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer</th>
                                <th>Price</th>
                                <th>Size</th>
                                <th>Item</th>
                                <th>User</th>
                                <th>Status</th>
                                <th>Requested By</th>
                                <th style="width: 120px">Approve request</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!$jobs->isEmpty())
                                @foreach ($jobs as $key=> $job)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $job->job->business->business_name }}</td>
                                        <td>{{ $job->job->price }}</td>
                                        <td>{{ $job->job->size->size }}</td>
                                        <td>{{ $job->job->item->name }}</td>
                                        <td>{{ $job->job->user->name }}</td>
                                        <td>{{ $job->job->status->status }}</td>
                                        <td>{{ $job->requestedBy->name }}</td>
                                        <td><a href="{{ url('admin/job/request/approve', $job->id) }}"><button
                                                    class="btn btn-primary w-100">Approve</button></a></td>
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
