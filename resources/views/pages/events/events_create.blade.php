@extends('Dashboard.Master.master_layout')
@section('title')
    EatAnmol - Event Create
@endsection
@section('stylesheet')
    <style>
        /* Style the input */
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
            /* height: 36px; */
            cursor: pointer;
        }

        .custom-addon i {
            color: #333;
        }

        #placeResults {
            position: absolute;
            width: 100%;
        }

        /* Tooltip container */
        .tooltip {
            position: relative;
            display: inline-block;
            border-bottom: 1px dotted black;
            /* If you want dots under the hoverable text */
        }

        /* Tooltip text */
        .tooltip .tooltiptext {
            visibility: hidden;
            width: 120px;
            background-color: black;
            color: #fff;
            text-align: center;
            padding: 5px 0;
            border-radius: 6px;

            /* Position the tooltip text - see examples below! */
            position: absolute;
            z-index: 1;
        }

        /* Show the tooltip text when you mouse over the tooltip container */
        .tooltip:hover .tooltiptext {
            visibility: visible;
        }

        .datepicker table tr td.disabled,
        .datepicker table tr td.disabled:hover {
            /* background-color: #ddd; */
            /* Grey background for disabled dates */
            color: #dcd3d3;
            /* Darker text color for disabled dates */
        }
    </style>
@endsection

@section('content')
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">Welcome to Eat Anmol</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('events.index') }}">Events</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Events</li>
            </ol>
        </div>
        {{-- <div class="d-flex">
        <a class="btn btn-primary my-2 btn-icon-text" href="{{ route('events.index') }}">
            <i class="fe fe-grid me-2"></i> View All
        </a>
    </div> --}}
    </div>
    <!-- End Page Header -->
    <div class="row row-sm">
        <div class="col-md-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div>
                        <h6 class="main-content-label mb-1">Create Event</h6>
                        <hr />
                    </div>
                    <div class="row row-sm">
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="">
                                <form method="POST" action="{{ route('events.store') }}">
                                    @csrf

                                    <div class="form-group">
                                        <label for="name">Event Name</label>
                                        <input data-toggle="tooltip" data-placement="bottom" placeholder="Birthday Bash"
                                            title="Event Name" class="form-control" id="name" name="name" required
                                            type="text">
                                        <small id="nameError" class="text-danger"></small>
                                    </div>

                                    <div class="form-group">
                                        <label for="guests">Number of Guests</label>
                                        <input data-toggle="tooltip" data-placement="bottom" placeholder="50" min="1"
                                            title="Number Of Guests" class="form-control" id="guests" name="guests"
                                            type="number" required>
                                        <small id="guestsError" class="text-danger"></small>
                                    </div>

                                    <div class="form-group">
                                        <label for="date">Event Date</label>
                                        <div class="input-group">
                                            <div class="input-group-text border-end-0">
                                                <i class="fe fe-calendar lh--9 op-6"></i>
                                            </div>
                                            <input data-toggle="tooltip" data-placement="bottom" placeholder="01/09/2024"
                                                title="Event Date" class="form-control datepicker" data-provide="datepicker"
                                                name="date" autocomplete="off" type="" id="datepickerr" required>
                                        </div>
                                        <small id="dateError" class="text-danger"></small>
                                    </div>

                                    <div class="form-group">
                                        <br>
                                        <label for="start_time">Start Time</label>
                                        <div class="input-group " data-placement="bottom" data-align="top"
                                            data-autoclose="false" data-format="hh:mm">
                                            <input data-toggle="tooltip" data-placement="bottom" placeholder="06:00 PM"
                                                title="Start Time" type="text" id="start_time" name="start_time"
                                                class="form-control  timePicker">
                                            <span class="input-group-addon custom-addon bg-primary">
                                                <i class="fa fa-clock-o text-light" aria-hidden="true"
                                                    style="line-height: 36px;"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <br>
                                        <label for="end_time">End Time</label>
                                        <div class="input-group " data-placement="bottom" data-align="top"
                                            data-autoclose="false" data-format="hh:mm">
                                            <input data-toggle="tooltip" data-placement="bottom" placeholder="10:00 PM"
                                                title="End Time" type="text" id="end_time" name="end_time" required
                                                class="form-control timePicker">
                                            <span class="input-group-addon custom-addon bg-primary">
                                                <i class="fa fa-clock-o text-light" aria-hidden="true"
                                                    style="line-height: 36px;"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="type">Event Type

                                            <button class="btn ripple btn-primary btn-sm" data-bs-container="body"
                                                data-bs-content="Pick up: You will pickup your food,
                                            Drop-off: We will drop-off your food at your provided address,
                                            Setup service: Setup service details...,
                                            Off-premise: Off-premise details...,
                                            Full service: Full service details..."
                                                data-bs-placement="top" data-bs-popover-color="default"
                                                data-bs-toggle="popover" title="Popover top" type="button">
                                                <i class="fa fa-info"></i></button>
                                        </label>
                                        <select class="form-control" required id="type" name="type"
                                            onchange="handleEventTypeChange()">
                                            <option label="Select Event Type"></option>
                                            <option value="Pick up">Pick up </option>
                                            <option value="Drop-off">Drop-off</option>
                                            <option value="Setup service">Setup service</option>
                                            <option value="Off-premise">Off-premise</option>
                                            <option value="Full service">Full service</option>
                                            {{-- <option value="Other">Other</option> --}}
                                        </select>

                                        <small id="typeError" class="text-danger"></small>
                                    </div>

                                    <div class="form-group" style="display: none;" id="locationField">
                                        <label for="location">Location</label>
                                        <select class="form-control" id="location" name="location">
                                            <option value="Milwaukee">Milwaukee</option>
                                            <option value="Naperville">Naperville</option>
                                        </select>
                                        <small id="locationError" class="text-danger"></small>
                                    </div>

                                    <div class="form-group" style="display: none;" id="addressField">
                                        <label for="address">Address</label>
                                        <input data-toggle="tooltip" data-placement="bottom" aria-autocomplete="false"
                                            placeholder="Enter address" title="Address" class="form-control"
                                            autocomplete="false" id="address" name="address" type="text">

                                        <small id="addressError" class="text-danger"></small>
                                    </div>


                                    <div class="form-group" style="display: none;" id="AddressDetails">
                                        <label for="city">City, State, ZipCode</label>
                                        <input data-toggle="tooltip" data-placement="bottom"
                                            placeholder="City, State, 123" title="City" class="form-control"
                                            id="city" name="city" type="text"readonly required>
                                        <small class="error-message" id="city_error"></small>


                                    </div>




                                    <div class="d-flex">
                                        <div class="d-flex justify-content-end w-100">
                                            <div class="d-inline-block my-2">
                                                <button onclick="validateAndSubmit(event, validateForm())"
                                                    class="btn ripple btn-primary" id="submitBtn">Save & Continue</button>
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

