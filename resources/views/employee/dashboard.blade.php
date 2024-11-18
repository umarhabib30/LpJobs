@extends('layouts.employee')
@section('content')
<div class="row">
    <!-- ============================================================== -->
    <!-- basic table  -->
    <!-- ============================================================== -->
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">All Jobs</h5>
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
                                <th>Assigned to</th>
                                <th style="width: 120px">Request to Assign</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!$jobs->isEmpty())
                                @foreach ($jobs as $job)
                                    <tr>
                                        <td>{{ $job->id }}</td>
                                        <td>{{ $job->business->business_name }}</td>
                                        <td>{{ $job->item->name }}</td>
                                        <td>{{ $job->size->size }}</td>
                                        <td>{{ $job->quantity }}</td>
                                        <td>{{ $job->status->status }}</td>
                                        <td>{{ $job->assignedTo->name }}</td>
                                        <td><a href="{{ url('employee/job/request', $job->id) }}"><button
                                                    class="btn btn-primary w-100">Request</button></a></td>
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
