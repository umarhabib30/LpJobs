@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

            <div class="card">
                {{-- <h5 class="card-header">Basic Form</h5> --}}
                <div class="card-body">
                    <form method="post" action="{{ url('admin/job/update') }}">
                        @csrf
                        <input type="hidden" name="job_id" value="{{$job->id}}" id="">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="input-select" class="col-form-label">Select Business</label>
                                <select class="form-control" id="input-select" name="customer" >
                                    @foreach ($businesses as $business)
                                        <option value="{{ $business->business_name }}" @if ($business->business_name == $job->customer) selected @endif>{{ $business->business_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="business_name" class="col-form-label">Select Item</label>
                                <select class="form-control" id="input-select" name="item">

                                    @foreach ($items as $item)
                                        <option value="{{ $item->name }}"  @if ($item->name == $job->item) selected @endif>{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="input-select" class="col-form-label">Quantity</label>
                                <select class="form-control" id="input-select" name="quantity">

                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}"  @if ($i == $job->quantity) selected @endif>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="business_name" class="col-form-label">Size</label>
                                <select class="form-control" id="input-select" name="size">

                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->size }}"  @if ($size->size == $job->size) selected @endif>{{ $size->size }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="input-select" class="col-form-label">Order Taken By</label>
                                <select class="form-control" id="input-select" name="user">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->name }}"  @if ($user->name == $job->user) selected @endif>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="business_name" class="col-form-label">Job Status</label>
                                <select class="form-control" id="input-select" name="status">

                                    @foreach ($statusses as $status)
                                        <option value="{{ $status->status }}"  @if ($status->status == $job->status) selected @endif>{{ $status->status }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="road" class="col-form-label">Material</label>
                                <input id="road" type="text" class="form-control" name="material" value="{{@$job->material}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="town" class="col-form-label">Price</label>
                                <input id="town" type="text" class="form-control" name="price" value="{{@$job->price}}">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Job</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
