@extends('layouts.app')
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
                                        <p>{{ $job->customer }}</p>
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
                                        <p>{{ $job->size }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="text-dark">Customer : </span></td>
                                    <td>
                                        <p>{{ $job->customer }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="text-dark">Item : </span></td>
                                    <td>
                                        <p>{{ $job->item }}</p>
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
                                        <p>{{ $job->user }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="text-dark">Status : </span></td>
                                    <td>
                                        <p>{{ $job->status }}</p>
                                    </td>
                                </tr>
                            </table>
                            <a href="{{url('admin/job/edit',$job->id)}}">
                            <button class="btn btn-primary mt-4">Edit Job</button></a>
                        </div>
                        <div class="col-sm-6">
                            <form method="post" action="{{ url('admin/job/add-notes') }}">
                                @csrf
                                <input type="hidden" name="job_id" value="{{ $job->id }}" id="">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Notes</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="note"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary mb-2">+Add Note</button>
                            </form>
                            <div class="table-responsive-sm">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Notes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($job->notes as $key => $note)
                                            <tr>
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
