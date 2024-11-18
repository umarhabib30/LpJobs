@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

            <div class="card">
                <h5 class="card-header">Add Customer</h5>
                <div class="card-body">
                    <form method="post" action="{{ url('admin/customer/store') }}" id="add_customer_form">
                        @csrf

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="customer_name" class="col-form-label">Customer Name</label>
                                <input id="customer_name" type="text" class="form-control"  name="customer_name"
                                    value="{{ old('customer_name') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="mobile" class="col-form-label">Mobile</label>
                                <input id="mobile" type="text" class="form-control"  name="mobile"
                                    value="{{ old('mobile') }}">
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="address" class="col-form-label">Door No</label>
                                <input id="address" type="text" class="form-control"  name="address"
                                    value="{{ old('address') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email" class="col-form-label">Email</label>
                                <input id="email" type="text" class="form-control"  name="email"
                                    value="{{ old('email') }}">
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="road" class="col-form-label">Road</label>
                                <input id="road" type="text" class="form-control"  name="road"
                                    value="{{ old('road') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password" class="col-form-label">Password</label>
                                <input id="password" type="text" class="form-control"  name="password"
                                    value="{{ old('road') }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="town" class="col-form-label">Town</label>
                                <input id="town" type="text" class="form-control"  name="town"
                                    value="{{ old('town') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password_confirmation" class="col-form-label">Confirm Password</label>
                                <input id="password_confirmation" type="text" class="form-control"  name="password_confirmation"
                                    value="{{ old('town') }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="city" class="col-form-label">City</label>
                                <input id="city" type="text" class="form-control"  name="city"
                                    value="{{ old('city') }}">
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="post_code" class="col-form-label">Postal Code</label>
                                <input id="post_code" type="text" class="form-control"  name="post_code"
                                    value="{{ old('post_code') }}">
                            </div>

                        </div>
                        <button class="btn btn-primary" id="submit_button">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
