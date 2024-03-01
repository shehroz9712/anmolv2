@extends('Dashboard.Master.master_layout')
@section('title')
    Category | Create Category
@endsection

@section('stylesheet')
@endsection

@section('content')
    <div class="inner-body">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">Categories</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Manage Categories</li>
                </ol>
            </div>
            <div class="d-flex">
                <div class="justify-content-center">
                    <a href="{{ route('categories.create') }}" class="btn btn-primary my-2 btn-icon-text">
                        <i class="fe fe-plus me-2"></i> Add Category
                    </a>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card custom-card mg-b-20">
                    <div class="card-body">
                        <h4 class="text-dark">Categories</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="example2">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Type</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->status == 1 ? 'Active' : 'Inactive' }}</td>
                                            <td>{{ $category->type == 1 ? 'Packages' : 'Regular' }}</td>
                                            <td>{{ $category->created_at ? $category->created_at->format('Y-m-d H:i:s') : '' }}
                                            </td>
                                            <td>{{ $category->updated_at ? $category->updated_at->format('Y-m-d H:i:s') : '' }}
                                            </td>


                                            <td>
                                                <a class="btn btn-main-primary px-3"
                                                    href="{{ route('categories.edit', $category->id) }}">Edit</a>
                                                <a class="btn btn-main-primary px-3"
                                                    href="{{ route('categories.show', $category->id) }}">View</a>
                                                {{-- <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                                    style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger px-3"
                                                        onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
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
