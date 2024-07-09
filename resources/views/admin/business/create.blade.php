@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

        <div class="card">
            {{-- <h5 class="card-header">Basic Form</h5> --}}
            <div class="card-body">
                <form method="post" action="{{url('admin/business/store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="input-select">Select Category</label>
                        <select class="form-control" id="input-select" name="cat_id">
                            <option selected>Select Category</option>
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="business_name" class="col-form-label">Business Name</label>
                            <input id="business_name" type="text" class="form-control" name="business_name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="address" class="col-form-label">Door No</label>
                            <input id="address" type="text" class="form-control" name="address">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="road" class="col-form-label">Road</label>
                            <input id="road" type="text" class="form-control" name="road">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="town" class="col-form-label">Town</label>
                            <input id="town" type="text" class="form-control" name="town">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="city" class="col-form-label">City</label>
                            <input id="city" type="text" class="form-control" name="city">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="post_code" class="col-form-label">Postal Code</label>
                            <input id="post_code" type="text" class="form-control" name="post_code">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="tel" class="col-form-label">Telephone</label>
                            <input id="tel" type="text" class="form-control" name="tel">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mobile" class="col-form-label">Mobile</label>
                            <input id="mobile" type="text" class="form-control" name="mobile">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="email" class="col-form-label">Email</label>
                            <input id="email" type="text" class="form-control" name="email">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="web" class="col-form-label">Website</label>
                            <input id="web" type="text" class="form-control" name="web">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Notes</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="notes"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Business</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