@section('js')
    <script>
        $('body').on('click', function(e) {
            $('[data-toggle=popover]').each(function() {
                // hide any open popovers when the anywhere else in the body is clicked
                if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e
                        .target).length === 0) {

                    $(this).popover('hide');
                }
            });
        });
    </script>

    <!-- Load Google Maps API with the provided API key -->
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

                // Display city, state, country, and zip code

                var cityzip = ''; // Declare the variable

                place.address_components.forEach(function(component) {
                    if (component.types.includes('locality')) {
                        cityzip += component.long_name + ', '; // Concatenate locality
                    } else if (component.types.includes('administrative_area_level_1')) {
                        cityzip += component.long_name + ', '; // Concatenate administrative_area_level_1
                    } else if (component.types.includes('postal_code')) {
                        cityzip += component.long_name; // Concatenate postal_code
                    }
                });

                document.getElementById('city').value = cityzip;

            });
        }
    </script>

    <script>
        var currentDate = new Date();
        var oneWeekPrior = new Date(currentDate);
        oneWeekPrior.setDate(currentDate.getDate() + 8);

        var day = oneWeekPrior.getDate();
        var month = oneWeekPrior.getMonth() + 1; // Adding 1 because months are zero-based
        var year = oneWeekPrior.getFullYear();

        // Ensure day and month are formatted with leading zeros if needed
        day = day < 10 ? '0' + day : day;
        month = month < 10 ? '0' + month : month;

        var formattedDate = month + '/' + day + '/' + year;

        document.getElementById('datepickerr').value = formattedDate;


        function handleEventTypeChange() {
            var eventType = document.getElementById('type').value;
            var locationField = document.getElementById('locationField');
            var addressField = document.getElementById('addressField');
            var AddressDetails = document.getElementById('AddressDetails');

            // Reset and hide both fields initially
            locationField.style.display = 'none';
            addressField.style.display = 'none';
            AddressDetails.style.display = 'none';

            // Show the appropriate field based on the selected event type
            if (eventType === 'Pick up') {
                locationField.style.display = 'block';
            } else if (eventType === 'Drop-off') {
                addressField.style.display = 'block';
            }


        }
    </script>
    <script>
        $(document).ready(function() {
            // Add event listener
            // for input leave on start time
            $('#start_time').on('blur', function() {
                validateTime();
            });

            // Add event listener for input leave on end time
            $('#end_time').on('blur', function() {
                validateTime();
            });


            $('.datepicker').datepicker({
                format: 'mm/dd/yyyy',
                startDate: '+8d', // Restrict to one week from the current date
                autoclose: true,
                beforeShowDay: function(date) {
                    // Convert the date to a string in the format mm/dd/yyyy
                    var dateString = (date.getMonth() + 1) + '/' + date.getDate() + '/' + date
                        .getFullYear();

                    // Disable dates before one week from the current date
                    var currentDate = new Date();
                    var oneWeekFromCurrent = new Date(currentDate);
                    oneWeekFromCurrent.setDate(currentDate.getDate() + 7);

                    if (date < oneWeekFromCurrent) {
                        return {
                            tooltip: 'Disabled date',
                            classes: 'disabled-date'
                        };
                    }

                    // Enable other dates
                    return {
                        enabled: true
                    };
                }
            });

            // Add event listener for input leave
            $('#datepickerr').on('blur', function() {
                validateDate();
            });

            $('#datepickerr').on('change', function() {
                validateDate();
            });

        });

        function validateDate() {
            var selectedDate = $('#datepickerr').val();
            var currentDate = new Date();
            var oneWeekFromCurrent = new Date(currentDate);
            oneWeekFromCurrent.setDate(currentDate.getDate() + 7);

            var selectedDateObj = new Date(selectedDate);

            // Perform the validation
            if (selectedDateObj < oneWeekFromCurrent) {
                $('#dateError').text('Please select a date that is at least one week from the current date.');
                return false;
            } else {
                $('#dateError').text('');
                return true;
            }
        }
        $(document).ready(function() {
            $('#start_time').change(function() {
                const startTime = $(this).val();
            });

            // Function to add minutes to a given time
            function addMinutes(time, minutes) {
                const [hours, mins] = time.split(':').map(Number);
                const totalMinutes = hours * 60 + mins + minutes;
                const newHours = Math.floor(totalMinutes / 60);
                const newMins = totalMinutes % 60;

                // Format the result as HH:MM
                return `${String(newHours).padStart(2, '0')}:${String(newMins).padStart(2, '0')}`;
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


        $(document).ready(function() {

            // toggleOtherOccasionInput();
            toggleOtherTypeInput();

        })
    </script>
    <script>
        var firstOpen = true;
        var time;

        $('#start_time').datetimepicker({

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

        $('#end_time').datetimepicker({
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
    </script>
    <script src="../assets/js/popover.js"></script>
@endsection
