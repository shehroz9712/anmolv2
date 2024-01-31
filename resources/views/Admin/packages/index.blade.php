@extends('Dashboard.Master.master_layout')
@section('title')
    Package | Create Package
@endsection

@section('stylesheet')
@endsection

@section('content')
    <div class="inner-body">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">Packages</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Manage Packages</li>
                </ol>
            </div>
            <div class="d-flex">
                <div class="justify-content-center">
                    <a href="{{ route('packages.create') }}" class="btn btn-primary my-2 btn-icon-text">
                        <i class="fe fe-plus me-2"></i> Add Package
                    </a>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card custom-card mg-b-20">
                    <div class="card-body">
                        <h4 class="text-dark">Packages</h4>
                        <div class="table-responsive tasks">
                            <table class="table card-table table-vcenter text-nowrap mb-0 border">
                                <thead>
                                    <tr>
                                        <th class="wd-lg-10p">ID</th>
                                        <th class="wd-lg-20p">Category</th>
                                        <th class="wd-lg-20p">Price</th>
                                        <th class="wd-lg-20p">No of items</th>
                                        <th class="wd-lg-20p">No of Person</th>
                                        <th class="wd-lg-20p">status</th>

                                        <th class="wd-lg-20p">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($packages as $package)
                                        <tr>
                                            <td>{{ $package->id }}</td>
                                            <td>{{ $package->category->name }}</td>
                                            <td>{{ $package->price }}</td>
                                            <td>{{ $package->person }}</td>
                                            <td>{{ count($package->include) }}</td>
                                            <td>
                                                @if ($package->status == 1)
                                                    <span class="text-success">Active</span>
                                                @else
                                                    <span class="text-danger">Blocked</span>
                                                @endif
                                            </td>


                                            <td>
                                                <a class="btn btn-main-primary px-3"
                                                    href="{{ route('packages.edit', $package->id) }}">Edit</a>
                                                    <a class="btn btn-main-primary px-3"
                                                    href="{{ route('packages.show', $package->id) }}">View</a>
                                                {{-- <form action="{{ route('packages.destroy', $package->id) }}" method="POST"
                                                    style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger px-3"
                                                        onclick="return confirm('Are you sure you want to delete this package?')">Delete</button>
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
