@extends('layouts.customer')

@section('content')
    <div class="row">
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
                        <div class="col-sm-5">
                            <h4>Job Details : </h4>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td><span class="text-dark">Item </span></td>
                                        <td><span class="text-dark">Price </span></td>
                                        <td><span class="text-dark">Employee </span></td>
                                        <td><span class="text-dark">Status </span></td>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <p>{{ $job->item->name }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $job->price }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $job->assignedTo->name }}</p>
                                        </td>
                                        <td>
                                            <p>{{ $job->status->status }}</p>
                                        </td>
                                    </tr>
                                </tbody>


                            </table>
                            <hr>
                            {{-- <a href="{{ url('admin/job/edit', $job->id) }}">
                                <button class="btn btn-primary mt-4">Edit Job</button></a> --}}
                            <form action="{{ url('customer/job/upload-file') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="job_id" id="" value="{{ $job->id }}">
                                <h4 class="mt-2">Add Files</h4>
                                <button type="button" id="add-more" class="btn btn-primary">+Add More</button>

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

                                <button style="submit" class="btn btn-primary mt-3">Upload</button>
                            </form>
                        </div>
                        <div class="col-sm-7">
                            <form method="post" action="{{ url('customer/job/add-customer-notes') }}" id="add_notes_form">
                                @csrf
                                <input type="hidden" name="job_id" value="{{ $job->id }}" id="">
                                <input type="hidden" name="user_id" id="" value="{{ Auth::user()->id }}">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">
                                        <h4>Notes</h4>
                                    </label>
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
            </div>

            <div class="row">
                @foreach ($job->images as $image)
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <button  class="btn  btn-sm "  data-toggle="tooltip" data-placement="top" title="  {{$image->note}}">  Notes  </button>
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
                                <a href="{{ asset($image->file) }}" class="btn btn-primary w-100" target="__blank">View</a>
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
            // --- add note validation ---
            $('body').on('click', '.submit_button', function(e) {
                e.preventDefault();
                if ($('#job_notes').val().trim() == '') {
                    toastr.error('Please add some note');
                } else {
                    $('#add_notes_form').submit();
                }
            });

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