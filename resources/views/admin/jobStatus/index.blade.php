@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Job status table</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered first">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Status</th>
                                    <th style="width: 120px">Edit</th>
                                    <th style="width: 120px">Delete</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if (!$statuses->isEmpty())
                                    @foreach ($statuses as $key => $status)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $status->status }}</td>
                                            <td><a href="{{ url('admin/status/edit', $status->id) }}"><button
                                                        class="btn btn-primary" style="width: 120px;">Edit</button></a>
                                            </td>
                                            <td>
                                                <a class="delete_status" status-id={{$status->id}}><button
                                                        class="btn btn-danger"
                                                        style="width: 120px;">Delete</button></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    No record found
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('body').on('click', '.delete_status', function(e) {
                e.preventDefault();
                var id = $(this).attr('status-id');
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
                       window.location.href = "{{url('admin/status/delete')}}/"+id;
                    }
                });
            });
        });
    </script>
@endsection
