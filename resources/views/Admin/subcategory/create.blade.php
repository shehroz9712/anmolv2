@extends('Dashboard.Master.master_layout')
@section('title')
    Create Sub Category - EatAnmol
@endsection

@section('stylesheet')
@endsection

@section('content')
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">Add Sub Category</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('subcategories.index') }}">Sub Category</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Sub Category</li>
            </ol>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div>
                        <h6 class="main-content-label mb-1">Add Sub Category</h6>
                        <p class="text-muted card-sub-title">Add a new Sub Category with details.</p>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <form method="POST" action="{{ route('subcategories.store') }}"
                                    onsubmit="return validateForm();">
                                    @csrf
                                    <div class="form-group row">

                                        <div class="col-lg-4 mb-3">
                                            <label for="name">Name</label>
                                            <input class="form-control" id="name" name="name" required
                                                type="text">
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label for="course_type_id">Course Type</label>
                                            <select class="form-control" id="course_type_id" name="course_type_id"
                                                required>
                                                @foreach ($coursetype as $item)
                                                    <option value="{{ $item->id }}">{{ $item->type }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label for="service_style_id">Service Style</label>
                                            <select class="form-control" id="service_style_id" name="service_style_id"
                                                required>
                                                <option value="">Select Service Style</option>
                                                <!-- Service styles will be loaded dynamically -->
                                            </select>
                                        </div>


                                        <div class="col-lg-4 mb-3">
                                            <label for="is_addon">Is Addon</label>
                                            <select class="form-control" id="is_addon" name="is_addon" required>
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label for="status">Status</label>
                                            <select class="form-control" id="status" name="status" required>
                                                <option value="0">In Active</option>
                                                <option value="1">Active</option>

                                            </select>
                                        </div>

                                        <h6 class="main-content-label mb-3">Sub Category Prices </h6>

                                        <div id="formContainer" class="col-12">
                                            <!-- Initial category and number fields -->
                                            <div class="form-group row align-items-end mb-3">
                                                <div class="col-lg-4 mb-3">
                                                    <label for="number">Number of Items </label>
                                                    <input class="form-control" type="number" name="number[]">
                                                </div>
                                                <div class="col-lg-4 mb-3">
                                                    <label for="number">Price </label>
                                                    <input class="form-control" type="number" name="price[]">
                                                </div>
                                                <div class="col-lg-4 mb-3">
                                                    <button type="button"
                                                        class="btn ripple btn-danger removeField">Remove</button>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="col-12 mb-3">
                                            <button type="button" class="btn ripple btn-main-primary" id="addField">Add
                                                Field</button>
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
        document.getElementById("course_type_id").addEventListener("change", function() {
            var courseTypeId = this.value;
            var serviceStyleDropdown = document.getElementById("service_style_id");

            // Clear existing options
            serviceStyleDropdown.innerHTML = '<option value="">Select Service Style</option>';

            if (courseTypeId) {
                fetch("{{ route('getServiceStyles') }}?course_type_id=" + courseTypeId)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(item => {
                            let option = new Option(item.name, item.id);
                            serviceStyleDropdown.appendChild(option);
                        });
                    })
                    .catch(error => console.error("Error fetching service styles:", error));
            }
        });
    </script>
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
