@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span>User Directory</span><span class="float-right"><button data-toggle="modal"
                            data-target="#myModal" class="btn btn-primary">Add New</button></span>
                    <div class="col-md-6 offset-md-3">

                        <form action="{{url('age_search')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-8">
                                    <input class="form-control" type="number" name="age" id="age"
                                        placeholder="Search by age" required>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-primary" type="submit">search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">#</th>
                                <th scope="col" class="text-center">Name</th>
                                <th scope="col" class="text-center">Address</th>
                                <th scope="col" class="text-center">File</th>
                                <th scope="col" class="text-center">Age</th>
                                <th scope="col" class="text-center">Varified</th>
                                <th scope="col" class="text-center">Item Sold</th>
                                <th scope="col" class="text-center">Preview</th>
                                <th scope="col" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $key=>$customer)
                            @php
                            $dob = $customer->DOB;
                            $now = date('Y-m-d');
                            $date1 = strtotime($dob);
                            $date2 = strtotime($now);
                            $diff = abs($date2 - $date1);

                            $years = floor($diff / (365*60*60*24));
                            @endphp
                            <tr>
                                <th scope="row" class="text-center">{{$key+1}}</th>
                                <td class="text-center">{{$customer->name}}</td>
                                <td class="text-center">{{$customer->address}}</td>
                                <td class="text-center">{{$customer->filename}}</td>
                                <td class="text-center">{{$years}}</td>
                                <td class="text-center">
                                    @if ($years>20)
                                    Above 20
                                    @else
                                    below 20
                                    @endif
                                </td>
                                <td class="text-center">{{$customer->sold_item}}</td>
                                <td class="text-center"><a
                                        href="{{url('/')}}{{ Storage::url('app/images/'.$customer->filename)}}">View
                                        File</a></td>
                                <td class="text-center">
                                    <div>
                                        <span class="float-left"><a href="/customer/{{$customer->id}}/edit"
                                                class="btn btn-info">Edit</a></span>
                                        <span class="float-right">
                                            <form action="{{url('customer/'.$customer->id)}}" method="POST">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button class="btn btn-danger" type="submit">Delete</button>
                                            </form>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="justify-content-center">
                    {{$customers->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{url('customer')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="col-form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="address" class="col-form-label">Address:</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <div class="form-group">
                        <label for="file" class="col-form-label">File:</label>
                        <input type="file" class="form-control" id="file" name="file" required>
                    </div>
                    <div class="form-group">
                        <label for="dob" class="col-form-label">DOB:</label>
                        <input type="date" class="form-control" id="dob" name="dob" required>
                    </div>
                    <div class="form-group">
                        <label for="sold_item" class="col-form-label">Sold Item:</label>
                        <input type="number" class="form-control" id="sold_item" name="sold_item" required>
                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary float-right">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('customer/'.$customer->id)}}" method="post">
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="btn btn-info" type="button">Cancel</button>
                    <button class="btn btn-danger float-right" type="submit">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
