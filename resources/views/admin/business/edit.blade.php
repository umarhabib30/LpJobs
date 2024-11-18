@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

            <div class="card">
                <h5 class="card-header">Edit Business</h5>
                <div class="card-body">
                    <form method="post" action="{{ url('admin/business/update') }}" id="add_business_form">
                        @csrf
                        <input type="hidden" name="notes_id" id="" value="{{ @$business->notes_id }}">
                        <input type="hidden" name="business_id" id="" value="{{ @$business->id }}">
                        {{-- <div class="form-group">
                            <label for="input-select">Select Category</label>
                            <select class="form-control" id="input-select" name="cat_id">

                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if ($category->id == $business->cat_id) selected @endif>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div> --}}
                        <div class="row">

                            <div class="form-group col-md-6">
                                <label for="customer" class="col-form-label">Customer</label>
                                <input id="customer" type="text" class="form-control" name="" value="{{ $business->customer->name }}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="business_name" class="col-form-label">Business Name</label>
                                <input id="business_name" type="text" class="form-control" name="business_name"
                                    value="{{ $business->business_name }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="address" class="col-form-label">Door No</label>
                                <input id="address" type="text" class="form-control" name="address"
                                    value="{{ $business->address }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="road" class="col-form-label">Road</label>
                                <input id="road" type="text" class="form-control" name="road"
                                    value="{{ @$business->road }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="town" class="col-form-label">Town</label>
                                <input id="town" type="text" class="form-control" name="town"
                                    value="{{ @$business->town }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="city" class="col-form-label">City</label>
                                <input id="city" type="text" class="form-control" name="city"
                                    value="{{ @$business->city }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="post_code" class="col-form-label">Postal Code</label>
                                <input id="post_code" type="text" class="form-control" name="post_code"
                                    value="{{ @$business->post_code }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="tel" class="col-form-label">Telephone</label>
                                <input id="tel" type="text" class="form-control" name="tel"
                                    value="{{ @$business->tel }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="mobile" class="col-form-label">Mobile</label>
                                <input id="mobile" type="text" class="form-control" name="mobile"
                                    value="{{ @$business->mobile }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="email" class="col-form-label">Email</label>
                                <input id="email" type="text" class="form-control" name="email"
                                    value="{{ @$business->email }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="web" class="col-form-label">Website</label>
                                <input id="web" type="text" class="form-control" name="web"
                                    value="{{ @$business->web }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Notes</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="notes">{{ @$business->notes }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" id="submit_button">Update Business</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script>

</script>
@endsection

