@extends('Dashboard.Master.master_layout')
@section('title')
    Labour | Create Labour
@endsection

@section('stylesheet')
@endsection

@section('content')
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">Add Labour</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('labours.index') }}">Labour</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Labour</li>
            </ol>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div>
                        <h6 class="main-content-label mb-1">Add Labour</h6>
                        <p class="text-muted card-sub-title">Add a new Labour with details.</p>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <form method="POST" action="{{ route('labours.store') }}" onsubmit="return validateForm();">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-lg-4 mb-3">
                                            <label for="name">Name</label>
                                            <input class="form-control" id="name" name="name" required type="text">
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label for="designation">Designation</label>
                                            <input class="form-control" id="designation" name="designation" required type="text" step="0.01">
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label for="with_dish">With Dish</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="with_dish" name="with_dish" value="1">
                                                <label class="form-check-label" for="with_dish">With Dish</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-4 mb-3">
                                            <label for="guest">Guest</label>
                                            <input type="number" class="form-control" id="guest" name="guest" required type="text">
                                        </div>

                                        <div class="col-lg-4 mb-3">
                                            <label for="price">Price</label>
                                            <input class="form-control" id="price" name="price" required type="number" step="0.01">
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label for="status">Status</label>
                                            <select class="form-control" id="status" name="status" required>
                                                <option value="0">Inactive</option>
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
