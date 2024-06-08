@extends('Dashboard.Master.master_layout')
@section('title')
    Sub Category | Edit Sub Category
@endsection

@section('stylesheet')
@endsection

@section('content')
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">Edit Sub Category</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('subcategories.index') }}">Sub Category</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Sub Category</li>
            </ol>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div>
                        <h6 class="main-content-label mb-1">Edit Sub Category</h6>
                        <p class="text-muted card-sub-title">Edit Sub Category with details.</p>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <form method="POST" action="{{ route('subcategories.update', $record->id) }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group row">
                                        <div class="col-lg-3 mb-3">
                                            <label for="name">Name</label>
                                            <input class="form-control" id="name" name="name" required
                                                type="text" value="{{ $record->name }}">
                                        </div>
                                        <div class="col-lg-3 mb-3">
                                            <label for="category_id">Category</label>
                                            <select id="category_id" class="form-control" name="category_id" required>
                                                @foreach ($categories as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $record->category_id == $item->id ? 'selected' : '' }}>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-3 mb-3">
                                            <label for="is_addon">Is Addon</label>
                                            <select class="form-control" id="is_addon" name="is_addon" required>
                                                <option value="0" {{ $record->is_addon == 0 ? 'selected' : '' }}>No
                                                </option>
                                                <option value="1" {{ $record->is_addon == 1 ? 'selected' : '' }}>Yes
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 mb-3">
                                            <label for="status">Status</label>
                                            <select class="form-control" id="status" name="status" required>
                                                <option value="0" {{ $record->status == 0 ? 'selected' : '' }}>Inactive
                                                </option>
                                                <option value="1" {{ $record->status == 1 ? 'selected' : '' }}>Active
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 mb-3">
                                            <label for="term">It is</label>
                                            <select class="form-control" id="term" name="term" required>
                                                <option
                                                    value="main course"{{ $record->term == 'main course' ? 'selected' : '' }}>
                                                    Main Course</option>
                                                <option
                                                    value="appetizer"{{ $record->term == 'appetizer' ? 'selected' : '' }}>
                                                    Appetizer</option>
                                                <option
                                                    value="dessert"{{ $record->term == 'dessert' ? 'selected' : '' }}>
                                                    Dessert</option>
                                            </select>
                                        </div>
                                        <div id="formContainer" class="col-12">
                                            <!-- Loop through existing package includes -->
                                            @foreach ($record->price as $item)
                                                <div class="form-group row align-items-end mb-3">
                                                    <div class="col-lg-4 mb-3">
                                                        <label for="number">Number of Items</label>
                                                        <input class="form-control" type="number" name="number[]"
                                                            value="{{ $item->pick }}">
                                                    </div>
                                                    <div class="col-lg-4 mb-3">
                                                        <label for="number">Price</label>
                                                        <input class="form-control" type="number" name="price[]"
                                                            value="{{ $item->price }}">
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
