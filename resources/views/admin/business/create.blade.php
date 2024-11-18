@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

            <div class="card">
                <h5 class="card-header">Add Business</h5>
                <div class="card-body">
                    <form method="post" action="{{ url('admin/business/store') }}" id="add_business_form">
                        @csrf
                        {{-- <div class="form-group">
                            <label for="input-select">Select Category</label>
                            <select class=" form-control category_selected" id="input-select" name="cat_id">
                                <option selected value="-1">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div> --}}
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="business_name" class="col-form-label">Business Name</label>
                                <input id="business_name" type="text" class="form-control" required name="business_name"
                                    value="{{ old('business_name') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tel" class="col-form-label">Telephone</label>
                                <input id="tel" type="text" class="form-control"  name="tel"
                                    value="{{ old('tel') }}">
                            </div>


                            <div class="form-group col-md-6">
                                <label for="address" class="col-form-label">Door No</label>
                                <input id="address" type="text" class="form-control"  name="address"
                                    value="{{ old('address') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="mobile" class="col-form-label">Mobile</label>
                                <input id="mobile" type="text" class="form-control"  name="mobile"
                                    value="{{ old('mobile') }}">
                            </div>


                            <div class="form-group col-md-6">
                                <label for="road" class="col-form-label">Road</label>
                                <input id="road" type="text" class="form-control"  name="road"
                                    value="{{ old('road') }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="town" class="col-form-label">Town</label>
                                <input id="town" type="text" class="form-control"  name="town"
                                    value="{{ old('town') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="web" class="col-form-label">Website</label>
                                <input id="web" type="text" class="form-control"  name="web"
                                    value="{{ old('web') }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="city" class="col-form-label">City</label>
                                <input id="city" type="text" class="form-control"  name="city"
                                    value="{{ old('city') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleFormControlTextarea1">Notes</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="1"  name="notes"></textarea>
                            </div>


                            <div class="form-group col-md-6">
                                <label for="post_code" class="col-form-label">Postal Code</label>
                                <input id="post_code" type="text" class="form-control"  name="post_code"
                                    value="{{ old('post_code') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="input-select">Select Customer</label>
                                <select class="form-control category_selected" id="select_customer" name="user_id" required>
                                    <option value="" disabled selected>Select Customer</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}" title="{{$customer->customerDetail->address}}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit" id="submit_button">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

