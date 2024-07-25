@extends('Dashboard.Master.master_layout')
@section('title')
    Contacts List - EatAnmol
@endsection

@section('stylesheet')
@endsection

@section('content')
    <div class="inner-body">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">Contacts List</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contacts List</li>
                </ol>
            </div>
            <div class="d-flex">
                <div class="justify-content-center">
                    <a href="{{ route('subcategories.create') }}" class="btn btn-primary my-2 btn-icon-text">
                        <i class="fe fe-plus me-2"></i> Contacts List
                    </a>
                </div>
            </div>
        </div>

        <!-- End Page Header -->
        <div class="row row-sm mt-3">
            <div class="col-lg-12">
                <div class="card custom-card mg-b-20">
                    <div class="card-body">
                        <h4 class="text-dark">Contacts</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered " id="example2">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Role</th>
                                        <th>Total Events</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>
                                                @if ($user->Role == 'Guest')
                                                    N/A
                                                @else
                                                    <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                                @endif
                                            </td>
                                            <td><a href="tel:{{ $user->phone }}">{{ $user->phone }}</a></td>
                                            <td>{{ $user->Role }}</td>
                                            <td class="text-center">{{ count($user->event) }}</td>
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
