@extends('Dashboard.Master.master_layout')
@section('title')
    Sub Category Detail - EatAnmol
@endsection

@section('stylesheet')
@endsection

@section('content')
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">Sub Category Detail</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('subcategories.index') }}">Sub Category Detail</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sub Category Detail</li>
            </ol>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div>
                        <h6 class="main-content-label mb-1">Sub Category Detail</h6>
                        <p class="text-muted card-sub-title"> Sub Category with details.</p>
                    </div>
                    <div class="container">

                        <div class="row">
                            <div class="col-md-12">
                                <h2>Main Subategory Details</h2>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th class="col-sm-4">Name</th>
                                                <td class="col-sm-8">{{ $record->name }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-sm-4">Category</th>
                                                <td class="col-sm-8">{{ $record->category->name }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-sm-4">It is</th>
                                                <td class="col-sm-8">{{ $record->term }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-sm-4">Is Addon</th>
                                                <td class="col-sm-8">{{ $record->is_addon ? 'Yes' : 'No' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-sm-4">Status</th>
                                                <td class="col-sm-8">{{ $record->status ? 'Active' : 'Inactive' }}</td>
                                            </tr>
                                            @foreach ($record->price as $item)
                                                <tr>
                                                    <th class="col-sm-4">{{ $item->pick }} Pick</th>
                                                    <td class="col-sm-8">${{ $item->price }}</td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>

                            </div>


                        </div>
                        <div class="d-flex">
                            <div class="justify-content-center">
                                <a href="{{ route('subcategories.index') }}" class="btn btn-primary ">
                                    Back to Sub Category
                                </a>
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
