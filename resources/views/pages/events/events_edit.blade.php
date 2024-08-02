@extends('Dashboard.Master.master_layout')
@section('title')
    Edit Events - EatAnmol
@endsection
@section('stylesheet')
    <style>
        .custom-input {
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 10px;
            width: 100%;
            height: 36px;
            font-size: 14px;
        }

        .custom-addon {
            border: 1px solid #ccc;
            border-left: none;
            border-radius: 4px;
            padding-right: 10px;
            padding-left: 10px;
            cursor: pointer;
        }

        .custom-addon i {
            color: #333;
        }
    </style>
@endsection


@section('content')
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">Edit Event</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('events.index') }}">Events</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Event</li>
            </ol>
        </div>
        {{-- <div class="d-flex">

        <a  class="btn btn-primary my-2 btn-icon-text" href="{{ route('events.index') }}">
            <i class="fe fe-grid me-2"></i> View All
        </a>
    </div> --}}
    </div>
    <!-- End Page Header -->
    <div class="row row-sm">
        <div class="col-md-12">
            <div class="card custom-card">
                <div class="card-body">
                    {{-- <div>
                        <h6 class="main-content-label mb-1">Edit Event</h6>
                        <p class="text-muted card-sub-title">Edit an existing event with type  selection.</p>
                    </div> --}}
                    <div class="row row-sm">
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="">
                                <form method="POST" id="myForm"
                                    action="{{ route('events.update', ['eventId' => $eventId]) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="name">Event Name</label>
                                        <input data-toggle="tooltip" data-placement="bottom" title="Event Name"
                                            class="form-control" id="name" name="name" required type="text"
                                            placeholder="E.g., Anniversary Celebration" value="{{ $event->name }}">
                                        <small id="nameError" class="text-danger"></small>
                                    </div>

                                    <div class="form-group">
                                        <label for="guests">Number of Guests</label>
                                        <input data-toggle="tooltip" data-placement="bottom" title="Number Of Guests"
                                            class="form-control" id="guests" name="guests" type="number" required
                                            placeholder="E.g., 50" value="{{ $event->guests }}">
                                        <small id="guestsError" class="text-danger"></small>
                                    </div>

                                    <div class="form-group">
                                        <label for="date">Event Date</label>
                                        <div class="input-group">
                                            <div class="input-group-text border-end-0">
                                                <i class="fe fe-calendar lh--9 op-6"></i>
                                            </div>
                                            <input data-toggle="tooltip" data-placement="bottom" title="Event Date"
                                                class="form-control datepicker" data-provide="datepicker" type="text"
                                                id="datepickerr" name="date" placeholder="Select event date"
                                                value="{{ $event->date }}">

                                        </div>
                                        <small id="dateError" class="text-danger"></small>
                                    </div>

                                    <div class="form-group">
                                        <br>
                                        <label for="start_time">Start Time</label>
                                        <div class="input-group date" id="timePicker">
                                            <input data-toggle="tooltip" data-placement="bottom" title="Start Time"
                                                type="text" id="start_time" name="start_time" placeholder="E.g., 6:00 PM"
                                                class="form-control input-group-addon timePicker"
                                                value="{{ $event->start_time }}">

                                            <span class="input-group-addon custom-addon bg-primary">
                                                <i class="fa fa-clock-o text-light" aria-hidden="true"
                                                    style="line-height: 36px;"></i>
                                            </span>
                                        </div>
                                        <small id="startTimeError" class="text-danger"></small>
                                    </div>

                                    <div class="form-group">
                                        <br>
                                        <label for="end_time">End Time</label>
                                        <div class="input-group date" id="endTimePicker">
                                            <input data-toggle="tooltip" data-placement="bottom" title="End Time"
                                                type="text" id="end_time" name="end_time" required
                                                placeholder="E.g., 10:00 PM"
                                                class="form-control input-group-addon timePicker"
                                                value="{{ $event->end_time }}">

                                            <span class="input-group-addon custom-addon bg-primary">
                                                <i class="fa fa-clock-o text-light" aria-hidden="true"
                                                    style="line-height: 36px;"></i>
                                            </span>
                                        </div>
                                        <small id="endTimeError" class="text-danger"></small>
                                    </div>

                                    <div class="form-group">
                                        <label for="type">Event Type</label>
                                        <select class="form-control" required id="type" name="type"
                                            onchange="handleEventTypeChange()">
                                            <option label="Select Event Type"></option>
                                            <option value="Pick up" @if ($event->type === 'Pick up') selected @endif>Pick
                                                up</option>
                                            <option value="Drop-off" @if ($event->type === 'Drop-off') selected @endif>
                                                Drop-off</option>
                                            <option value="Setup service"
                                                @if ($event->type === 'Setup service') selected @endif>Setup service</option>
                                            <option value="Off-premise" @if ($event->type === 'Off-premise') selected @endif>
                                                Off-premise</option>
                                            <option value="Full service" @if ($event->type === 'Full service') selected @endif>
                                                Full service</option>
                                            {{-- <option value="Other" @if ($event->type === 'Other') selected @endif>Other</option> --}}
                                        </select>
                                        <small id="typeError" class="text-danger"></small>
                                    </div>



                                    <div class="form-group" style="display: none;" id="locationField">
                                        <label for="location">Event Location</label>
                                        <select class="form-control" id="location" name="location">
                                            <option value="Milwaukee" @if ($event->location === 'Milwaukee') selected @endif>
                                                Milwaukee</option>
                                            <option value="Naperville" @if ($event->location === 'Naperville') selected @endif>
                                                Naperville</option>
                                        </select>
                                        <small id="locationError" class="text-danger"></small>
                                    </div>

                                    <div class="form-group" style="display: none;" id="addressField">
                                        <label for="address">Event Address</label>
                                        <input data-toggle="tooltip" data-placement="bottom" title="Event Address"
                                            class="form-control" id="address" name="address" type="text"
                                            placeholder="E.g., 123 Main St" value="{{ $event->address }}">
                                        <select id="placeResults" size="5" style="display: none;"></select>
                                        <small id="addressError" class="text-danger"></small>
                                    </div>
                                    <div class="form-group" style="display: none;" id="AddressDetails">
                                        <label for="City" id="CityLabel">City</label>
                                        <input data-toggle="tooltip" data-placement="bottom" disabled
                                            class="form-control" id="City" type="text">

                                        <label for="State" id="StateLabel">State</label>
                                        <input data-toggle="tooltip" data-placement="bottom" disabled
                                            class="form-control" id="State" type="text">

                                        <label for="ZipCode" id="ZipCodeLabel">Zip Code</label>
                                        <input data-toggle="tooltip" data-placement="bottom" disabled
                                            class="form-control" id="ZipCode" type="text">

                                        <label for="Country" id="CountryLabel">Country</label>
                                        <input data-toggle="tooltip" data-placement="bottom" disabled
                                            class="form-control" id="Country" type="text">

                                    </div>

                                    <div class="form-group" style="display: none;" id="otherTypeField">
                                        <label for="otherType">Other Event Type</label>
                                        <input data-toggle="tooltip" data-placement="bottom" title="Other Event Type"
                                            class="form-control" id="otherType" name="otherType" type="text"
                                            placeholder="E.g., Corporate Meeting"
                                            value="{{ $event->type_id === null ? $event->type : '' }}">
                                        <small id="otherTypeError" class="text-danger"></small>
                                    </div>
                                    @if (Auth::user()->Role == 'Admin')
                                        <div class="form-group" id="status">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="1" {{ $event->status == 1 ? 'selected' : '' }}>
                                                    Prospect
                                                </option>
                                                <option value="2" {{ $event->status == 2 ? 'selected' : '' }}>
                                                    Definite
                                                </option>
                                                <option value="3" {{ $event->status == 3 ? 'selected' : '' }}>Lost
                                                </option>
                                                <option value="4" {{ $event->status == 4 ? 'selected' : '' }}>
                                                    Tentative
                                                </option>
                                                <option value="5" {{ $event->status == 5 ? 'selected' : '' }}>Close
                                                </option>
                                                <option value="6" {{ $event->status == 6 ? 'selected' : '' }}>
                                                    Waitlist
                                                </option>
                                            </select>
                                            <small id="statusError" class="text-danger"></small>
                                        </div>
                                    @endif


                                    <div class="d-flex">
                                        <div class="d-flex justify-content-end w-100">
                                            <div class="d-inline-block my-2">
                                                <button class="btn ripple btn-main-primary d-inline-block"
                                                    onclick="validateForm()" id="submitBtn">Edit</button>
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
    </div>

    <div style="display: none;" id="map"></div>
