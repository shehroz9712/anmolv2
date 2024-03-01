@extends('Dashboard.Master.master_layout')
@section('title')
    Menu
@endsection

@section('stylesheet')
@endsection

@section('content')
    <div class="inner-body">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">Menu</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Menu</li>
                </ol>
            </div>

        </div>
        <!-- End Page Header -->
        <div class="row row-sm">
            <div class="col-lg-12 col-xl-6 col-md-12 col-12 col-sm-12">
                <div class="card custom-card">
                    <div class="card-header custom-card-header border-bottom-0">
                        <h5 class="main-content-label tx-dark tx-medium mb-0">Categories</h5>
                    </div>
                    <div class="card-body">
                        <h6 class="">Categories</h6>
                        <p class="card-text">Explore diverse categories for your subcategories management system.
                        </p>
                        <a href="{{ route('categories.index') }}" class="btn btn-primary ripple btn-block">View</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-xl-6 col-md-12 col-12 col-sm-12">
                <div class="card custom-card">
                    <div class="card-header custom-card-header border-bottom-0">
                        <h5 class="main-content-label tx-dark tx-medium mb-0">Sub Categories</h5>
                    </div>
                    <div class="card-body">
                        <h6 class="">Sub Categories</h6>
                        <p class="card-text">Organize your offerings into detailed subcategories for better organization.
                        </p>
                        <a href="{{ route('subcategories.index') }}" class="btn btn-primary ripple btn-block">View</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-xl-6 col-md-12 col-12 col-sm-12">
                <div class="card custom-card">
                    <div class="card-header custom-card-header border-bottom-0">
                        <h5 class="main-content-label tx-dark tx-medium mb-0">Items</h5>
                    </div>
                    <div class="card-body">
                        <h6 class="">Items</h6>
                        <p class="card-text">Dive into a world of culinary delights with our diverse dishes.</p>
                        <a href="{{ route('dishes.index') }}" class="btn btn-primary ripple btn-block">View</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-xl-6 col-md-12 col-12 col-sm-12">
                <div class="card custom-card">
                    <div class="card-header custom-card-header border-bottom-0">
                        <h5 class="main-content-label tx-dark tx-medium mb-0">Packages</h5>
                    </div>
                    <div class="card-body">
                        <h6 class="">Packages</h6>
                        <p class="card-text">Create and customize packages to meet your customers' specific needs.</p>
                        <a href="{{ route('packages.index') }}" class="btn btn-primary ripple btn-block">View</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
