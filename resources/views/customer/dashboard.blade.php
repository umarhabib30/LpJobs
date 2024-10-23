@extends('layouts.customer')
@section('content')
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="card">
        <h5 class="card-header">Your Businesses</h5>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered first">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th style="width: 120px;">Jobs</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!$businesses->isEmpty())
                            @foreach ($businesses as $business)
                                <tr>
                                    <td>{{ $business->id }}</td>
                                    <td>{{ $business->business_name }}</td>
                                    <td>{{ $business->address }}</td>
                                    <td>{{ $business->mobile }}</td>
                                    <td>{{ $business->email }}</td>
                                    <td><a href="{{url('customer/business/jobs',$business->id)}}"><button class="btn btn-primary w-100">View</button></a></td>
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
@endsection
