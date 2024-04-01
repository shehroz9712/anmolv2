@extends('Dashboard.Master.master_layout')
@section('title')
    EatAnmol - Equipments Index
@endsection
@section('content')
    <div class="inner-body">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5"></h2>
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Equipment List</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('equipment.index') }}">Equipments</a></li>
                        <li class="breadcrumb-item active" aria-current="page">List Equipment</li>
                    </ol>
                </div>
            </div>

        </div>
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card custom-card mg-b-20">
                    <div class="card-body">
                        <h4 class="text-dark">Equipments Use in Selected your Dishes </h4>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="example2">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($equipments as $record)
                                        <tr>
                                            <td>{{ $record->name }}</td>
                                            <td>${{ $record->price }}</td>




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
    @endsection

    @section('js')
    @endsection
