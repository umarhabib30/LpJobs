@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

            <div class="card">
                {{-- <h5 class="card-header">Basic Form</h5> --}}
                <div class="card-body">
                    <form method="post" action="{{ url('admin/job/store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            {{-- select business --}}
                            <div class="form-group col-md-6">
                                <label for="input-select" class="col-form-label">Select Business</label>
                                <select class="form-control select_customer" id="input-select" name="business_id">
                                    <option value="-1" selected>Select Business</option>
                                    @foreach ($businesses as $business)
                                        <option value="{{ $business->id }}">{{ $business->business_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- order taken by --}}
                            <div class="form-group col-md-6">
                                <label for="input-select" class="col-form-label">Order Taken By</label>
                                <input type="hidden" name="order_taken_by" value="{{ Auth::user()->id }}">
                                <input type="text" class="form-control material_input" value="{{ Auth::user()->name }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="row">
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
                            <div class="form-group col-md-6">
                                <label for="input-select" class="col-form-label">Assign to</label>
                                <select class="form-control select_user" id="input-select" name="assigned_to_id">
                                    <option selected value="-1">Select User</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="business_name" class="col-form-label">Size</label>
                                <select class="form-control select_size" id="input-select" name="size_id">
                                    <option selected value="-1">Select Size</option>
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->id }}">{{ $size->size }}</option>
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
                                <label for="input-select select_quantity" class="col-form-label">Quantity</label>
                                <select class="form-control" id="input-select" name="quantity">
                                    <option selected value="-1">Select Quantity</option>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleFormControlTextarea1">Notes</label>
                                <textarea class="form-control" id="job_notes" rows="1" name="notes"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="road" class="col-form-label">Material</label>
                                <input id="road" type="text" class="form-control material_input" name="material">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="town" class="col-form-label">Price</label>
                                <input id="town" type="text" class="form-control price_input" name="price">
                            </div>
                        </div>


                        <h3>Add Images</h3>
                        <button type="button" id="add-more" class="btn btn-primary">+Add</button>
                        <div id="image-container">
                            <div class="image-item mt-2 mb-4">
                                <div class="row mt-3">
                                    <div class="col-md-1 pr-0"> <button type="button"
                                            class="remove-item btn btn-primary w-100">Remove</button></div>
                                    <div class="col-md-11 pl-0"><input type="file" name="images[]" required
                                            class="form-control"></div>
                                </div>
                                <textarea name="image_notes[]" placeholder="Enter note for the image" required class="form-control"></textarea>
                            </div>
                        </div>
                        <button class="btn btn-primary mt-3" id="submit_button">Add Job</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {

            document.getElementById('add-more').addEventListener('click', function() {
                var container = document.getElementById('image-container');
                var newItem = document.createElement('div');
                newItem.classList.add('image-item');
                newItem.innerHTML = `
                <div class="row mt-3">
                <div class="col-md-1 pr-0"> <button type="button" class="remove-item btn btn-primary w-100">Remove</button></div>
                <div class="col-md-11 pl-0"><input type="file" name="images[]" required class="form-control" ></div>
                </div>
                <textarea name="image_notes[]" placeholder="Enter note for the image" required class="form-control"></textarea>
                 `;
                container.appendChild(newItem);
            });

            document.getElementById('image-container').addEventListener('click', function(e) {
                if (e.target && e.target.classList.contains('remove-item')) {
                    e.target.closest('.image-item').remove();
                }
            });


            $('body').on('click', '#submit_button', function(e) {
                e.preventDefault();

                if ($('.select_customer').val() == -1) {
                    toastr.error('Please select business');
                } else if ($('.select_item').val() == -1) {
                    toastr.error('Please select item');
                } else if ($('select[name="quantity"]').val() == -1) {
                    toastr.error('Please select quantity');
                } else if ($('.select_size').val() == -1) {
                    toastr.error('Please select size');
                } else if ($('.select_user').val() == -1) {
                    toastr.error('Please select user');
                } else if ($('.select_status').val() == -1) {
                    toastr.error('Please select status');
                } else if ($('.material_input').val().trim() == '') {
                    toastr.error('Please enter material');
                } else if ($('.price_input').val().trim() == '') {
                    toastr.error('Please enter price');
                } else if ($('#job_notes').val().trim() == '') {
                    toastr.error('Please enter notes');
                } else {
                    var isValid = true;

                    $('#image-container .image-item').each(function() {
                        var imageInput = $(this).find('input[type="file"]');
                        var noteInput = $(this).find('textarea[name="image_notes[]"]');

                        if (imageInput.val().trim() == '') {
                            toastr.error('Please upload an image');
                            isValid = false;
                            return false; // Break out of each loop
                        }

                        if (noteInput.val().trim() == '') {
                            toastr.error('Please enter a note for the image');
                            isValid = false;
                            return false; // Break out of each loop
                        }
                    });

                    if (isValid) {
                        $('form').submit();
                    }
                }
            });

        });
    </script>
@endsection
