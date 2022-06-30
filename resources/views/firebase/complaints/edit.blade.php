@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Edit Complaint') }}

                    <a class="btn btn-sm btn-success" style="float: right;" href="{{route('complaints-index')}}">Back</a>
                </div>

                <div class="card-body">
                    <form action="{{ url('update-complaints/'.$key) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                    <div class="row">
                        <div class="col-md-4 mb-3">
                          <label>Title *</label>
                          <input type="text" class="form-control" name="title" value="{{ $editdata['title'] }}" placeholder="Complaint Title" required>
                          <hr>
                            <div>
                              <label>Phone Number *</label>
                              <input type="text" class="form-control" name="phone_no" value="{{ $editdata['phone_no'] }}" placeholder="Phone Number" required>
                            </div>
                        </div>

                         <div class="col-md-4 mb-3">
                          <label>Complaint Details *</label>
                          <textarea class="form-control" rows="5" name="description" placeholder="Complaint Description" required>{{ $editdata['description'] }}</textarea>
                        </div>
                        <div class="col-md-4 mb-3">
                             <label>Device Info</label>
                        <select class="form-control" id="type" name="device_info" >
                            <option value="">Select Device Info</option>
                            <option value="android" {{ $editdata['device_info'] == 'android' ? 'selected' : '' }}>Android</option>
                            <option value="ios" {{ $editdata['device_info'] == 'ios' ? 'selected' : '' }}>IoS</option>
                            <option value="web" {{ $editdata['device_info'] == 'web' ? 'selected' : '' }}>Web</option>
                        </select>
                            <hr>
                            <div>
                              <label>Address *</label>
                              <textarea class="form-control" rows="3" name="address" placeholder="Complete Address">{{ $editdata['address'] }}</textarea>
                            </div>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-md-4 mb-3">
                          <label>Latitude</label>
                          <input type="text" class="form-control" name="latitude" value="{{ $editdata['latitude'] }}" placeholder="27.085164557">
                        </div>
                        <div class="col-md-4 mb-3">
                          <label>Longitude</label>
                          <input type="text" class="form-control" name="longitude" value="{{ $editdata['longitude'] }}" placeholder="93.606213591">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Status</label>
                        <select class="form-control" id="type" name="status" >
                            <option value="">Select Status</option>
                            <option value="requested" {{ $editdata['status'] == 'requested' ? 'selected' : '' }}>Requested</option>
                            <option value="inprogress" {{ $editdata['status'] == 'inprogress' ? 'selected' : '' }}>In-Progress</option>
                            {{-- <option value="pending" {{ $editdata['status'] == 'pending' ? 'selected' : '' }}>Pending</option> --}}
                            <option value="completed" {{ $editdata['status'] == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                        </div> 
                        <hr>
                        <div class="col-md-12">
                              <button class="btn btn-primary" style="display: block; width: 100%;" type="submit">Update</button>
                        </div>
                        <div class="col-md-12">
                            <div>&nbsp;</div>
                            <h4> Image files cannot be edited as it is uploaded by users as a proof of complaint.</h4>
                            <img src="{{ $editdata['fileName'] }}" width="100%">
                        </div>
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection