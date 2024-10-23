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
                                <input id="tel" type="text" class="form-control" required name="tel"
                                    value="{{ old('tel') }}">
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="address" class="col-form-label">Door No</label>
                                <input id="address" type="text" class="form-control" required name="address"
                                    value="{{ old('address') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="mobile" class="col-form-label">Mobile</label>
                                <input id="mobile" type="text" class="form-control" required name="mobile"
                                    value="{{ old('mobile') }}">
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="road" class="col-form-label">Road</label>
                                <input id="road" type="text" class="form-control" required name="road"
                                    value="{{ old('road') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email" class="col-form-label">Email</label>
                                <input id="email" type="text" class="form-control" required name="email"
                                    value="{{ old('email') }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="town" class="col-form-label">Town</label>
                                <input id="town" type="text" class="form-control" required name="town"
                                    value="{{ old('town') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="web" class="col-form-label">Website</label>
                                <input id="web" type="text" class="form-control" required name="web"
                                    value="{{ old('web') }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="city" class="col-form-label">City</label>
                                <input id="city" type="text" class="form-control" required name="city"
                                    value="{{ old('city') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleFormControlTextarea1">Notes</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="1" required name="notes"></textarea>
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="post_code" class="col-form-label">Postal Code</label>
                                <input id="post_code" type="text" class="form-control" required name="post_code"
                                    value="{{ old('post_code') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="input-select">Select Customer</label>
                                <select class=" form-control category_selected" id="input-select" name="user_id" required>
                                    <option selected value="-1">Select Customer</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button class="btn btn-primary" id="submit_button">Add Business</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('body').on('click', '#submit_button', function(e) {
                e.preventDefault();

                var isValid = true;
                var cat_id = $('.category_selected').val();


                    var fields = [{
                            id: '#business_name',
                            message: 'Please enter business name'
                        },
                        {
                            id: '#address',
                            message: 'Please enter door number'
                        },
                        {
                            id: '#road',
                            message: 'Please enter road'
                        },
                        {
                            id: '#town',
                            message: 'Please enter town'
                        },
                        {
                            id: '#city',
                            message: 'Please enter city'
                        },
                        {
                            id: '#post_code',
                            message: 'Please enter postal code'
                        },
                        {
                            id: '#tel',
                            message: 'Please enter telephone number'
                        },
                        {
                            id: '#mobile',
                            message: 'Please enter mobile number'
                        },
                        {
                            id: '#email',
                            message: 'Please enter email address'
                        },
                        {
                            id: '#web',
                            message: 'Please enter website'
                        },
                        {
                            id: '#exampleFormControlTextarea1',
                            message: 'Please enter notes'
                        }
                    ];

                    for (var i = 0; i < fields.length; i++) {
                        if ($(fields[i].id).val() === '') {
                            toastr.error(fields[i].message);
                            isValid = false;
                            break;
                        }
                    }



                if (isValid) {
                    $('#add_business_form').off('submit').submit();
                }
            });
        });
    </script>
@endsection
