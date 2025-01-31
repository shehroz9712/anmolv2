@extends('Dashboard.Master.master_layout')
@section('title')
    Package | Edit Package - EatAnmol
@endsection

@section('stylesheet')
@endsection

@section('content')
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">Edit Package</h2>
             <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('packages.index') }}">Package</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Package</li>
            </ol>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div>
                        <h6 class="main-content-label mb-1">Edit Package</h6>
                        <p class="text-muted card-sub-title">Edit Package with details.</p>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <form method="POST" action="{{ route('packages.update', $package->id) }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group row">
                                        <div class="col-lg-3 mb-3">
                                            <label for="price">Price</label>
                                            <input class="form-control" id="price" name="price" required
                                                type="number" value="{{ $package->price }}">
                                            <small id="priceError" class="text-danger"></small>
                                        </div>

                                        <div class="col-lg-3 mb-3">
                                            <label for="person">Number of Persons</label>
                                            <input class="form-control" id="person" name="person" required
                                                type="number" value="{{ $package->person }}">
                                            <small id="personError" class="text-danger"></small>
                                        </div>

                                        <div class="col-lg-3 mb-3">
                                            <label for="category">Category</label>
                                            <select name="category_id" class="form-control">
                                                <option disabled selected value="">Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value='{{ $category->id }}'
                                                        {{ $category->id == $package->category_id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small id="categoryError" class="text-danger"></small>
                                        </div>

                                        <div class="col-lg-3 mb-3">
                                            <label for="status">Status</label>
                                            <select class="form-control" id="status" name="status">
                                                <option disabled selected value="">Select Status</option>
                                                <option value="0" {{ $package->status == 0 ? 'selected' : '' }}>
                                                    In Active</option>
                                                <option value="1" {{ $package->status == 1 ? 'selected' : '' }}>Active
                                                </option>
                                            </select>
                                            <small id="statusError" class="text-danger"></small>
                                        </div>

                                        <div class="col-12">
                                            <h4>Package Include</h4>
                                        </div>

                                        <div id="formContainer" class="col-12">
                                            <!-- Loop through existing package includes -->
                                            @foreach ($packageincludes as $packageinclude)
                                                <div class="form-group row align-items-end mb-3">
                                                    <div class="col-lg-4 mb-3">
                                                        <label for="category">Item Category</label>
                                                        <select class="form-control" name="category[]">
                                                            <option disabled selected value="">Select Dish Category
                                                            </option>
                                                            @foreach ($subcategories as $subcategory)
                                                                <option value='{{ $subcategory->id }}'
                                                                    {{ $subcategory->id == $packageinclude->sharable_id ? 'selected' : '' }}>
                                                                    {{ $subcategory->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-4 mb-3">
                                                        <label for="number">Number of Dishes</label>
                                                        <input class="form-control" type="number" name="number[]"
                                                            value="{{ $packageinclude->qty }}">
                                                    </div>
                                                    <div class="col-lg-4 mb-3">
                                                        <button type="button"
                                                            class="btn ripple btn-danger removeField">Remove</button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="col-12 mb-3">
                                            <button type="button" class="btn ripple btn-main-primary" id="addField">Add
                                                Field</button>
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
    <script>
        $(document).ready(function() {
            // Array to store selected categories
            var selectedCategories = [];

            // Add field button functionality
            $("#addField").click(function() {
                // Clone the first form group and append it to the container
                var clonedField = $("#formContainer .form-group:first").clone();
                clonedField.find("select").val(""); // Clear the selected value
                clonedField.find("input").val(""); // Clear the selected value
                // Disable already selected categories in the cloned field
                disableSelectedCategories(clonedField);

                $("#formContainer").append(clonedField);
                updateRemoveButtonVisibility();
            });

            // Remove field button functionality
            $("#formContainer").on("click", ".removeField", function() {
                // Remove the parent form group only if there is more than one
                if ($("#formContainer .form-group").length > 1) {
                    var removedCategory = $(this).closest(".form-group").find("select").val();
                    $(this).closest(".form-group").remove();
                    // Remove the category from the selectedCategories array
                    selectedCategories = selectedCategories.filter(function(category) {
                        return category !== removedCategory;
                    });
                    updateRemoveButtonVisibility();
                }
            });

            // Function to update the visibility of the "Remove" button
            function updateRemoveButtonVisibility() {
                var removeButtons = $("#formContainer .removeField");
                removeButtons.prop("disabled", removeButtons.length === 1);
            }

            // Function to disable selected categories in a given field
            function disableSelectedCategories(field) {
                field.find("select option").prop("disabled", false); // Enable all options
                selectedCategories.forEach(function(category) {
                    field.find("select option[value='" + category + "']").prop("disabled", true);
                });
            }

            // Function to handle change event in category dropdown
            $("#formContainer").on("change", "select[name='category[]']", function() {
                // Add the selected category to the array
                var selectedCategory = $(this).val();
                selectedCategories.push(selectedCategory);
                // Disable selected categories in other fields
                disableSelectedCategories($("#formContainer .form-group:not(:has(.removeField))"));
            });

            // Initial update of the "Remove" button visibility
            updateRemoveButtonVisibility();
        });
    </script>


    <script>
        // Function to validate the name field
        function validateName() {
            const nameInput = document.getElementById('name');
            const nameError = document.getElementById('nameError');
            const nameValue = nameInput.value;

            nameError.innerText = ''; // Reset previous error message

            if (nameValue.trim() === '') {
                nameError.innerText = 'Name is required';
                return false;
            } else if (/[^a-zA-Z0-9\s]/.test(nameValue)) {
                nameError.innerText = 'Name should only contain letters, numbers, and spaces';
                return false;
            }

            return true;
        }
    </script>
@endsection
