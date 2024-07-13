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
                                <select class="form-control select_customer" id="input-select" name="customer_id" >
                                    <option value="-1" selected>Select Business</option>
                                    @foreach ($businesses as $business)
                                        <option value="{{ $business->id }}">{{ $business->business_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="business_name" class="col-form-label">Select Item</label>
                                <select class="form-control select_item" id="input-select" name="item_id">
                                    <option selected value="-1">Select Item</option>
                                    @foreach ($items as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="input-select select_quantity" class="col-form-label">Quantity</label>
                                <select class="form-control" id="input-select" name="quantity">
                                    <option selected value="-1">Select Quantity</option>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="business_name" class="col-form-label">Size</label>
                                <select class="form-control select_size" id="input-select" name="size_id">
                                    <option selected value="-1">Select Size</option>
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->id }}">{{ $size->size }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="input-select" class="col-form-label">Order Taken By</label>
                                <select class="form-control select_user" id="input-select" name="user_id">
                                    <option selected value="-1">Select User</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="business_name" class="col-form-label">Job Status</label>
                                <select class="form-control select_status" id="input-select" name="status_id">
                                    <option selected value="-1">Select Status</option>
                                    @foreach ($statusses as $status)
                                        <option value="{{ $status->id }}">{{ $status->status }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="road" class="col-form-label">Material</label>
                                <input id="road" type="text" class="form-control material_input" name="material">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="town" class="col-form-label">Price</label>
                                <input id="town" type="text" class="form-control price_input" name="price">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Notes</label>
                            <textarea class="form-control" id="job_notes" rows="3" name="notes"></textarea>
                        </div>
                        <button  class="btn btn-primary" id="submit_button">Add Job</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
   $(document).ready(function(){
    $('body').on('click','#submit_button',function(e){
        e.preventDefault();

        if($('.select_customer').val() == -1){
            toastr.error('Please select business');
        } else if($('.select_item').val() == -1){
            toastr.error('Please select item');
        } else if($('select[name="quantity"]').val() == -1){
            toastr.error('Please select quantity');
        } else if($('.select_size').val() == -1){
            toastr.error('Please select size');
        } else if($('.select_user').val() == -1){
            toastr.error('Please select user');
        } else if($('.select_status').val() == -1){
            toastr.error('Please select status');
        } else if($('.material_input').val().trim() == ''){
            toastr.error('Please enter material');
        } else if($('.price_input').val().trim() == ''){
            toastr.error('Please enter price');
        } else if($('#job_notes').val().trim() == ''){
            toastr.error('Please enter notes');
        } else {
            $('form').submit();
        }
    });
});

</script>
@endsection
