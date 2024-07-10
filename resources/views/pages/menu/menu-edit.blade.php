@extends('Dashboard.Master.master_layout')
@section('title')
    Edit Menu Request - EatAnmol
@endsection
@section('content')
    <div class="main-container container-fluid">
        <div class="inner-body">
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Edit Menu Request </h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>

                        <li class="breadcrumb-item active" aria-current="page">Edit Menu Request</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card custom-card mg-b-20">
                        <div class="card-body">
                            <div id="formContainer" class="col-12">
                                <!-- Initial category and number fields -->
                                <div class="form-group row align-items-end mb-3">
                                    <div class="col-lg-4 mb-3">
                                        <label for="category">Selected items</label>
                                        <select class="form-control select2" name="olddishes[]">
                                            <option disabled selected value="">Select item
                                            </option>
                                            @foreach ($menus as $menu)
                                                <option value='{{ $menu->id }}'>
                                                    {{ $menu->dishes->name }} ({{ $menu->dishes->subcategory->name }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <label for="category">Replace by</label>
                                        <select class="form-control select2" name="newdishes[]">
                                            <option disabled selected value="">Select item
                                            </option>
                                            @foreach ($dishes as $dish)
                                                <option value='{{ $dish->id }}'>{{ $dish->name }}
                                                    ({{ $dish->subcategory->name }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <button type="button" class="btn ripple btn-danger removeField">Remove</button>
                                    </div>
                                </div>


                            </div>
                            <div class="col-12 mb-3">
                                <button type="button" class="btn ripple btn-main-primary" id="addField">Add
                                    Field</button>
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
@endsection
