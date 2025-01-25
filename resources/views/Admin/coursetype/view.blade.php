@extends('Dashboard.Master.master_layout')
@section('title')
    Course Type Detail - EatAnmol
@endsection

@section('stylesheet')
@endsection

@section('content')
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">Course Type Detail</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('coursetypes.index') }}">Course Type Detail</a></li>
                <li class="breadcrumb-item active" aria-current="page">Course Type Detail</li>
            </ol>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div>
                        <h6 class="main-content-label mb-1">Course Type Detail</h6>
                        <p class="text-muted card-sub-title"> Course Type with details.</p>
                    </div>
                    <div class="container">

                        <div class="row">
                            <div class="col-md-6">
                                <h2>{{ $course->name }} Course Type Details</h2>
                                <div class="table-responsive">
                                    <table class="table ">
                                        <tbody>
                                            <tr>
                                                <th class="col-sm-4">Name</th>
                                                <td class="col-sm-8">{{ $course->type }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-sm-4">Status</th>
                                                <td class="col-sm-8">{{ $course->status == 1 ? 'Active' : 'Inactive' }}
                                                </td>
                                            </tr>


                                        </tbody>
                                    </table>
                                    </table>
                                </div>

                            </div>


                        </div>
                        <div class="d-flex">
                            <div class="justify-content-center">
                                <a href="{{ route('coursetypes.index') }}" class="btn btn-primary ">
                                    Back to Coursetypes
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
