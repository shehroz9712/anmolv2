@extends('Dashboard.Master.master_layout')

@section('title')
    Addon Menu - EatAnmol
@endsection
@section('stylesheet')
    <style>
        .ckbox span:hover {
            cursor: pointer;
        }

        .card-body {
            height: 70vh;
            overflow: auto;
            margin: 10px;
        }

        dt {
            color: #ff7501;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
{{-- @php
            $url = url()->current();
            $segments = collect(explode('/', $url));
            $lastSegment = $segments->last();
        @endphp

        {{-- Output the last segment --}}
{{-- $lastSegment }} --}}
@section('content')
    <div class="main-container container-fluid">
        <div class="inner-body" style="margin-bottom: 5rem;">
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Menu </h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('events.index') }}">Events</a></li>

                        <li class="breadcrumb-item active" aria-current="page">Menu</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card custom-card mg-b-20">
                        <div class="card-body" style="">
                            <div class="row">
                                <!-- col -->
                                @foreach ($categories as $key => $category)
                                    <div class="col-lg-12">
                                        <h3>{{ $category->name }}</h3>
                                        <p> Overview or Details</p>
                                        <ul id="treeview{{ $key + 1 }}">
                                            <!-- Loop through sub-categories -->
                                            @foreach ($category->sub_category as $sub_category)
                                                <li>
                                                    <a href="#">
                                                        {{ $sub_category->name }}
                                                    </a>
                                                    <ul>
                                                        <!-- Loop through dishes -->
                                                        @foreach ($sub_category->dishes ?? [] as $key => $dishes)
                                                            <li>
                                                                <div class="form-group mg-b-20">
                                                                    <div class="align-items-center row">
                                                                        <div class="col-md-10">
                                                                            <label class="ckbox">
                                                                                <input type="checkbox" class="dish-checkbox"
                                                                                    data-category="{{ $sub_category->name }}"
                                                                                    data-id="{{ $dishes->id }}">
                                                                                <span
                                                                                    class="tx-13">{{ $dishes->name }}</span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <a class="btn ripple"
                                                                                data-bs-target="#modaldemo{{ $dishes->id }}"
                                                                                data-bs-toggle="modal" href="#">
                                                                                <i class="fa fa-info-circle"
                                                                                    style="font-size: 12px;"></i>
                                                                            </a>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <p>{{ $dishes->desc }}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal fade" id="modaldemo{{ $dishes->id }}"
                                                                    tabindex="-1" role="dialog"
                                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="exampleModalLabel">
                                                                                    {{ $dishes->name }}</h5>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    style="margin: -10px 0 0px 0px;"
                                                                                    aria-label="Close">
                                                                                    <i class="fa fa-close fs-5"></i>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p>{!! $dishes->long_desc !!}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <!-- /col -->
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card custom-card">
                        <div class="card-header">
                            <h5 class="mb-3 font-weight-bold tx-14">Selected Menu</h5>
                        </div>
                        <form action="{{ route('menu.submit') }}" method="post" id="formid">
                            @csrf
                            <div class="card-body" id="scrolldev" style="height: 340px;">


                                <input type="hidden" name="url" value="{{ Request::segments()[1] }}">
                                <input type="hidden" name="eventId" value="{{ $eventId }}">

                                <div class="table-responsive">
                                    <table class="table border table-hover text-nowrap table-shopping-cart mb-0"
                                        id="selected-dishes">
                                        <thead class="text-muted">
                                            <tr class="small text-uppercase">
                                                <th scope="col">Items</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            <td>
                                                <div id="loader" style="display: none;">
                                                    <div class="spinner-border text-primary" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tbody>

                                    </table>
                                </div>
                            </div>

                            <div class="">
                                <div id="single-category-dishes-count"></div>
                                <button class="btn ripple btn-outline-primary" id="save-button" type="button"
                                    style=" margin: 0px  30px 15px; float:right; display:none">Save & Continue</button>
                                <button class="btn ripple btn-outline-primary" id="skip-button" type="button"
                                    style="margin: 0px  30px 15px; float:right;">Skip
                                    &
                                    Continue</button>

                            </div>

                            <div class="modal" id="myModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Special Instruction</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal Body -->
                                        <div class="modal-body">

                                            <textarea name="instruction" style="height: 200px;width: 100%;color: black;padding: 10px;"></textarea>
                                        </div>

                                        <!-- Modal Footer -->
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary" id="popup-save"
                                                data-dismiss="modal">Save</button>
                                        </div>

                                    </div>
                                </div>
                            </div>

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
        var segments = window.location.pathname.split('/');
        var secondLastSegment = segments[segments.length - 2];
        if (window.location.pathname.split('/').pop() == 'addon' || secondLastSegment == 'addon') {

            // When save button is clicked, show the modal
            document.getElementById('save-button').addEventListener('click', function() {
                $('#myModal').modal('show');
            });

            // When skip button is clicked, show the modal
            document.getElementById('skip-button').addEventListener('click', function() {
                $('#myModal').modal('show');
            });
        } else {
            var form = document.getElementById('formid');
            var saveButton = document.getElementById('save-button');
            var skipButton = document.getElementById('skip-button');

            saveButton.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default form submission
                Swal.fire({
                    title: 'Do you want addons?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit the form with additional data indicating the choice
                        submitForm(true);
                    } else {
                        // Continue with form submission without navigating
                        submitForm(false);
                    }
                });
            });

            skipButton.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default form submission
                Swal.fire({
                    title: 'Do you want addons?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit the form with additional data indicating the choice
                        submitForm(true);
                    } else {
                        // Continue with form submission without navigating
                        submitForm(false);
                    }
                });
            });

            function submitForm(navigateToAddon) {
                // Append a hidden input to the form to indicate the user's choice
                var navigateInput = document.createElement('input');
                navigateInput.type = 'hidden';
                navigateInput.name = 'navigate_to_addon';
                navigateInput.value = navigateToAddon ? 'yes' : 'no';
                form.appendChild(navigateInput);

                // Submit the form
                form.submit();
            }

        }

        // When save button in the modal is clicked, submit the value
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var checkboxes = document.querySelectorAll('.dish-checkbox');

            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    var selectedCheckboxes = document.querySelectorAll('.dish-checkbox:checked');
                    var category = checkbox.getAttribute('data-category');

                    // Check if the selected count exceeds the maximum allowed for the current category
                    var selectedCheckboxesForCategory = Array.from(selectedCheckboxes).filter(
                        function(checkbox) {
                            return checkbox.getAttribute('data-category') === category;
                        });

                    if (selectedCheckboxesForCategory.length > parseInt(checkbox.getAttribute(
                            'data-max'))) {
                        checkbox.checked = false;
                        // alert('You can only select up to ' + checkbox.getAttribute('data-max') +
                        //     ' items in ' + category + '.');
                        alert('if you want change the selected dish in ' + category +
                            ', kindly unselect the checked dish')
                    }
                });
            });
        });
    </script>

    <script>
        function limitWords(text, limit) {
            var words = text.split(' ');
            if (words.length > limit) {
                return words.slice(0, limit).join(' ') + '...';
            }
            return text;
        }

        document.addEventListener('DOMContentLoaded', function() {
            var checkboxes = document.querySelectorAll('.dish-checkbox');
            var scrolldev = document.querySelector('#scrolldev');
            var tableContainer = document.querySelector('#selected-dishes');
            var saveButton = document.querySelector('#save-button');
            var skipButton = document.querySelector('#skip-button');
            var loader = document.querySelector('#loader'); // Reference to the loader

            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    var selectedCheckboxes = document.querySelectorAll('.dish-checkbox:checked');
                    var isEmpty = selectedCheckboxes.length === 0;
                    loader.style.display = 'block';

                    // Make an AJAX request to update the server with selected dishes data
                    updateSelectedDishes(selectedCheckboxes);
                });
            });

            function updateSelectedDishes(selectedCheckboxes) {
                var selectedDishesIds = Array.from(selectedCheckboxes).map(function(checkbox) {
                    return checkbox.getAttribute('data-id');
                });

                // Make an AJAX request to update the server with selected dishes data
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: "{{ route('menu.getDishes') }}",
                    data: {
                        id: selectedDishesIds
                    },
                    success: function(response) {
                        // Clear the existing table container content
                        tableContainer.innerHTML = '';

                        // Iterate over the response and append rows to the table
                        response.forEach(function(dish) {
                            var newRow = document.createElement('tr');
                            newRow.innerHTML = `<td>
                                                    <div class="media">
                                                        <div class="media-body my-auto">
                                                            <div class="card-item-desc mt-0">
                                                                <h6 class="font-weight-semibold mt-0 text-uppercase">${dish.name}</h6>
                                                                <dl class="card-item-desc-1">
                                                                    <dt><input type="hidden" name="dishid[]"  value="${dish.id}"> ${dish.subcategory.name}</dt>
                                                                    <dd>Price: $${dish.final_price}</dd>
                                                                    <p>${dish.desc}</p>
                                                                </dl>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>`;

                            // Append the new row to the table container
                            tableContainer.appendChild(newRow);
                        });

                        // Show/hide buttons based on whether the table is empty or not
                        if (response.length === 0) {
                            skipButton.style.display = 'block';
                            saveButton.style.display = 'none';
                        } else {
                            skipButton.style.display = 'none';
                            saveButton.style.display = 'block';
                        }
                        loader.style.display = 'none';
                        scrolldev.scrollTop = tableContainer.scrollHeight;

                    },
                    error: function(response) {
                        loader.style.display = 'none';

                    }
                });
            }
        });
    </script>
@endsection
