@extends('Dashboard.Master.master_layout')
@section('title')
    Labours List - EatAnmol
@endsection

@section('stylesheet')
@endsection

@section('content')
    <div class="inner-body">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">Labours</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Manage Labours</li>
                </ol>
            </div>
            <div class="d-flex">
                <div class="justify-content-center">
                    <a href="{{ route('labours.create') }}" class="btn btn-primary my-2 btn-icon-text">
                        <i class="fe fe-plus me-2"></i> Add Labours
                    </a>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card custom-card mg-b-20">
                    <div class="card-body">
                        <h4 class="text-dark">Labours</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="example2">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Designation</th>
                                            <th>With Dish</th>
                                            <th>Guest</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($labours as $labour)
                                            <tr>
                                                <td>{{ $labour->name }}</td>
                                                <td>{{ $labour->designation }}</td>
                                                <td>{{ $labour->with_dish ? 'Yes' : 'No' }}</td>
                                                <td>{{ $labour->guest }}</td>
                                                <td>{{ $labour->price }}</td>
                                                <td>{{ $labour->status ? 'Active' : 'In Active' }}</td>
                                                <td>
                                                    <a href="{{ route('labours.edit', encrypt($labour->id)) }}"
                                                        class="btn btn-primary">Edit</a>
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
