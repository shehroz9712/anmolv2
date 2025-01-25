@extends('Dashboard.Master.master_layout')
@section('title')
    Create Course Type - EatAnmol
@endsection

@section('stylesheet')
@endsection

@section('content')
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">Add Course Type</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('coursetypes.index') }}">Course Type</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Course Type</li>
            </ol>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card custom-card">
                <div class="card-body">

                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-xl-12">

                            </div>
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
