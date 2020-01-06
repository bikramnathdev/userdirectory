@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card p-3">
            <form method="POST" action="{{url('customer/'.$customer->id)}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                  <div class="form-group">
                    <label for="name" class="col-form-label">Name:</label>
                  <input type="text" value="{{$customer->name}}" class="form-control" id="name" name="name" required>
                  </div>
                  <div class="form-group">
                    <label for="lastname" class="col-form-label">Address:</label>
                    <input type="text" value="{{$customer->address}}" class="form-control" id="address" name="address" required>
                  </div>
                  <div class="form-group">
                    <label for="file" class="col-form-label">File:</label>
                    <span>{{$customer->filename}}</span>
                    <input type="file" value="{{$customer->file}}" class="form-control" id="file" name="file" required>
                  </div>
                <a type="button" class="btn btn-secondary" href="{{url('customer')}}">Cancel</a>
                <button type="submit" class="btn btn-primary float-right">Save</button>
            </form>
        </div>
        </div>
    </div>
</div>

@endsection
