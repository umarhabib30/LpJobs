@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

            <div class="card">
                {{-- <h5 class="card-header">Basic Form</h5> --}}
                <div class="card-body">
                    <form method="post" action="{{ url('admin/job/store') }}">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="input-select" class="col-form-label">Select Business</label>
                                <select class="form-control" id="input-select" name="customer" >
                                    <option selected>Select Business</option>
                                    @foreach ($businesses as $business)
                                        <option value="{{ $business->business_name }}">{{ $business->business_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="business_name" class="col-form-label">Select Item</label>
                                <select class="form-control" id="input-select" name="item">
                                    <option selected>Select Item</option>
                                    @foreach ($items as $item)
                                        <option value="{{ $item->name }}">{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="input-select" class="col-form-label">Quantity</label>
                                <select class="form-control" id="input-select" name="quantity">
                                    <option selected>Select Quantity</option>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="business_name" class="col-form-label">Size</label>
                                <select class="form-control" id="input-select" name="size">
                                    <option selected>Select Size</option>
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->size }}">{{ $size->size }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="input-select" class="col-form-label">Order Taken By</label>
                                <select class="form-control" id="input-select" name="user">
                                    <option selected>Select User</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->name }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="business_name" class="col-form-label">Job Status</label>
                                <select class="form-control" id="input-select" name="status">
                                    <option selected>Select Status</option>
                                    @foreach ($statusses as $status)
                                        <option value="{{ $status->status }}">{{ $status->status }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="road" class="col-form-label">Material</label>
                                <input id="road" type="text" class="form-control" name="material">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="town" class="col-form-label">Price</label>
                                <input id="town" type="text" class="form-control" name="price">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Notes</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="notes"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Job</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
