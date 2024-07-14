@extends('layouts.employee')
@section('content')
    <div class="row">
        <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
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
                        <div class="col-sm-6">
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
                                        <select class="form-control" id="select_user" name="user_id" job-id ={{$job->id}}>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}"  @if ($user->id == $job->user_id) selected @endif>{{ $user->name }}</option>
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
                            <a href="{{ url('admin/job/edit', $job->id) }}">
                                <button class="btn btn-primary mt-4">Edit Job</button></a>
                        </div>
                        <div class="col-sm-6">
                            <form method="post" action="{{ url('employee/job/add-notes') }}" id="add_notes_form">
                                @csrf
                                <input type="hidden" name="job_id" value="{{ $job->id }}" id="">
                                <input type="hidden" name="user_id" id="" value="{{ Auth::user()->id }}">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Notes</label>
                                    <textarea class="form-control" id="job_notes" rows="2" name="note"></textarea>
                                </div>
                                <button class="btn btn-primary mb-2 submit_button">+Add Note</button>
                            </form>
                            <div class="table-responsive-sm" style="overflow: hidden; overflow-y: scroll; height: 250px;">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Notes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($job->notes as $key => $note)
                                            <tr>
                                                <td>{{ $note->user->name }}</td>
                                                <td>{{ $note->note }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>


                </div>

            </div>
        </div>
    </div>
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
            $('body').on('change','#select_user',function(e){
                e.preventDefault();
                var user_id = $(this).val();
                var id = $(this).attr('job-id');
                var data = {
                    id :id,
                    user_id:user_id
                };
                $.ajax({
                    url : "{{url('employee/job/update-user')}}",
                    type: "post",
                    headers : {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data : data,
                    dataType: "json",
                    success:function(response){
                        toastr.success(response);
                    },
                    error:function(xhr, status, error){
                        toastr.error(error);
                    }
                });
            });

        });
    </script>
@endsection
