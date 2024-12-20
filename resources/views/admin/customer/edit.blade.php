@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

            <div class="card">
                <h5 class="card-header">Upate Customer</h5>
                <div class="card-body">
                    <form method="post" action="{{ url('admin/customer/update') }}" id="add_customer_form">
                        @csrf
                        <input type="hidden" name="id" id="" value="{{$customer->id}}">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="customer_name" class="col-form-label">Customer Name</label>
                                <input id="customer_name" type="text" class="form-control"  name="name" value="{{old('name',$customer->name)}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="address" class="col-form-label">Door No</label>
                                <input id="address" type="text" class="form-control"  name="address" value="{{old('address',$customer->customerDetail->address)}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="road" class="col-form-label">Road</label>
                                <input id="road" type="text" class="form-control"  name="road" value="{{old('road',$customer->customerDetail->road)}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="town" class="col-form-label">Town</label>
                                <input id="town" type="text" class="form-control"  name="town" value="{{old('town',$customer->customerDetail->town)}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="city" class="col-form-label">City</label>
                                <input id="city" type="text" class="form-control"  name="city" value="{{old('city',$customer->customerDetail->city)}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="post_code" class="col-form-label">Postal Code</label>
                                <input id="post_code" type="text" class="form-control"  name="post_code" value="{{old('post_code',$customer->customerDetail->post_code)}}">
                            </div>
                        </div>
                        <div class="row">

                            <div class="form-group col-md-6">
                                <label for="mobile" class="col-form-label">Mobile</label>
                                <input id="mobile" type="text" class="form-control"  name="mobile" value="{{old('mobile',$customer->customerDetail->mobile)}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email" class="col-form-label">Email</label>
                                <input id="email" type="text" class="form-control"  name="email" value="{{old('email',$customer->email)}}" >
                            </div>
                        </div>
                        <button  class="btn btn-primary" id="submit_button">Update customer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

@endsection
