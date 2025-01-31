@extends('Dashboard.Master.master_layout')
@section('title')
    Service Style Detail - EatAnmol
@endsection

@section('stylesheet')
@endsection

@section('content')
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">Service Style Detail</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('servicestyles.index') }}">Service Style Detail</a></li>
                <li class="breadcrumb-item active" aria-current="page">Service Style Detail</li>
            </ol>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div>
                        <h6 class="main-content-label mb-1">Service Style Detail</h6>
                        <p class="text-muted card-sub-title"> Service Style with details.</p>
                    </div>
                    <div class="container">

                        <div class="row">
                            <div class="col-md-12">
                                <h2>Service Style Details</h2>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th class="col-sm-4">Name</th>
                                                <td class="col-sm-8">{{ $record->name }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-sm-4">Course Type</th>
                                                <td class="col-sm-8">{{ $record->coursetype?->type }}</td>
                                            </tr>

                                            <tr>
                                                <th class="col-sm-4">Status</th>
                                                <td class="col-sm-8">
                                                    @if ($record->status == 1)
                                                        <span class="text-success">Active</span>
                                                    @else
                                                        <span class="text-danger">In Active</span>
                                                    @endif
                                                </td>
                                            </tr>


                                        </tbody>
                                    </table>
                                </div>

                            </div>


                        </div>
                        <div class="d-flex">
                            <div class="justify-content-center">
                                <a href="{{ route('servicestyles.index') }}" class="btn btn-primary ">
                                    Back to Service Style
                                </a>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
