@extends('layouts.customer')
@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Update Password</h5>
                <div class="card-body">
                    <form method="post" action="{{ url('customer/password/update') }}">
                        @csrf
                        <input type="hidden" name="id" id="" value="{{ $user_id }}">

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="password" class="col-form-label">Password</label>
                                <input id="password" type="text" class="form-control" name="password">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="confirm" class="col-form-label">Confirm Password</label>
                                <input id="confirm" type="text" class="form-control" name="password_confirmation">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Update password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
