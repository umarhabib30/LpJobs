@extends('layouts.app')
@section('content')
    <div class="row">
        <!-- ============================================================== -->
        <!-- basic table  -->
        <!-- ============================================================== -->
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">

                <div class="card-header d-flex justify-content-between">
                    <h5 >Customers</h5>
                    <a href="{{ url('admin/customer/create') }}" class="btn btn-primary">Add Customer</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered first">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Get Link</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $customer)
                                    <tr>
                                        <td>{{ $customer->id }}</td>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->customerDetail->address }}</td>
                                        <td>{{ $customer->customerDetail->mobile }}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td>
                                            <button class="btn btn-primary copy-link" data-url="{{ url('customer/complete-profile', $customer->id) }}">Get Link</button>
                                        </td>

                                        <td><a href="{{ url('admin/customer/edit', $customer->id) }}"><button class="btn btn-primary">Edit</button></a></td>
                                        <td><a href="" class="delete-customer" customer-id={{ $customer->id }}><button class="btn btn-danger">Delete</button></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
            $('body').on('click', '.delete-customer', function(e) {
                e.preventDefault();
                var id = $(this).attr('customer-id');
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
                       window.location.href = "{{url('admin/customer/delete')}}/"+id;
                    }
                });
            });

            $(document).on('click', '.copy-link', function() {
            // Get the data-url value
            let url = $(this).data('url');

            // Create a temporary input element to copy the URL to the clipboard
            let tempInput = $('<input>');
            $('body').append(tempInput);
            tempInput.val(url).select();
            document.execCommand('copy');
            tempInput.remove();

            // Optionally, provide feedback to the user
          toastr.success('Link copied');
        });
        });

    </script>
@endsection
