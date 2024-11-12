@extends('layouts.app')
@section('content')
    <div class="row">
        <!-- ============================================================== -->
        <!-- basic table  -->
        <!-- ============================================================== -->
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Jobs</h5>
                </div>
                <div class="card-body">
                    <!-- Form for job selection -->
                    <form id="jobForm" action="{{ url('admin/generate/invoice') }}" method="POST">
                        @csrf

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered first">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="select-all"> <!-- Select All Checkbox --></th>
                                        <th>#</th>
                                        <th>Business</th>
                                        <th>Item</th>
                                        <th>Size</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                        <th>Assigned to</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$jobs->isEmpty())
                                        @foreach ($jobs as $job)
                                            <tr>
                                                <td><input type="checkbox" name="job_ids[]" class="job-checkbox"
                                                        value="{{ $job->id }}"></td> <!-- Job ID Checkbox -->
                                                <td>{{ $job->id }}</td>
                                                <td>{{ $job->business->business_name }}</td>
                                                <td>{{ $job->item->name }}</td>
                                                <td>{{ $job->size->size }}</td>
                                                <td>{{ $job->quantity }}</td>
                                                <td>{{ $job->status->status }}</td>
                                                <td>{{ $job->assignedTo->name }}</td>
                                                <td><a href="{{ url('admin/job/edit', $job->id) }}"><button type="button"
                                                            class="btn btn-primary">Edit</button></a></td>
                                                <td><a class="delete_job" job-id="{{ $job->id }}"><button
                                                            type="button" class="btn btn-danger">Delete</button></a></td>
                                                <td><a href="{{ url('admin/job/details', $job->id) }}"><button
                                                            type="button" class="btn btn-primary">View</button></a></td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="11">No record found</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <!-- Generate Invoice Button -->
                        <button type="submit" class="btn btn-primary" id="generate-invoice-btn" disabled>Generate
                            Invoice</button>
                    </form>
                </div>
            </div>
        </div>



        <!-- ============================================================== -->
        <!-- end basic table  -->
        <!-- ============================================================== -->
    </div>

@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('body').on('click', '.delete_job', function(e) {
                e.preventDefault();
                var id = $(this).attr('job-id');
                var title = "Are you sure?";
                Swal.fire({
                    icon: "warning",
                    title: title,
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: "Yes",
                    cancelButtonText: "Cancel",
                }).then((result) => {
                    if (result.isConfirmed) {
                        localStorage.clear();
                        window.location.href = "{{ url('admin/job/delete') }}/" + id;
                    }
                });
            });

            document.getElementById('select-all').addEventListener('click', function() {
                let checkboxes = document.querySelectorAll('.job-checkbox');
                checkboxes.forEach(checkbox => checkbox.checked = this.checked);
            });

            $('body').on('click', '.job-checkbox', function() {
                // Count the number of checkboxes with the class 'job-checkbox' that are checked
                let checkedCount = $('.job-checkbox:checked').length;

                // Show alert based on the count of checked checkboxes
                if (checkedCount > 0) {
                    $('#generate-invoice-btn').attr('disabled',false);
                } else {
                    $('#generate-invoice-btn').attr('disabled',true);
                }
            });

        });
    </script>
@endsection
