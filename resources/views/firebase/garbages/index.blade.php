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
                {{ __('All Garbage Bins') }}
                <a class="btn btn-sm btn-primary" style="float:  right;" href="{{ route('add-garbages') }}">{{ __('Add garbage Bin') }}</a>
                </div>

                <div class="card-body">
                    <div style="overflow-x:auto;">
                    <table class="table table-striped table-bordered nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Location</th>
                                {{-- <th>Latitude</th>
                                <th>Longitude</th> --}}
                                <th>Actions</th>
                                {{-- <th>Delete</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($garbages as $key => $garbage)

                            <tr>
                                <td>{{ $key }} </td>
                                <td>{{ $garbage['location'] }}</td>  
                                {{-- <td>{{ $garbage['lat'] }}</td> 
                                <td>{{ $garbage['long'] }}</td>  --}}
                                <td> <a href="" class="btn btn-sm btn-success"></a></td>
                                {{-- <td> <a href="" class="btn btn-sm btn-danger">Trash</a></td> --}}
                                
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