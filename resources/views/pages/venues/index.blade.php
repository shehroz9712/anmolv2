@extends('Dashboard.Master.master_layout')
@section('title')
    Venue List - EatAnmol
@endsection
@section('content')
    <div class="inner-body">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5"></h2>
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Venue List</h2>
                     <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('Venues.index') }}">Venue</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Venue</li>
                    </ol>
                </div>
            </div>
            <div class="d-flex">
                <div class="justify-content-center">
                    <a href="{{ route('Venues.create') }}" class="btn btn-primary my-2 btn-icon-text">
                        <i class="fe fe-grid me-2"></i> Venue List
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
                        <div class="table-responsive">
                            <table class="table table-bordered" id="example2">
                                <thead>
                                    <tr>
                                        {{-- <th class="wd-lg-10p">ID</th> --}}
                                        <th class="wd-lg-20p">Contact Person</th>
                                        <th class="wd-lg-20p">Contact Email</th>
                                        <th class="wd-lg-20p">Contact Phone</th>
                                        <th class="wd-lg-20p">Venue Name</th>
                                        <th class="wd-lg-20p">Address</th>
                                        <th class="wd-lg-20p">City, State, ZipCode</th>
                                        {{-- <th class="wd-lg-20p">State</th>
                                        <th class="wd-lg-20p">Zipcode</th> --}}
                                        <th class="wd-lg-20p">Created By</th>
                                        <th class="wd-lg-20p">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Venues as $Venue)
                                        <tr>
                                            {{-- <td>{{ $Venue->id }}</td> --}}
                                            <td>{{ $Venue->ContactPerson }}</td>
                                            <td>{{ $Venue->ContactEmail }}</td>
                                            <td>{{ $Venue->ContactPhone }}</td>
                                            <td>{{ $Venue->venueInfo->name }}</td>
                                            <td>{{ $Venue->venueInfo->address }}</td>
                                            <td>{{ $Venue->venueInfo->city }}</td>
                                            {{-- <td>{{ $Venue->venueInfo->state }}</td>
                                        <td>{{ $Venue->venueInfo->zipcode }}</td>    --}}
                                            <td>{{ optional($Venue->createdBy)->name }}</td>

                                            <td>
                                                <form id="editEventForm" class=" mx-1" method="POST"
                                                    action="{{ route('Venues.edit') }}">
                                                    @csrf
                                                    @method('POST')
                                                    <!-- Adding this line to specify the method as POST -->
                                                    <input type="hidden" name="venueId" value="{{ $Venue->id }}">
                                                    <button type="submit" class="btn btn-main-primary px-3">Edit</button>
                                                </form>

                                                {{-- <a class="btn btn-main-primary px-3" href="{{ route('Venues.edit', ['encryptedId' => Crypt::encryptString($Venue->id)]) }}">Edit</a> --}}
                                                <form action="{{ route('Venues.destroy', $Venue->id) }}"
                                                    method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger px-3"
                                                        onclick="return confirm('Are you sure you want to delete this customer venue?')">Delete</button>
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
