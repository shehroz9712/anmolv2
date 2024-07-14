@extends('Dashboard.Master.master_layout')
@section('title')
    Users List - EatAnmol
@endsection

@section('stylesheet')
@endsection

@section('content')
    <div class="inner-body">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">Users</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-user"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-user active" aria-current="page">Manage Users</li>
                </ol>
            </div>
            {{-- <div class="d-flex">
                <div class="justify-content-center">
                    <a href="{{ route('dishes.create') }}" class="btn btn-primary my-2 btn-icon-text">
                        <i class="fe fe-plus me-2"></i> Add User
                    </a>
                </div>
            </div> --}}
        </div>
        <!-- End Page Header -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card custom-card mg-b-20">
                    <div class="card-body">
                        <h4 class="text-dark">User</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="example2">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Role</th>
                                        <th>Total Event </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->Role }}</td>
                                            <td>{{ count($user->event) }}</td>
                                            <td>
                                                {{-- <a class="btn btn-main-primary px-3"
                                                    href="{{ route('dishes.edit', encrypt($dish->id)) }}">Edit</a> --}}
                                                <a class="btn btn-main-primary px-3"
                                                    href="{{ route('contact.show', encrypt($user->id)) }}">View</a>
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
