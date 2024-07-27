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
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>

                        <li class="breadcrumb-item active" aria-current="page">Edit Menu Request</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card custom-card mg-b-20">
                        <div class="card-body">
                            @if (Auth::user()->Role == 'Admin')
                                @foreach ($request_dishes as $item)
                                    <div class="form-group row align-items-end mb-3">
                                        <div class="col-lg-4 mb-3">
                                            <label for="category">Selected items</label>
                                            {{-- @dd($item) --}}
                                            <input type="hidden" name="eventId" value="{{ $eventId }}">

                                            <select class="form-control select2 old-dishes" name="olddishes[]">
                                                <option value='{{ $item->old_dish_id }}'>
                                                    {{ $item->oldDish->oldDishname }}
                                                    ({{ $item->oldDish->subcategory->name }})
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label for="category">Replace by</label>
                                            <select class="form-control select2 new-dishes" name="newdishes[]">
                                                <option disabled selected value="">Select item</option>
                                                @foreach ($dishes as $dish)
                                                    <option {{ $item->new_dish_id == $dish->id ? 'selected' : '' }}
                                                        value='{{ $dish->id }}'>{{ $dish->name }}
                                                        ({{ $dish->subcategory->name }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <label for="category">Status</label>
                                            <br>
                                            <p class="{{ $item->status ? 'text-success' : 'text-danger' }} mb-0">
                                                {{ $item->status ? 'Accept' : 'Pending' }}</ap>
                                                @if (!$item->status)
                                                    <button type="button" class="btn ripple btn-success accept-button"
                                                        data-event-id="{{ $eventId }}"
                                                        data-old-dish-id="{{ $item->old_dish_id }}"
                                                        data-new-dish-id="{{ $item->new_dish_id }}">Accept</button>
                                                @endif
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <form action="{{ route('submit.menu.query') }}" method="post">
                                    @csrf
                                    <div id="formContainer">
                                        <div class="form-group row align-items-end mb-3">
                                            <div class="col-lg-4 mb-3">
                                                <label for="category">Selected items</label>

                                                <input type="hidden" name="eventId" value="{{ $eventId }}">
                                                <select class="form-control select2 old-dishes" name="olddishes[]">
                                                    <option disabled selected value="">Select item</option>
                                                    @foreach ($menus as $menu)
                                                        <option value='{{ $menu->dishes->id }}'>
                                                            {{ $menu->dishes->name }}
                                                            ({{ $menu->dishes->subcategory->name }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-4 mb-3">
                                                <label for="category">Replace by</label>
                                                <select class="form-control select2 new-dishes" name="newdishes[]">
                                                    <option disabled selected value="">Select item</option>
                                                    <!-- Options will be populated via AJAX -->
                                                </select>
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
                                        <button type="save" class="btn ripple btn-main-primary">Save Items</button>
                                    </div>


                                </form>
                            @endif
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
            // Handle the click event for the Accept button
            $(".accept-button").click(function() {
                var button = $(this);
                var oldDishId = button.data("old-dish-id");
                var eventId = button.data("event-id");
                var newDishId = button.closest(".form-group").find(".new-dishes").val();

                // Ensure a new dish is selected
                if (!newDishId) {
                    alert("Please select a new dish.");
                    return;
                }

                $.ajax({
                    url: "{{ route('menu.acceptDishChange') }}", // Update with your route
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        old_dish_id: oldDishId,
                        new_dish_id: newDishId,
                        eventId: eventId
                    },
                    success: function(response) {
                        // Handle success response
                        alert(response.message);

                        // Update the status and hide the Accept button
                        button.closest(".form-group").find(".status-text").text('Accept')
                            .removeClass('text-danger').addClass('text-success');
                        button.remove(); // Hide the Accept button
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        alert("An error occurred: " + xhr.responseText);
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            var count = `{{ $menus->count() }}`;

            // Function to initialize select2 for dynamically added fields
            function initializeSelect2() {
                $('.select2').select2();
            }

            // Function to update the visibility of the "Remove" button
            function updateRemoveButtonVisibility() {
                var removeButtons = $("#formContainer .removeField");
                removeButtons.prop("disabled", removeButtons.length === 1);
            }

            // Function to update the visibility of the "Add Field" button
            function updateAddFieldButtonVisibility() {
                var divCount = $("#formContainer").children(".form-group").length;
                if (count == divCount) {
                    $("#addField").addClass('d-none');
                } else {
                    $("#addField").removeClass('d-none');
                }
            }

            // Add field button functionality
            $("#addField").click(function() {
                var newFieldHTML = `
                <div class="form-group row align-items-end mb-3">
                    <div class="col-lg-4 mb-3">
                        <label for="category">Selected items</label>
                        <select class="form-control select2 old-dishes" name="olddishes[]">
                            <option disabled selected value="">Select item</option>
                            @foreach ($menus as $menuOption)
                            <option value='{{ $menuOption->dishes->id }}'>
                                {{ $menuOption->dishes->name }} ({{ $menuOption->dishes->subcategory->name }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-4 mb-3">
                        <label for="category">Replace by</label>
                        <select class="form-control select2 new-dishes" name="newdishes[]">
                            <option disabled selected value="">Select item</option>
                            <!-- Options will be populated via AJAX -->
                        </select>
                    </div>
                    <div class="col-lg-4 mb-3">
                        <button type="button" class="btn ripple btn-danger removeField">Remove</button>
                    </div>
                </div>`;

                $("#formContainer").append(newFieldHTML);
                updateRemoveButtonVisibility();
                updateAddFieldButtonVisibility(); // Update visibility after adding a new field
                initializeSelect2(); // Reinitialize select2 for new fields
            });

            // Remove field button functionality
            $("#formContainer").on("click", ".removeField", function() {
                if ($("#formContainer .form-group").length > 1) {
                    $(this).closest(".form-group").remove();
                    updateRemoveButtonVisibility();
                    updateAddFieldButtonVisibility(); // Update visibility after removing a field
                }
            });

            // Function to handle change event in the old dishes dropdown
            $("#formContainer").on("change", ".old-dishes", function() {
                var selectedValue = $(this).val();
                var newDishesDropdown = $(this).closest(".form-group").find(".new-dishes");

                if (selectedValue) {
                    // Make an AJAX request to get the new dishes based on the selected old dish
                    $.ajax({
                        url: `{{ route('menu.getNewDishes') }}`, // Replace with your endpoint URL
                        method: 'GET',
                        data: {
                            oldDishId: selectedValue
                        },
                        success: function(response) {
                            newDishesDropdown.empty().append(
                                '<option disabled selected value="">Select item</option>');
                            response.forEach(function(dish) {
                                newDishesDropdown.append(
                                    `<option value="${dish.id}">${dish.name} (${dish.subcategory.name})</option>`
                                );
                            });
                        }
                    });
                } else {
                    newDishesDropdown.empty().append(
                        '<option disabled selected value="">Select item</option>');
                }
            });

            // Initial update of the "Remove" button visibility
            updateRemoveButtonVisibility();

            // Initialize select2 for existing fields
            initializeSelect2();

            // Initial update of the "Add Field" button visibility
            updateAddFieldButtonVisibility();
        });
    </script>
@endsection
