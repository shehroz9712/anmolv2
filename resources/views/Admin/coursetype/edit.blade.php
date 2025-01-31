@extends('Dashboard.Master.master_layout')
@section('title')
    Edit Course Type - EatAnmol
@endsection

@section('stylesheet')
@endsection

@section('content')
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">Edit Course Type</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('coursetypes.index') }}">Course Type</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Course Type</li>
            </ol>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div>
                        <h6 class="main-content-label mb-1">Edit Course Type</h6>
                        <p class="text-muted card-sub-title">Edit Course Type with details.</p>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <form action="{{ route('coursetypes.update', $course->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <!-- This indicates that the form will be used to update a resource -->

                                    <div class="row">
                                        <div class="col-lg-4 mb-3">
                                            <label for="type">Type</label>
                                            <input class="form-control" id="type" name="type" required
                                                type="text" value="{{ $course->type }}">
                                            <small id="typeError" class="text-danger"></small>
                                        </div>
                                        

                                        <div class="col-lg-4 mb-3">
                                            <label for="status">Status</label>
                                            <select class="form-control" id="status" name="status" required>
                                                <option value="0" {{ $course->status == 0 ? 'selected' : '' }}>
                                                    In Active</option>
                                                <option value="1" {{ $course->status == 1 ? 'selected' : '' }}>Active
                                                </option>
                                            </select>
                                            <small id="statusError" class="text-danger"></small>
                                        </div>

                                        <div class="col-12 mb-3" style="text-align: end;">
                                            <button class="btn ripple btn-main-primary" type="submit">Submit</button>
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
            // Array to store selected coursetypes
            var selectedCoursetypes = [];

            // Add field button functionality
            $("#addField").click(function() {
                // Clone the first form group and append it to the container
                var clonedField = $("#formContainer .form-group:first").clone();
                clonedField.find("select").val(""); // Clear the selected value
                clonedField.find("input").val(""); // Clear the selected value
                // Disable already selected coursetypes in the cloned field
                disableSelectedCoursetypes(clonedField);

                $("#formContainer").append(clonedField);
                updateRemoveButtonVisibility();
            });

            // Remove field button functionality
            $("#formContainer").on("click", ".removeField", function() {
                // Remove the parent form group only if there is more than one
                if ($("#formContainer .form-group").length > 1) {
                    var removedCourse Type = $(this).closest(".form-group").find("select").val();
                    $(this).closest(".form-group").remove();
                    // Remove the course type from the selectedCoursetypes array
                    selectedCoursetypes = selectedCoursetypes.filter(function(course type) {
                        return course type !== removedCourse Type;
                    });
                    updateRemoveButtonVisibility();
                }
            });

            // Function to update the visibility of the "Remove" button
            function updateRemoveButtonVisibility() {
                var removeButtons = $("#formContainer .removeField");
                removeButtons.prop("disabled", removeButtons.length === 1);
            }

            // Function to disable selected coursetypes in a given field
            function disableSelectedCoursetypes(field) {
                field.find("select option").prop("disabled", false); // Enable all options
                selectedCoursetypes.forEach(function(course type) {
                    field.find("select option[value='" + course type + "']").prop("disabled", true);
                });
            }

            // Function to handle change event in course type dropdown
            $("#formContainer").on("change", "select[name='course type[]']", function() {
                // Add the selected course type to the array
                var selectedCourse Type = $(this).val();
                selectedCoursetypes.push(selectedCourse Type);
                // Disable selected coursetypes in other fields
                disableSelectedCoursetypes($("#formContainer .form-group:not(:has(.removeField))"));
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
