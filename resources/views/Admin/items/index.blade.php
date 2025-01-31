@extends('Dashboard.Master.master_layout')
@section('title')
    Item List - EatAnmol
@endsection

@section('stylesheet')
@endsection

@section('content')
    <div class="inner-body">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">Items</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Manage Items</li>
                </ol>
            </div>
            <div class="d-flex">
                <div class="justify-content-center">
                    <a href="{{ route('dishes.create') }}" class="btn btn-primary my-2 btn-icon-text">
                        Add Item
                    </a>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card custom-card mg-b-20">
                    <div class="card-body">
                        <h4 class="text-dark">Items</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="example2">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Course Type</th>
                                        <th>Service STyle</th>
                                        <th>Sub Category</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dishes as $dish)
                                        <tr>
                                            <td>{{ $dish->name }}</td>
                                            <td>{{ $dish->coursetype?->type }}</td>
                                            <td>{{ $dish->servicestyle?->name }}</td>
                                            <td>{{ $dish->subcategory?->name }}</td>
                                            <td>$ {{ $dish->price }} </td>
                                            <td>{{ $dish->status == 1 ? 'Active' : 'In Active' }}</td>
                                            <td>
                                                <a class="btn btn-main-primary px-3"
                                                    href="{{ route('dishes.edit', encrypt($dish->id)) }}">Edit</a>
                                                <a class="btn btn-main-primary px-3"
                                                    href="{{ route('dishes.show', encrypt($dish->id)) }}">View</a>
                                                {{-- <form action="{{ route('dishes.destroy', $dish->id) }}" method="POST"
                                                    style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger px-3"
                                                        onclick="return confirm('Are you sure you want to delete this dish?')">Delete</button>
                                                </form> --}}
                                            </td>
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
@endsection

@section('js')
@endsection
