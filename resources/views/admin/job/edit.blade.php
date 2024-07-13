@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

            <div class="card">
                <h5 class="card-header">Edit job</h5>
                <div class="card-body">
                    <form method="post" action="{{ url('admin/job/update') }}">
                        @csrf
                        <input type="hidden" name="job_id" value="{{$job->id}}" id="">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="input-select" class="col-form-label">Select Business</label>
                                <select class="form-control" id="input-select" name="customer_id" >
                                    @foreach ($businesses as $business)
                                        <option value="{{ $business->id }}" @if ($business->id == $job->customer_id) selected @endif>{{ $business->business_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="business_name" class="col-form-label">Select Item</label>
                                <select class="form-control" id="input-select" name="item_id">

                                    @foreach ($items as $item)
                                        <option value="{{ $item->id }}"  @if ($item->id == $job->item_id) selected @endif>{{ $item->name }}
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
                                <select class="form-control" id="input-select" name="size_id">

                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->id }}"  @if ($size->id == $job->size_id) selected @endif>{{ $size->size }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="input-select" class="col-form-label">Order Taken By</label>
                                <select class="form-control" id="input-select" name="user_id">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"  @if ($user->id == $job->user_id) selected @endif>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="business_name" class="col-form-label">Job Status</label>
                                <select class="form-control" id="input-select" name="status_id">

                                    @foreach ($statusses as $status)
                                        <option value="{{ $status->id }}"  @if ($status->id == $job->status_id) selected @endif>{{ $status->status }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="material" class="col-form-label">Material</label>
                                <input id="material" type="text" class="form-control" name="material" value="{{@$job->material}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="price" class="col-form-label">Price</label>
                                <input id="price" type="text" class="form-control" name="price" value="{{@$job->price}}">
                            </div>
                        </div>

                        <button class="btn btn-primary  submit_button">Update Job</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('body').on('click','.submit_button',function(e){
                e.preventDefault();
                if($('#material').val().trim() == ''){
                    toastr.error('Please enter material');
                }else if($('#price').val().trim() == ''){
                    toastr.error('Please enter price');
                }else{
                    $('form').submit(); 
                }
            });
        });
    </script>
@endsection
