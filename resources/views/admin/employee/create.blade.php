@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Add Employee</h5>
                <div class="card-body">
                    <form method="post" action="{{ url('admin/employee/store') }}">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name" class="col-form-label">Name</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{old('name')}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email" class="col-form-label">Email</label>
                                <input id="email" type="text" class="form-control" name="email" value="{{old('email')}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="password" class="col-form-label">Password</label>
                                <input id="password" type="text" class="form-control" name="password">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="confirm" class="col-form-label">Confirm Password</label>
                                <input id="confirm" type="text" class="form-control" name="password_confirmation">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
