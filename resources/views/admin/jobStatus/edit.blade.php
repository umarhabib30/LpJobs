@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Update Job status</h5>
                <div class="card-body">
                    <form method="post" action="{{ url('admin/status/update') }}">
                        @csrf
                        <input type="hidden" name="id" id="" value="{{$status->id}}">
                        <div class="form-group col-md-6">
                            <label for="status" class="col-form-label">Status</label>
                            <input id="status" type="text" class="form-control" name="status" value="{{$status->status}}">
                        </div>
                        <button class="btn btn-primary ml-3 submit_button">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('body').on('click','.submit_button',function(e){
                e.preventDefault();
                if($('#status').val().trim() == ''){
                    toastr.error('Please enter status');
                }else{
                    $('form').submit();
                }
            });
        });
    </script>
@endsection
