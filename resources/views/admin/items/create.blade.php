@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Add item</h5>
                <div class="card-body">
                    <form method="post" action="{{ url('admin/item/store') }}">
                        @csrf
                        <div class="form-group col-md-6">
                            <label for="name" class="col-form-label">Name</label>
                            <input id="name" type="text" class="form-control" name="name">
                        </div>
                        <button  class="btn btn-primary ml-3 submit_button">Add Item</button>
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
                if($('#name').val().trim() == ''){
                    toastr.error('Please enter name');
                }else{
                    $('form').submit();
                }
            });
        });
    </script>
@endsection
