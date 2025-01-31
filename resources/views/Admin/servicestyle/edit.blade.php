@extends('Dashboard.Master.master_layout')
@section('title')
    Edit Service Style - EatAnmol
@endsection

@section('stylesheet')
@endsection
s
@section('content')
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">Edit Service Style</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('servicestyles.index') }}">Service Style</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Service Style</li>
            </ol>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div>
                        <h6 class="main-content-label mb-1">Edit Service Style</h6>
                        <p class="text-muted card-sub-title">Edit Service Style with details.</p>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <form method="POST" action="{{ route('servicestyles.update', $record->id) }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group row">
                                        <div class="col-lg-3 mb-3">
                                            <label for="name">Name</label>
                                            <input class="form-control" id="name" name="name" required
                                                type="text" value="{{ $record->name }}">
                                        </div>
                                        <div class="col-lg-3 mb-3">
                                            <label for="course_type_id">Course Type</label>
                                            <select id="course_type_id" class="form-control" name="course_type_id" required>
                                                @foreach ($coursetypes as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $record->course_type_id == $item->id ? 'selected' : '' }}>
                                                        {{ $item->type }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-lg-3 mb-3">
                                            <label for="status">Status</label>
                                            <select class="form-control" id="status" name="status" required>
                                                <option value="0" {{ $record->status == 0 ? 'selected' : '' }}>In Active
                                                </option>
                                                <option value="1" {{ $record->status == 1 ? 'selected' : '' }}>Active
                                                </option>
                                            </select>
                                        </div>

                                        <div class="col-12 mb-3" style="text-align: end;">
                                            <button class="btn ripple btn-main-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
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
