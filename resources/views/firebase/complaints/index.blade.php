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
                {{ __('All Complaints') }}
                <a class="btn btn-sm btn-primary" style="float:  right;" href="{{ route('add-complaints') }}">{{ __('Add Complaints') }}</a>
                </div>

                <div class="card-body">
                    <div style="overflow-x:auto;">
                    <table class="table table-striped table-bordered nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Phone</th>
                                {{-- <th>Address</th> --}}
                                <th>Device Info</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Status</th>
                                <th>Image</th>
                                <th>Actions</th>
                                {{-- <th>Delete</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @php $i=1; @endphp
                            @forelse($complaints as $key => $complaint)

                            <tr>
                                <td>{{ $i++ }} </td>
                                <td>{{ $complaint['title'] }}</td>
                                <td>{{ $complaint['description'] }}</td>
                                <td>{{ $complaint['phone_no'] }}</td>
                                {{-- <td>{{ $complaint['address'] }}</td> --}}
                                <td>{{ $complaint['device_info'] }}</td>  
                                <td>{{ $complaint['latitude'] }}</td>
                                <td>{{ $complaint['longitude'] }}</td>
                                <td>{{ $complaint['status'] }}</td>
                                <td><a href="{{ $complaint['fileName'] }}" target="_blank"><img src="{{ $complaint['fileName'] }}" width="200px" height="250px" /></a></td> 
                                <td> <a href="{{ url('edit-complaints/'.$key) }}" class="btn btn-sm btn-success">Edit</a></td>
                                {{-- <td>
                                    <form action="{{ url('delete-complaints/'.$key) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Trash</button>
                                </td> --}}
                                
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