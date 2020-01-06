@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Total Item Sold
                </div>
                <div class="card-body text-center">
                    As of now, Total {{$total_sell}} have been sold
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-5">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            Top 5 seller
                        </div>
                        <div class="card-body">
                            @if (count($top_five)<1) No Agent Found
                            @else
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">#</th>
                                        <th scope="col" class="text-center">Name</th>
                                        <th scope="col" class="text-center">Address</th>
                                        <th scope="col" class="text-center">Item Sold</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($top_five as $key=>$customer)
                                    <tr>
                                        <th scope="row" class="text-center">{{$key+1}}</th>
                                        <td class="text-center">{{$customer->name}}</td>
                                        <td class="text-center">{{$customer->address}}</td>
                                        <td class="text-center">{{$customer->sold_item}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                </table>
                                @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            More than 10 Items Sold By:
                        </div>
                        <div class="card-body">
                            @if (count($customers)<1)
                             No Agent Found
                            @else
                             <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">#</th>
                                        <th scope="col" class="text-center">Name</th>
                                        <th scope="col" class="text-center">Address</th>
                                        <th scope="col" class="text-center">Item Sold</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customers as $key=>$customer)
                                    <tr>
                                        <th scope="row" class="text-center">{{$key+1}}</th>
                                        <td class="text-center">{{$customer->name}}</td>
                                        <td class="text-center">{{$customer->address}}</td>
                                        <td class="text-center">{{$customer->sold_item}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                </table>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
