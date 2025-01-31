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
                        <form action="{{ route('dishes.update', $dish->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                        
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ $dish->name }}" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="image">Image</label>
                                            <input type="file" class="form-control" id="image" name="image">
                                            <br>
                                            @if($dish->image)
                                                <img src="{{ asset('storage/'.$dish->image) }}" width="100" alt="Dish Image">
                                            @endif
                                        </div>
                                    </div>
                        
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="price">Price (Leave blank if you need item category price)</label>
                                            <input type="number" class="form-control" id="price" name="price" value="{{ $dish->price }}">
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label for="course_type_id">Course Type</label>
                                            <select class="form-control" id="course_type_id" name="course_type_id" required>
                                                @foreach ($coursetype as $item)
                                                    <option value="{{ $item->id }}" {{ $dish->course_type_id == $item->id ? 'selected' : '' }}>
                                                        {{ $item->type }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="service_style_id">Service Style</label>
                                            <select class="form-control" id="service_style_id" name="service_style_id" required>
                                                <option value="">Select Service Style</option>
                                                @foreach ($serviceStyles as $style)
                                                    <option value="{{ $style->id }}" {{ $dish->service_style_id == $style->id ? 'selected' : '' }}>
                                                        {{ $style->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="subcategory_id">Sub Category</label>
                                            <select class="form-control" id="subcategory_id" name="subcategory_id" required>
                                                <option value="">Select Sub Category</option>
                                                @foreach ($subcategories as $sub)
                                                    <option value="{{ $sub->id }}" {{ $dish->subcategory_id == $sub->id ? 'selected' : '' }}>
                                                        {{ $sub->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                        
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="desc">Description</label>
                                            <input type="text" class="form-control" id="desc" name="desc" value="{{ $dish->desc }}">
                                        </div>
                                    </div>
                        
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="allergies">Allergies</label>
                                            @php
                                                $selectedAllergies = is_array($dish->allergies) ? $dish->allergies : explode(',', $dish->allergies);
                                            @endphp
                                            <select name="allergies[]" class="select2" multiple>
                                                <option value="milk" {{ in_array('milk', $selectedAllergies) ? 'selected' : '' }}>Milk</option>
                                                <option value="peanut" {{ in_array('peanut', $selectedAllergies) ? 'selected' : '' }}>Peanut</option>
                                                <option value="coconut" {{ in_array('coconut', $selectedAllergies) ? 'selected' : '' }}>Coconut</option>
                                                <option value="yogurt" {{ in_array('yogurt', $selectedAllergies) ? 'selected' : '' }}>Yogurt</option>
                                            </select>
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
                                                <option value="0" {{ $dish->status == 0 ? 'selected' : '' }}>In Active</option>
                                                <option value="1" {{ $dish->status == 1 ? 'selected' : '' }}>Active</option>
                                            </select>
                                        </div>
                                    </div>
                        
                                </div>
                            </div>
                        
                            <button class="btn btn-primary" type="submit">Update</button>
                        </form>
                        

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
