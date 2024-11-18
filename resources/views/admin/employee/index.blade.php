@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 >Employees</h5>
                    <a href="{{ url('admin/employee/create') }}" class="btn btn-primary">Add Employee</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered first">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th style="width: 120px">Edit</th>
                                    <th style="width: 120px">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!$employees->isEmpty())
                                    @foreach ($employees as $key => $employee)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $employee->name }}</td>
                                            <td>{{ $employee->email }}</td>
                                            <td><a href="{{ url('admin/employee/edit', $employee->id) }}"><button
                                                        class="btn btn-primary" style="width: 120px;">Edit</button></a>
                                            </td>
                                            <td>
                                                <a class="delete-employee" employee-id={{$employee->id}}><button
                                                        class="btn btn-danger" style="width: 120px;">Delete</button></a>
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
            $('body').on('click', '.delete-employee', function(e) {
                e.preventDefault();
                var id = $(this).attr('employee-id');
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
                       window.location.href = "{{url('admin/employee/delete')}}/"+id;
                    }
                });
            });
        });
    </script>
@endsection
