@extends('Dashboard.Master.master_layout')
@section('title')
    Create Item - EatAnmol
@endsection

@section('stylesheet')
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
@endsection

@section('content')
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">Add Item</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dishes.index') }}">Item</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Item</li>
            </ol>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div>
                        <h6 class="main-content-label mb-1">Add Item</h6>
                        <p class="text-muted card-sub-title">Add a new Item with details.</p>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <form action="{{ route('dishes.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="image">Image</label>
                                            <input type="file" class="form-control" id="image" name="image">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="price">Price (Leave blank if you need item category
                                                price)</label>
                                            <input type="number" class="form-control" id="price" name="price">
                                        </div>
                                        {{-- <div class="col-md-6 mb-3">
                                            <label for="equipment_id">Equipment ID</label>
                                            <input type="number" class="form-control" id="equipment_id"
                                                name="equipment_id">
                                        </div> --}}
                                        <div class="col-md-6 mb-3">
                                            <label for="subcategory_id">Sub Category</label>
                                            <select class="form-control" id="subcategory_id" name="subcategory_id" required>
                                                @foreach ($subcategory as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }} <small>
                                                            @if ($item->is_addon)
                                                                (Addon Items)
                                                            @endif
                                                        </small>
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        {{-- <div class="col-md-6 mb-3">
                                            <label for="unit">Unit</label>
                                            <input type="text" class="form-control" id="unit" name="unit">
                                        </div> --}}
                                        <div class="col-md-12 mb-3">
                                            <label for="desc">Description</label>
                                            <input type="text" class="form-control" id="desc" name="desc">
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-12 mb-3">
                                            <div class="form-group mb-3">
                                                <label for="allergies">allergies </label>
                                                <select name="allergies[]" class="select2" multiple id="">
                                                    <option value="milk">Milk</option>
                                                    <option value="peanut">Peanut</option>
                                                    <option value="coconut">Coconut</option>
                                                    <option value="yogurt">Yogurt</option>
                                                </select>

                                            </div>

                                        </div>

                                    </div>
                                    {{-- <div class="row">

                                        <div class="col-md-12 mb-3">
                                            <div class="form-group mb-3">
                                                <label for="equipment">Equipments Name </label>
                                                <select name="equipment[]" class="select2" multiple id="">
                                                    @foreach ($equipments as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>

                                            </div>

                                        </div>

                                    </div>
                                    <div class="row">

                                        <div class="col-md-12 mb-3">
                                            <div class="form-group mb-3">
                                                <label for="labour">Staff </label>
                                                <select name="labour[]" class="select2" multiple id="">
                                                    @foreach ($labours as $item)
                                                        <option value="{{ $item->id }}">{{ $item->designation }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>

                                    </div> --}}

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="long_desc">Long Description</label>
                                <!-- Add a unique id to the textarea -->
                                <textarea class="form-control" id="long_desc" name="long_desc" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="0">Inactive</option>
                                    <option value="1">Active</option>
                                </select>
                            </div>
                        </div>


                        <button class="btn btn-primary" type="submit">Submit</button>
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
    <script>
        // Initialize CKEditor on the textarea with id "long_desc"
        ClassicEditor
            .create(document.querySelector('#long_desc'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
