@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Update Size</h5>
                <div class="card-body">
                    <form method="post" action="{{ url('admin/size/update') }}">
                        @csrf
                        <input type="hidden" name="id" id="" value="{{$size->id}}">
                        <div class="form-group col-md-6">
                            <label for="size" class="col-form-label">Size</label>
                            <input id="size" type="text" class="form-control" name="size" value="{{$size->size}}">
                        </div>
                        <button  class="btn btn-primary ml-3 submit_button">Update</button>
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
                if($('#size').val().trim() == ''){
                    toastr.error('Please enter size');
                }else{
                    $('form').submit();
                }
            });
        });
    </script>
@endsection
