@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Add Complaint') }}

                    <a class="btn btn-sm btn-success" style="float: right;" href="{{route('complaints-index')}}">Back</a>
                </div>

                <div class="card-body">
                    <form action="{{ route('save-complaints')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="row">
                        <div class="col-md-4 mb-3">
                          <label>Title *</label>
                          <input type="text" class="form-control" name="title" placeholder="Complaint Title" required>
                          <hr>
                            <div>
                              <label>Phone Number *</label>
                              <input type="text" class="form-control" name="phone_no" placeholder="Phone Number" required>
                            </div>
                        </div>

                         <div class="col-md-4 mb-3">
                          <label>Complaint Details *</label>
                          <textarea class="form-control" rows="5" name="description" placeholder="Complaint Description" required></textarea>
                        </div>
                        <div class="col-md-4 mb-3">
                          <label>Device Info</label>
                            <select name="device_info" class="form-control">
                              <option selected>Select Device Type</option>
                              <option value="android">Android</option>
                              <option value="ios">IoS</option>
                              <option value="web">Web</option>
                            </select>
                            <hr>
                            <div>
                              <label>Address *</label>
                              <textarea class="form-control" rows="3" name="address" placeholder="Complete Address" required></textarea>
                            </div>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-md-4 mb-3">
                          <label>Latitude</label>
                          <input type="text" class="form-control" name="latitude" placeholder="27.085164557">
                        </div>
                        <div class="col-md-4 mb-3">
                          <label>Longitude</label>
                          <input type="text" class="form-control" name="longitude" placeholder="93.606213591">
                        </div>
                        <hr>
                        <div class="col-md-4 mb-3">
                            <input type="file" name="fileName" class="form-control">
                        </div>
                    </div>
                        <div class="col-md-4 mb-3">
                            <input type="text" name="status" value="requested" hidden>
                        </div>
                   
                      <button style="float: right" class="btn btn-primary" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection