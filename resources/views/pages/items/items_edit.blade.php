@extends('Dashboard.Master.master_layout')

@section('title')
    EatAnmol - Items Edit
@endsection

@section('content')
    <div class="inner-body">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">Welcome to Eatanmol</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('items.index') }}">Items</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Item</li>
                </ol>
            </div>
            <div class="d-flex">
                <a class="btn btn-primary my-2 btn-icon-text" href="{{ route('items.index') }}">
                    <i class="fe fe-grid me-2"></i> View All
                </a>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row row-sm">
            <div class="col-md-12">
                <div class="card custom-card">
                    <div class="card-body">
                        <div>
                            <h6 class="main-content-label mb-1">Edit Item</h6>
                            <p class="text-muted card-sub-title">Edit the details of the selected item.</p>
                        </div>
                        <div class="row row-sm">
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <div class="">
                                    <form method="POST" action="{{ route('items.update', $item->id) }}">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-group">
                                            <label for="name">Item Name</label>
                                            <input data-toggle="tooltip" data-placement="bottom" placeholder="Product Name" title="Item Name" class="form-control" id="name" name="name" required type="text" value="{{ $item->name }}">
                                            <small id="nameError" class="text-danger"></small>
                                        </div>

                                        <div class="form-group">
                                            <label for="quantity">Quantity</label>
                                            <input data-toggle="tooltip" data-placement="bottom" placeholder="10" title="Quantity" class="form-control" id="quantity" name="quantity" type="number" required value="{{ $item->quantity }}">
                                            <small id="quantityError" class="text-danger"></small>
                                        </div>

                                        <div class="form-group">
                                            <label for="amount">Amount</label>
                                            <input data-toggle="tooltip" data-placement="bottom" placeholder="100.00" title="Amount" class="form-control" id="amount" name="amount" type="number" step="0.01" required value="{{ $item->amount }}">
                                            <small id="amountError" class="text-danger"></small>
                                        </div>

                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea data-toggle="tooltip" data-placement="bottom" placeholder="Item Description" title="Item Description" class="form-control" id="description" name="description" rows="3" required>{{ $item->description }}</textarea>
                                            <small id="descriptionError" class="text-danger"></small>
                                        </div>

                                        <div class="d-flex justify-content-end w-100">
                                            <button onclick="validateAndSubmit(event, validateForm())" class="btn ripple btn-main-primary d-inline-block" id="submitBtn">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
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
