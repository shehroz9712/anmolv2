@extends('Dashboard.Master.master_layout')
@section('title')
    Create Service Style - EatAnmol
@endsection

@section('stylesheet')
@endsection

@section('content')
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">Add Service Style</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('servicestyles.index') }}">Service Style</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Service Style</li>
            </ol>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div>
                        <h6 class="main-content-label mb-1">Add Service Style</h6>
                        <p class="text-muted card-sub-title">Add a new Service Style with details.</p>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <form method="POST" action="{{ route('servicestyles.store') }}">
                                    @csrf
                                    <div class="form-group row">

                                        <div class="col-lg-3 mb-3">
                                            <label for="name">Name</label>
                                            <input class="form-control" id="name" name="name" required
                                                type="text">
                                        </div>

                                        <div class="col-lg-3 mb-3">
                                            <label for="course_type_id">Course Type</label>
                                            <select id="course_type_id" class="form-control" name="course_type_id" required>
                                                @foreach ($coursetypes as $item)
                                                    <option value="{{ $item->id }}">{{ $item->type }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-lg-3 mb-3">
                                            <label for="status">Status</label>
                                            <select class="form-control" id="status" name="status" required>
                                                <option value="0">In Active</option>
                                                <option value="1">Active</option>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="col-12 mb-3" style="text-align: end;">
                                        <button class="btn ripple btn-main-primary">Submit</button>
                                    </div>
                                </form>
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
