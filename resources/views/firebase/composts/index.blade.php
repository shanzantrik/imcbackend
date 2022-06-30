@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">

            @if(session('status'))
            <h4 class="alert alert-warning mb-2"> {{ session('status') }}</h4>
            @endif

            <div class="card">
                <div class="card-header">
                    {{ __('All Home Compost Request') }}
                    <a class="btn btn-sm btn-primary" style="float:  right;" href="{{ route('add-composts') }}">{{
                        __('Add Home Compost') }}</a>
                </div>

                <div class="card-body">
                    <div style="overflow-x:auto;">
                        <table class="table table-striped table-bordered nowrap" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    {{-- <th>Description</th> --}}
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Device Info</th>
                                    {{-- <th>Latitude</th>
                                    <th>Longitude</th> --}}
                                    <th>Status</th>
                                    <th>Image</th>
                                    <!-- <th>Edit</th> -->
                                    <!-- <th>Delete</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($composts as $key => $compost)

                                <tr>
                                    <td>{{ $key }} </td>
                                    <td>{{ $compost['title'] }}</td>
                                    {{-- <td>{{ $complaint['description'] }}</td> --}}
                                    <td>{{ $compost['phone_no'] }}</td>
                                    <td>{{ $compost['address'] }}</td>
                                    <td>{{ $compost['device_info'] }}</td>
                                    {{-- <td>{{ $compost['latitude'] }}</td>
                                    <td>{{ $compost['longitude'] }}</td> --}}
                                    <td>{{ $compost['status'] }}</td>
                                    <td><a href="{{ $compost['fileName'] }}" target="_blank"><img
                                                src="{{ $compost['fileName'] }}" width="200px" height="250px" /></a>
                                    </td>
                                    <!-- <td> <a href="" class="btn btn-sm btn-success">Edit</a></td>
                                <td> <a href="" class="btn btn-sm btn-danger">Trash</a></td> -->

                                </tr>

                                @empty
                                <tr>
                                    <td colspan="11">No Record Found</td>
                                </tr>

                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
