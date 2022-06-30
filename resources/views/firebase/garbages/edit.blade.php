@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Edit Garbage Bins') }}

                    <a class="btn btn-sm btn-success" style="float: right;" href="{{route('garbages-index')}}">Back</a>
                </div>

                <div class="card-body">
                    <form action="{{ route('update-garbages/'.$key)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                    <div class="row">
                        <div class="col-md-4 mb-3">
                              <label>Location *</label>
                              <textarea class="form-control" rows="3" name="location" placeholder="Complete Address">{{ $editdata['location'] }}</textarea>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-md-4 mb-3">
                          <label>Latitude</label>
                          <input type="text" class="form-control" name="lat" value="{{ $editdata['latitude'] }}" placeholder="27.085164557">
                        </div>
                        <div class="col-md-4 mb-3">
                          <label>Longitude</label>
                          <input type="text" class="form-control" name="long" value="{{ $editdata['longitude'] }}" placeholder="93.606213591">
                        </div>
                    </div>
                      <div class="col-md-12">
                              <button class="btn btn-primary" style="display: block; width: 100%;" type="submit">Update</button>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection