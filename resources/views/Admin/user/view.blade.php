@extends('Dashboard.Master.master_layout')
@section('title')
    User Detail - EatAnmol
@endsection

@section('stylesheet')
@endsection

@section('content')
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">User Detail</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-user"><a href="{{ route('contact.index') }}">User Detail</a></li>
                <li class="breadcrumb-user active" aria-current="page">User Detail</li>
            </ol>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div>
                        <h6 class="main-content-label mb-1">User Detail</h6>
                        <p class="text-muted card-sub-title"> User with details.</p>
                    </div>
                    <div class="container">

                        <div class="row">
                            <div class="col-md-6">
                                <h2>User Details</h2>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th class="col-sm-4">ID</th>
                                                <td class="col-sm-8">{{ $user->id }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-sm-4">Name</th>
                                                <td class="col-sm-8">{{ $user->name }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-sm-4">Email</th>
                                                <td class="col-sm-8">
                                                    @if ($user->Role == 'Guest')
                                                        N/A
                                                    @else
                                                        <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                                    @endif
                                                </td>


                                            </tr>
                                            <tr>
                                                <th class="col-sm-4">Role</th>
                                                <td class="col-sm-8">{{ $user->Role }}</td>
                                            </tr>

                                            <tr>
                                                <th class="col-sm-4">Phone</th>
                                                <td class="col-sm-8"><a
                                                        href="tel:{{ $user->phone }}">{{ $user->phone }}</a></td>
                                            </tr>
                                            <tr>
                                                <th class="col-sm-4">Google Id</th>
                                                <td class="col-sm-8">{{ $user->google_id }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-sm-4">Twitter Id</th>
                                                <td class="col-sm-8">{{ $user->twitter_id }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-sm-4">Created At</th>

                                                <td class="col-sm-8">
                                                    {{ \Carbon\Carbon::parse($user->created_at)->format('m/d/Y') }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-sm-4">Updated At</th>
                                                <td class="col-sm-8">
                                                    {{ \Carbon\Carbon::parse($user->updated_at)->format('m/d/Y') }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="card custom-card">
                <div class="card-body">
                    <div>
                        <h3 class="my-4">Event History</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table">
                            <thead>
                                <tr>
                                    <th class="wd-lg-10p">Date</th>
                                    <th class="wd-lg-20p">Name</th>
                                    <th class="wd-lg-20p">Guests</th>
                                    {{-- <th class="wd-lg-10p">Type</th> --}}
                                    <th class="wd-lg-10p">Start Time</th>
                                    <th class="wd-lg-10p">End Time</th>
                                    <th class="wd-lg-20p">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user->event as $event)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($event->date)->format('m/d/Y') }}</td>
                                        <td>{{ $event->name }}</td>
                                        <td>{{ $event->guests }}</td>
                                        {{-- <td>{{ $event->type }}</td> --}}
                                        <td>{{ $event->start_time }}</td>
                                        <td>{{ $event->end_time }}</td>
                                        <td class="d-flex"> <a href="{{ route('events.show', encrypt($event->id)) }}"
                                                class="btn btn-main-primary px-3">View</a>
                                            @php

                                                $eventDate = \Carbon\Carbon::parse($event->date);
                                                $oneWeekAgo = \Carbon\Carbon::now()->subWeek(); // Calculate the date one week before today
                                            @endphp

                                            @if ($eventDate->greaterThanOrEqualTo($oneWeekAgo))
                                                @if (Auth::user()->Role != 'Admin')
                                                    <form class="mx-1"
                                                        action="{{ route('continueJourney', ['eventId' => $event->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-primary">
                                                            Continue Journey
                                                        </button>
                                                    </form>
                                                @endif

                                                <div class="dropdown">

                                                    <button class="btn btn-main-primary dropdown-toggle  ms-3"
                                                        type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        Edit
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-light"
                                                        aria-labelledby="dropdownMenuButton2">
                                                        @if ($event->journey->eventid)
                                                            <li><a class="dropdown-item "
                                                                    href="{{ route('events.edit', encrypt($event->journey->eventid)) }}">
                                                                    <i class="fa fa-pencil-alt"></i>
                                                                    Event </a></li>
                                                        @endif
                                                        @if ($event->journey->venueid)
                                                            <li><a class="dropdown-item "
                                                                    href="{{ route('customer-venues.edit', encrypt($event->journey->venueid)) }}">
                                                                    <i class="fa fa-pencil-alt"></i>
                                                                    Venue </a></li>
                                                        @endif
                                                        @if ($event->journey->menu_submit)
                                                            @if (Auth::user()->Role != 'Admin')
                                                                <li><a class="dropdown-item "
                                                                        href="{{ route('events.edit', $event->journey->eventid) }}">
                                                                        <i class="fa fa-pencil-alt"></i>
                                                                        Change Full Menu
                                                                    </a></li>
                                                                <li><a class="dropdown-item "
                                                                        href="{{ route('events.edit', $event->journey->eventid) }}">
                                                                        <i class="fa fa-pencil-alt"></i>
                                                                        Change Form </a>
                                                                </li>
                                                            @endif
                                                            <li><a class="dropdown-item "
                                                                    href="{{ route('events.menu.edit', encrypt($event->journey->menu_submit)) }}">
                                                                    <i class="fa fa-pencil-alt"></i>
                                                                    Change Items </a>
                                                            </li>
                                                        @endif
                                                        @if ($event->journey->service_styling_id)
                                                            <li><a class="dropdown-item "
                                                                    href="{{ route('service.styling.edit', encrypt($event->journey->service_styling_id)) }}">
                                                                    <i class="fa fa-pencil-alt"></i>
                                                                    Service </a></li>
                                                        @endif


                                                    </ul>
                                                </div>
                                                {{-- <a class="btn text-dark px-1" href="{{ route('events.edit', ['encryptedId' => Crypt::encryptString($event->id)]) }}"><i class="fe fe-eye"></i></a> --}}
                                            @else
                                                <p class="ms-3">Event Date Passout</p>
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>

                    <div class="d-flex">
                        <div class="justify-content-center">
                            <a href="{{ route('contact.index') }}" class="btn btn-primary ">
                                Back to User
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

    <script>
        $('#table').DataTable({
            responsive: true,
            language: {
                searchPlaceholder: 'Search...',
                sSearch: '',
                lengthMenu: '_MENU_ items/page',
            },
            order: [
                [0, 'desc']
            ] // Replace 0 with the column index you want to sort by
        });
    </script>
@endsection
