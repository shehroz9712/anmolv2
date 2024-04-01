@extends('Dashboard.Master.master_layout')
@section('title')
    Equipments | Create Equipments
@endsection

@section('stylesheet')
@endsection

@section('content')
    <div class="inner-body">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">Equipments</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Manage Equipments</li>
                </ol>
            </div>
            <div class="d-flex">
                <div class="justify-content-center">
                    <a href="{{ route('equipments.create') }}" class="btn btn-primary my-2 btn-icon-text">
                        <i class="fe fe-plus me-2"></i> Add Equipments
                    </a>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card custom-card mg-b-20">
                    <div class="card-body">
                        <h4 class="text-dark">Equipments</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="example2">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Price</th>
                                        {{-- <th>Is Addon</th> --}}
                                        {{-- <th>Single</th>
                                        <th>Double</th>
                                        <th>Trio</th> --}}
                                        <th class="wd-lg-20p">status</th>
                                        <th class="wd-lg-20p">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($equipments as $record)
                                        <tr>
                                            <td>{{ $record->name }}</td>
                                            <td>${{ $record->price }}</td>
                                            {{-- <td>{{ $record->is_addon }}</td> --}}
                                            {{-- <td>{{ $record->single }}</td>
                                            <td>{{ $record->double }}</td>
                                            <td>{{ $record->trio }}</td> --}}

                                            <td>
                                                @if ($record->status == 1)
                                                    <span class="text-success">Active</span>
                                                @else
                                                    <span class="text-danger">Blocked</span>
                                                @endif
                                            </td>


                                            <td>
                                                <a class="btn btn-main-primary px-3"
                                                    href="{{ route('equipments.edit', $record->id) }}">Edit</a>
                                                <a class="btn btn-main-primary px-3"
                                                    href="{{ route('equipments.show', $record->id) }}">View</a>
                                                {{-- <form action="{{ route('equipments.destroy', $equipment->id) }}" method="POST"
                                                    style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger px-3"
                                                        onclick="return confirm('Are you sure you want to delete this equipment?')">Delete</button>
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
