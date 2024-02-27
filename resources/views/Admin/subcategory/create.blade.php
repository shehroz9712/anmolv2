@extends('Dashboard.Master.master_layout')
@section('title')
    Sub Category | Create Sub Category
@endsection

@section('stylesheet')
@endsection

@section('content')
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">Add Sub Category</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('subcategories.index') }}">Sub Category</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Sub Category</li>
            </ol>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div>
                        <h6 class="main-content-label mb-1">Add Sub Category</h6>
                        <p class="text-muted card-sub-title">Add a new Sub Category with details.</p>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <form method="POST" action="{{ route('subcategories.store') }}"
                                    onsubmit="return validateForm();">
                                    @csrf
                                    <div class="form-group row">

                                        <div class="col-lg-3 mb-3">
                                            <label for="name">Name</label>
                                            <input class="form-control" id="name" name="name" required
                                                type="text">
                                        </div>

                                        <div class="col-lg-3 mb-3">
                                            <label for="category_id">Category</label>
                                            <select id="category_id" class="form-control" name="category_id" required>
                                                @foreach ($categories as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-3 mb-3">
                                            <label for="is_addon">Is Addon</label>
                                            <select class="form-control" id="is_addon" name="is_addon" required>
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 mb-3">
                                            <label for="status">Status</label>
                                            <select class="form-control" id="status" name="status" required>
                                                <option value="0">Inactive</option>
                                                <option value="1">Active</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 mb-3">
                                            <label for="single">Single Price</label>
                                            <input class="form-control" id="single" name="single" type="number">
                                        </div>
                                        <div class="col-lg-3 mb-3">
                                            <label for="double">Double Price</label>
                                            <input class="form-control" id="double" name="double" type="number">
                                        </div>
                                        <div class="col-lg-3 mb-3">
                                            <label for="trio">Trio Price</label>
                                            <input class="form-control" id="trio" name="trio" type="number">
                                        </div>

                                    </div>

                                    <div class="col-12 mb-3" style="text-align: end;">
                                        <button class="btn ripple btn-main-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
