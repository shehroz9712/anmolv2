@extends('Dashboard.Master.master_layout')
@section('title')
    Edit Item - EatAnmol
@endsection


@section('stylesheet')
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
@endsection


@section('content')
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">Edit Item</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dishes.index') }}">Item</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Item</li>
            </ol>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div>
                        <h6 class="main-content-label mb-1">Edit Item</h6>
                        <p class="text-muted card-sub-title">Edit Item with details.</p>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <form action="{{ route('dishes.update', $dish->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT') <!-- Use PUT method for updating -->

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ $dish->name }}" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="image">Image</label>
                                            <input type="file" class="form-control" id="image" name="image">
                                            <!-- Display current image -->
                                                <img src="{{ asset('uploads/dishes/' . $dish->image) }}"
                                                    alt="Current Image" width="100">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="price">Price(Leave blank if you need item category price)</label>
                                            <input type="number" class="form-control" id="price" name="price"
                                                value="{{ $dish->price }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="subcategory_id">Sub Category</label>
                                            <select class="form-control" id="subcategory_id" name="subcategory_id" required>
                                                @foreach ($subcategory as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $dish->subcategory_id == $item->id ? 'selected' : '' }}>
                                                        {{ $item->name }} <small>
                                                            @if ($item->is_addon)
                                                                (Addon Items)
                                                            @else
                                                                ( Regular)
                                                            @endif
                                                        </small>
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="unit">Unit</label>
                                            <input type="text" class="form-control" id="unit" name="unit"
                                                value="{{ $dish->unit }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="desc">Description</label>
                                            <input type="text" class="form-control" id="desc" name="desc"
                                                value="{{ $dish->desc }}">
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <div class="form-group mb-3">
                                                <label for="labour">Labours Name </label>
                                                <select name="labour[]" class="select2" multiple id="">
                                                    @foreach ($labours as $item)
                                                        <option value="{{ $item->id }}"
                                                            @if ($dish->labour && $dish->labour->contains($item->id)) selected @endif>
                                                            {{ $item->designation }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <div class="form-group mb-3">
                                                <label for="equipment">Equipments Name </label>
                                                <select name="equipment[]" class="select2" multiple id="">
                                                    @foreach ($equipments as $item)
                                                        <option value="{{ $item->id }}"
                                                            @if ($dish->equipment && $dish->equipment->contains($item->id)) selected @endif>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="long_desc">Long Description</label>
                                            <textarea class="form-control" id="long_desc" name="long_desc" rows="3">{{ $dish->long_desc }}</textarea>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="status">Status</label>
                                            <select class="form-control" id="status" name="status">
                                                <option value="0" {{ $dish->status == 0 ? 'selected' : '' }}>Inactive
                                                </option>
                                                <option value="1" {{ $dish->status == 1 ? 'selected' : '' }}>Active
                                                </option>
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
