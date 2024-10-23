@extends('layouts.employee')
@section('content')
    <div class="">
        <div class=" col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header p-4">
                    <a class="pt-2 d-inline-block" href="">
                        <h3 class="mb-0">Job #{{ $job->id }}</h3>
                    </a>

                    <div class="float-right">
                        {{ Carbon\Carbon::parse($job->created_at)->format('d-m-Y') }}</div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-sm-4">
                            <h4>Details : </h4>
                            <table class="table">
                                <tr>
                                    <td><span class="text-dark">Customer : </span></td>
                                    <td>
                                        <p>{{ $job->business->business_name }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="text-dark">Price : </span></td>
                                    <td>
                                        <p>{{ $job->price }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="text-dark">Size : </span></td>
                                    <td>
                                        <p>{{ $job->size->size }}</p>
                                    </td>
                                </tr>

                                <tr>
                                    <td><span class="text-dark">Item : </span></td>
                                    <td>
                                        <p>{{ $job->item->name }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="text-dark">Material : </span></td>
                                    <td>
                                        <p>{{ $job->material }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="text-dark">User : </span></td>
                                    <td>
                                        <select class="form-control" id="select_user" name="user_id"
                                            job-id={{ $job->id }}>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}"
                                                    @if ($user->id == $job->user_id) selected @endif>{{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="text-dark">Status : </span></td>
                                    <td>
                                        <select class="form-control" id="select_status" name="status_id"
                                            job-id={{ $job->id }}>
                                            @foreach ($statusses as $status)
                                                <option value="{{ $status->id }}"
                                                    @if ($status->id == $job->status_id) selected @endif>{{ $status->status }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            {{-- <a href="{{ url('admin/job/edit', $job->id) }}">
                                <button class="btn btn-primary mt-4">Edit Job</button></a> --}}
                        </div>
                        <div class="col-sm-4"
                            style="border-left: 1px solid rgba(0, 0, 0, 0.103); border-right: 1px solid rgba(0, 0, 0, 0.103);">
                            <form method="post" action="{{ url('employee/job/add-notes') }}" id="add_notes_form">
                                @csrf
                                <input type="hidden" name="job_id" value="{{ $job->id }}" id="">
                                <input type="hidden" name="user_id" id="" value="{{ Auth::user()->id }}">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Admin Notes</label>
                                    <textarea class="form-control" id="job_notes" rows="2" name="note"></textarea>
                                </div>
                                <button class="btn btn-primary mb-2 submit_button">+Add Note</button>
                            </form>
                            <div class="table-responsive-sm" style="overflow: hidden; overflow-y: scroll; height: 250px;">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Notes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($job->notes as $key => $note)
                                            <tr class="read-notes" notes="{{ $note->note }}">
                                                <td>{{ $note->user->name }}</td>
                                                <td>{{ Carbon\Carbon::parse($note->created_at)->format('d-m-y') }}</td>
                                                <td
                                                    style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 100px;">
                                                    {{ $note->note }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <form method="post" action="{{ url('employee/job/add-customer-notes') }}"
                                id="add_notes_form_1">
                                @csrf
                                <input type="hidden" name="job_id" value="{{ $job->id }}" id="">
                                <input type="hidden" name="user_id" id="" value="{{ Auth::user()->id }}">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Customer Notes</label>
                                    <textarea class="form-control" id="job_customer_notes" rows="2" name="note"></textarea>
                                </div>
                                <button class="btn btn-primary mb-2 submit_button_1">+Add Note</button>
                            </form>
                            <div class="table-responsive-sm" style="overflow: hidden; overflow-y: scroll; height: 250px;">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Notes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($job->customerNotes as $key => $note)
                                            <tr class="read-notes" notes="{{ $note->note }}">
                                                <td>{{ $note->user->name }}</td>
                                                <td>{{ Carbon\Carbon::parse($note->created_at)->format('d-m-y') }}</td>
                                                <td
                                                    style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 100px;">
                                                    {{ $note->note }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-footer">
                    <form action="{{ url('employee/job/upload-file') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="job_id" id="" value="{{ $job->id }}">
                        <h4 class="mt-2">Add Files</h4>
                        <button type="button" id="add-more" class="btn btn-primary">+Add More</button>
                        <button style="submit" class="btn btn-primary">Upload</button>
                        <div id="image-container">
                            <div class="image-item mt-2">
                                <div class="row mt-3 ">
                                    <div class="col-md-12  "><input type="file" name="images[]" required
                                            class="form-control shadow-sm "></div>
                                    {{-- <div class="col-md-3  "> <button type="button" class="remove-item btn btn-primary w-100">Remove</button></div> --}}
                                </div>
                                <textarea name="image_notes[]" placeholder="Enter note for ths file " required class="form-control"></textarea>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
            <div class="row">
                @foreach ($job->images as $image)
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <button class="btn  btn-sm " data-toggle="tooltip" data-placement="top"
                                    title="  {{ $image->note }}"> Notes </button>
                                <strong class="ml-2">Added By : </strong> {{ $image->user->name }}

                            </div>
                            <div class="card-body text-center">
                                @if ($image->file_type == 'img')
                                    <img class="img-fluid" src="{{ asset($image->file) }}" alt="Card image cap"
                                        style="height: 200px">
                                @else
                                    <img class="img-fluid" src="{{ asset('assets/images/file1.png') }}"
                                        alt="Card image cap" style="height: 200px">
                                @endif
                            </div>
                            <div class="card-footer">
                                <a href="{{ asset($image->file) }}" class="btn btn-primary w-100"
                                    target="__blank">View</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@section('style')
    <style>
        .mytoast {
            position: absolute;
            background-color: #333;
            color: white;
            padding: 10px;
            border-radius: 5px;
            z-index: 1000;
            display: none;
            max-width: 400px;
            word-wrap: break-word;

        }

        .mytoast::after {
            content: '';
            position: absolute;
            bottom: -10px;
            /* Position it above the toast */
            right: 10px;
            /* Align it to the right */
            width: 0;
            height: 0;
            border-left: 10px solid transparent;
            border-right: 10px solid transparent;
            border-top: 10px solid #333;
        }
    </style>
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
                <div class="col-md-2 pr-0"> <button type="button" class="remove-item btn btn-primary w-100">Remove</button></div>
                <div class="col-md-10 pl-0"><input type="file" name="images[]" required class="form-control shadow-sm" ></div>
                </div>
                <textarea name="image_notes[]" placeholder="Enter note for this file" required class="form-control"></textarea>
                 `;
                container.appendChild(newItem);
            });

            document.getElementById('image-container').addEventListener('click', function(e) {
                if (e.target && e.target.classList.contains('remove-item')) {
                    e.target.closest('.image-item').remove();
                }
            });

            // --- add note validation ---
            $('body').on('click', '.submit_button', function(e) {
                e.preventDefault();
                if ($('#job_notes').val().trim() == '') {
                    toastr.error('Please add some admin note');
                } else {
                    $('#add_notes_form').submit();
                }
            });

            // --- add note validation ---
            $('body').on('click', '.submit_button_1', function(e) {
                e.preventDefault();
                if ($('#job_customer_notes').val().trim() == '') {
                    toastr.error('Please add some customer note');
                } else {
                    $('#add_notes_form_1').submit();
                }
            });

            // ---- updating the job status -----
            $('body').on('change', '#select_status', function(e) {
                e.preventDefault();
                var status_id = $(this).val();
                var id = $(this).attr('job-id');
                var data = {
                    status_id: status_id,
                    id: id
                };
                $.ajax({
                    url: "{{ url('employee/job/update-status') }}",
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        toastr.success(response);
                    },
                    error: function(xhr, status, error) {
                        toastr.error(error);
                    }
                });
            });

            // ----- update job user -----
            $('body').on('change', '#select_user', function(e) {
                e.preventDefault();
                var user_id = $(this).val();
                var id = $(this).attr('job-id');
                var data = {
                    id: id,
                    user_id: user_id
                };
                $.ajax({
                    url: "{{ url('employee/job/update-user') }}",
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        toastr.success(response);
                    },
                    error: function(xhr, status, error) {
                        toastr.error(error);
                    }
                });
            });

            // ------ opening notes details model----------
            $('body').append('<div id="custom-toast" class="mytoast"></div>');

            $(document).on('mouseenter', '.read-notes', function(e) {
                e.preventDefault();
                let notes = $(this).attr('notes');
                let toast = $('#custom-toast');

                toast.text(notes);

                let rowPosition = $(this).offset();
                let rowWidth = $(this).outerWidth();
                let toastHeight = toast.outerHeight();
                toast.css({
                    top: (rowPosition.top - toastHeight - 10) + 'px',
                    left: (rowPosition.left + rowWidth) + 'px',
                    transform: 'translate(-100%, 0)',
                });
                toast.stop().fadeIn(200, function() {
                    $(this).css('opacity',
                        1);
                });
            });

            $(document).on('mouseleave', '.read-notes', function(e) {
                $('#custom-toast').css('opacity', 0).fadeOut(
                    200);
            });

        });
    </script>
@endsection
