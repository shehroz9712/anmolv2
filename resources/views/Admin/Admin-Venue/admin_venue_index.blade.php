@extends('Dashboard.Master.master_layout')

@section('content')
    <div class="inner-body">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">Admin Venues</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">manageAdmin Venues</li>
                </ol>
            </div>
            <div class="d-flex">
                <div class="justify-content-center">
                    <a href="{{ route('admin-venues.create') }}" class="btn btn-primary my-2 btn-icon-text">
                        <i class="fe fe-plus me-2"></i> Add Admin Venue
                    </a>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card custom-card mg-b-20">
                    <div class="card-body">
                        <h4 class="text-dark">Venues</h4>
                        <div class="table-responsive tasks">
                            <table class="table card-table table-vcenter text-nowrap mb-0 border">
                                <thead>
                                    <tr>
                                        <th class="wd-lg-10p">ID</th>
                                        <th class="wd-lg-20p">Name</th>
                                        <th class="wd-lg-20p">Address</th>
                                        <th class="wd-lg-20p">City, State, ZipCode</th>
                                        {{-- <th class="wd-lg-20p">State</th>
                                        <th class="wd-lg-20p">Zipcode</th> --}}
                                        <th class="wd-lg-20p">Created By</th>
                                        <th class="wd-lg-20p">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($adminVenues as $adminVenue)
                                        <tr>
                                            <td>{{ $adminVenue->id }}</td>
                                            <td>{{ $adminVenue->name }}</td>
                                            <td>{{ $adminVenue->address }}</td>
                                            <td>{{ $adminVenue->city }}</td>
                                            {{-- <td>{{ $adminVenue->state }}</td>
                                            <td>{{ $adminVenue->zipcode }}</td> --}}
                                            <td>{{ optional($adminVenue->createdBy)->name }}</td>

                                            <td>
                                                <a class="btn btn-main-primary px-3" href="{{ route('admin-venues.edit', $adminVenue->id) }}">Edit</a>
                                                <form action="{{ route('admin-venues.destroy', $adminVenue->id) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger px-3" onclick="return confirm('Are you sure you want to delete this admin venue?')">Delete</button>
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

@endsection
