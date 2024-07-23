@extends('Dashboard.Master.master_layout')

@section('title')
    Items List - EatAnmol
@endsection

@section('content')
    <div class="inner-body">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">Item List</h2>
                 <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Items</a></li>
                    <li class="breadcrumb-item active" aria-current="page">List Items</li>
                </ol>
            </div>
            <div class="d-flex">
                <div class="justify-content-center">
                    <a href="{{ route('items.create') }}" class="btn btn-primary my-2 btn-icon-text">
                        <i class="fe fe-plus-circle me-2"></i> Add Item
                    </a>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card custom-card p-3 mg-b-20">
                    <div class="card-body">
                        <div class="table-responsive tasks">
                            <table class="table card-table table-vcenter text-nowrap mb-0 border">
                                <thead>
                                    <tr>
                                        <th class="wd-lg-20p">Name</th>
                                        <th class="wd-lg-20p">Quantity</th>
                                        <th class="wd-lg-10p">Amount</th>
                                        <th class="wd-lg-10p">Description</th>
                                        <th class="wd-lg-10p">Image</th>
                                        <th class="wd-lg-10p">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ $item->amount }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td>
                                                @if ($item->imageUrl)
                                                    <img src="{{ asset('storage/' . $item->imageUrl) }}" alt="Item Image"
                                                        style="max-width: 100px;">
                                                @else
                                                    No Image
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-main-primary px-3"
                                                    href="{{ route('items.edit', $item->id) }}">Edit</a>
                                                <form action="{{ route('items.destroy', $item->id) }}" method="POST"
                                                    style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger px-3"
                                                        onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                                </form>
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
    <!-- Your additional JavaScript code can go here if needed -->
@endsection