@endsection

<?php
// Assuming this is PHP code
// if (Auth::user()->Role == "Admin") {
//     echo '<script>
//         document.addEventListener("DOMContentLoaded", function() {
//             var form = document.getElementById("myForm");
//             var elements = form.elements;

//             for (var i = 0; i < elements.length; i++) {
//                 elements[i].disabled = true;
//             }
//         });
//     </script>';
// }
?>


@section('js')
    <script async
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_API_KEY') }}&loading=async&libraries=places&callback=initMap">
    </script>

    <script>
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: -34.397,
                    lng: 150.644
                },
                zoom: 8
            });

            var input = document.getElementById('address');
            var autocomplete = new google.maps.places.Autocomplete(input, {
                componentRestrictions: {
                    country: 'US'
                } // Restrict results to the United States
            });
            autocomplete.addListener('place_changed', function() {
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    window.alert("No details available for input: '" + place.name + "'");
                    return;
                }

                // Clear previous markers on the map
                map.setZoom(17);
                map.setCenter(place.geometry.location);


                document.getElementById('AddressDetails').style.display = 'block';

                // Display address components
                console.log("Place :", place);
                console.log("Place Name:", place.name);
                console.log("Place Address:", place.formatted_address);

                // Display city, state, country, and zip code
                place.address_components.forEach(function(component) {
                    console.log("Street Address:", component.long_name);

                    if (component.types.includes('locality')) {
                        console.log("City:", component.long_name);
                        // Show the field
                        document.getElementById('City').style.display = 'block';
                        document.getElementById('CityLabel').style.display = 'block';
                        // Assign city value
                        document.getElementById('City').value = component.long_name;
                    } else if (component.types.includes('administrative_area_level_1')) {
                        console.log("State:", component.short_name);
                        // Show the field
                        document.getElementById('State').style.display = 'block';
                        document.getElementById('StateLabel').style.display = 'block';
                        // Assign state value
                        document.getElementById('State').value = component.long_name;
                    } else if (component.types.includes('country')) {
                        console.log("Country:", component.long_name);
                        // Show the field
                        document.getElementById('Country').style.display = 'block';
                        document.getElementById('CountryLabel').style.display = 'block';
                        // Assign country value
                        document.getElementById('Country').value = component.long_name;
                    } else if (component.types.includes('postal_code')) {
                        console.log("Zip Code:", component.long_name);
                        // Show the field
                        document.getElementById('ZipCode').style.display = 'block';
                        document.getElementById('ZipCodeLabel').style.display = 'block';
                        document.getElementById('ZipCode').value = component.long_name;
                    } else {
                        // Hide all fields if none of the conditions are met
                        document.getElementById('City').style.display = 'none';
                        document.getElementById('CityLabel').style.display = 'none';
                        document.getElementById('State').style.display = 'none';
                        document.getElementById('StateLabel').style.display = 'none';
                        document.getElementById('Country').style.display = 'none';
                        document.getElementById('CountryLabel').style.display = 'none';
                        document.getElementById('ZipCode').style.display = 'none';
                        document.getElementById('ZipCodeLabel').style.display = 'none';
                    }
                });

            });
        }
    </script>
    <script>
        function handleEventTypeChange() {
            var eventType = document.getElementById('type').value;

            // Show/hide relevant fields based on the selected event type
            if (eventType === 'Pick up') {
                document.getElementById('locationField').style.display = 'block';
                document.getElementById('addressField').style.display = 'none';
                document.getElementById('AddressDetails').style.display = 'none';
                document.getElementById('otherTypeField').style.display = 'none';
            } else if (eventType === 'Drop-off') {
                document.getElementById('locationField').style.display = 'none';
                document.getElementById('addressField').style.display = 'block';
                document.getElementById('otherTypeField').style.display = 'none';
            } else if (eventType === 'Other') {
                document.getElementById('locationField').style.display = 'none';
                document.getElementById('addressField').style.display = 'none';
                document.getElementById('AddressDetails').style.display = 'none';
                document.getElementById('otherTypeField').style.display = 'block';
            } else {
                document.getElementById('locationField').style.display = 'none';
                document.getElementById('addressField').style.display = 'none';
                document.getElementById('AddressDetails').style.display = 'none';
                document.getElementById('otherTypeField').style.display = 'none';
            }
        }

        // Call the function initially to set the initial state based on the event type
        handleEventTypeChange();
    </script>
    <script>
        function validateTime() {
            console.log('works')
            var startTime = $("#start_time").val();
            var endTime = $("#end_time").val();
            // if start time and end time are are it should set strattimeError | endTimeError and return false
            if (startTime == "" || endTime == "") {
                document.getElementById('startTimeError').textContent = 'Start Time is required';
                document.getElementById('endTimeError').textContent = 'End Time is required';
                return false;
            } else if ((moment(startTime, "HH:mm A").format("HH:MM") == moment(endTime, "HH:mm A").format("HH:MM"))) {
                document.getElementById('startTimeError').textContent = 'start and end time can not be equal';
                document.getElementById('endTimeError').textContent = 'start and end time can not be equal';
                return false;
            }
            return true;

        }
        $(document).ready(function() {
            // Add event listener for input leave on start time
            $('#start_time').on('blur', function() {
                // validateTime();
            });

            // Add event listener for input leave on end time
            $('#end_time').on('blur', function() {
                validateTime();
            });


            //    function validateTime() {
            //        var startTime = $('#start_time').val();
            //        var endTime = $('#end_time').val();

            //        // Parse the time strings to Date objects
            //        var startDate = new Date("2000-01-01 " + startTime);
            //        var endDate = new Date("2000-01-01 " + endTime);

            //        // Perform the validation
            //        if (startDate >= endDate) {
            //            $('#startTimeError').text('Start time must be smaller than end time');
            //            $('#endTimeError').text('End time must be greater than start time');
            //        } else {
            //            $('#startTimeError').text('');
            //            $('#endTimeError').text('');
            //        }
            //    }
            $('.datepicker').datepicker({
                format: 'mm/dd/yyyy',
                startDate: '+8d', // Restrict to one week prior to the current date
                autoclose: true
            });

            // Add event listener for input leave
            $('#datepickerr').on('blur', function() {
                validateDate();
            });
            $('#datepickerr').on('change', function() {
                validateDate();
            });

            function validateDate() {
                var selectedDate = $('#datepickerr').val();
                var currentDate = new Date();
                var oneWeekPrior = new Date(currentDate);
                oneWeekPrior.setDate(currentDate.getDate() + 7);

                var selectedDateObj = new Date(selectedDate);

                // Perform the validation
                if (selectedDateObj < oneWeekPrior) {
                    $('#dateError').text('Please select a date that is at least one week from the current date.');
                } else {
                    $('#dateError').text('');
                }
            }
        });
    </script>
    <script>
        var controls = {
            leftArrow: '<i class="fa fa-angle-left" style="font-size: 1.25rem"></i>',
            rightArrow: '<i class="fa fa-angle-right" style="font-size: 1.25rem"></i>'
        }

        $(document).ready(function() {
            $('#datepickerr').datepicker({
                todayHighlight: true,
                orientation: "bottom left",
                templates: controls
            });
        })

        // var otherOccasionInput = document.getElementById('otherOccasionInput');
        // if (document.getElementById('occasion').value !== 'Other') {
        //     otherOccasionInput.style.display = 'none';
        // }else{
        //     otherOccasionInput.style.display = 'block';
        // }

        // document.getElementById('occasion').addEventListener('change', function () {
        //     var otherOccasionInput = document.getElementById('otherOccasionInput');
        //     if (this.value === 'Other') {
        //         otherOccasionInput.style.display = 'block';
        //     } else {
        //         otherOccasionInput.style.display = 'none';
        //     }
        // });

        // Initially, hide "Other Type" field when "Type" is not "Other"
        var otherTypeField = document.getElementById('otherTypeField');
        if (document.getElementById('type').value !== 'Other') {
            otherTypeField.style.display = 'none';
        } else {
            otherTypeField.style.display = 'block';

        }

        document.getElementById('type').addEventListener('change', function() {
            var otherTypeField = document.getElementById('otherTypeField');
            if (this.value === 'Other') {
                otherTypeField.style.display = 'block';
            } else {
                otherTypeField.style.display = 'none';
            }
        });




        var firstOpen = true;
        var time;

        $('#timePicker').datetimepicker({
            useCurrent: false,
            format: "hh:mm A",
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            }
        }).on('dp.show', function() {
            if (firstOpen) {
                time = moment().startOf('day');
                firstOpen = false;
            } else {
                time = "01:00 PM"
            }
            $(this).data('DateTimePicker').date(time);
        });

        var endfirstOpen = true;
        var endtime;

        $('#endTimePicker').datetimepicker({
            useCurrent: false,
            format: "hh:mm A",
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            }
        }).on('dp.show', function() {
            if (endfirstOpen) {
                endtime = moment().startOf('day');
                endfirstOpen = false;
            } else {
                endtime = "01:00 PM"
            }
            $(this).data('DateTimePicker').date(endtime);
        });
    </script>
    <script>
        $('input').on('blur', function() {
            validateForm();
        });

        function validateForm() {
            // console.log("works");
            // Reset error messages
            document.getElementById('nameError').textContent = '';
            document.getElementById('guestsError').textContent = '';
            document.getElementById('dateError').textContent = '';
            document.getElementById('startTimeError').textContent = '';
            document.getElementById('endTimeError').textContent = '';
            document.getElementById('typeError').textContent = '';
            document.getElementById('otherTypeError').textContent = '';
            // document.getElementById('occasionError').textContent = '';
            // document.getElementById('otherOccasionError').textContent = '';

            // Retrieve form field values
            const name = document.getElementById('name').value;
            const guests = document.getElementById('guests').value;
            // const date = document.getElementById('datepicker').value;
            const startTime = document.getElementById('start_time').value;
            const endTime = document.getElementById('end_time').value;
            const type = document.getElementById('type').value;
            const otherType = document.getElementById('otherType').value;
            // const occasion = document.getElementById('occasion').value;
            // const otherOccasion = document.getElementById('otherOccasion').value;

            let isValid = true;

            // Perform validation checks
            if (name.trim() === '' || /^\s+$/.test(name)) {
                document.getElementById('nameError').textContent = 'Name is required';
                isValid = false;
            }
            const specialChars = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
            if (specialChars.test(name)) {
                document.getElementById('nameError').textContent = 'Cannot contain special characters';

            }
            if (guests <= 0) {
                document.getElementById('guestsError').textContent = 'Number of Guests must be a positive number';
                isValid = false;
            }

            if (!isValid) {
                return false;
            }

            return true;
        }
    </script>
@endsection
