@extends('Dashboard.Master.master_layout')
@section('title')
    Sub Categories List - EatAnmol
@endsection

@section('stylesheet')
@endsection

@section('content')
    <div class="inner-body">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">Sub Categories</h2>
                 <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Manage Sub Categories</li>
                </ol>
            </div>
            <div class="d-flex">
                <div class="justify-content-center">
                    <a href="{{ route('subcategories.create') }}" class="btn btn-primary my-2 btn-icon-text">
                        <i class="fe fe-plus me-2"></i> Add Sub Categories
                    </a>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card custom-card mg-b-20">
                    <div class="card-body">
                        <h4 class="text-dark">Sub Categories</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="example2">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <!--<th>Is Addon</th>-->
                                        <th>It is</th>
                                        {{-- <th>Single</th>
                                        <th>Trio</th> --}}
                                        <th class="wd-lg-20p">status</th>
                                        <th class="wd-lg-20p">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subcategories as $record)
                                        <tr>
                                            <td>{{ $record->name }}</td>
                                            <td>{{ $record->category->name }}</td>
                                            <!--<td>{{ $record->is_addon }}</td>-->
                                            <td>{{ $record->term }}</td>
                                            {{-- <td>{{ $record->single }}</td>
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
                                                    href="{{ route('subcategories.edit', encrypt($record->id)) }}">Edit</a>
                                                <a class="btn btn-main-primary px-3"
                                                    href="{{ route('subcategories.show', encrypt($record->id)) }}">View</a>
                                                {{-- <form action="{{ route('subcategories.destroy', $subcategory->id) }}" method="POST"
                                                    style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger px-3"
                                                        onclick="return confirm('Are you sure you want to delete this subcategory?')">Delete</button>
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
