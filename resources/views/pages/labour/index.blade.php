@extends('Dashboard.Master.master_layout')
@section('title')
    Labours List - EatAnmol
@endsection
@section('content')
    <div class="inner-body">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5"></h2>
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Labour List</h2>
                     <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('labour.index') }}">Labours</a></li>
                        <li class="breadcrumb-item active" aria-current="page">List Labour</li>
                    </ol>
                </div>
            </div>

        </div>
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card custom-card mg-b-20">
                    <div class="card-body">
                        <h4 class="text-dark">Labours Use in Selected your Dishes </h4>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="example2">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Dishes</th>
                                        <th>Guest</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($labours as $record)
                                        <tr>
                                            <td>{{ $record->name }}</td>
                                            <td>${{ $record->is_dish }}</td>
                                            <td>${{ $record->guest }}</td>
                                            <td>${{ $record->price }}</td>
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
