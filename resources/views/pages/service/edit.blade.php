@extends('Dashboard.Master.master_layout')
@section('title')
    EatAnmol - Service Style Create
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
            <h2 class="main-content-title tx-24 mg-b-5">Service Style</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('events.index') }}">Events</a></li>
                <li class="breadcrumb-item active" aria-current="page">Service Style</li>
            </ol>
        </div>

    </div>
    <!-- End Page Header -->
    <div class="row row-sm">
        <div class="col-md-12">
            <div class="card custom-card">
                <div class="card-body">

                    <div class="row row-sm">
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="">
                                <form method="POST" action="{{ route('service.update') }}">
                                    @csrf
                                    <div class="row">
                                        <label class="fs-17 fw-bold ps-4">Appetizer</label>
                                        <div class="col-lg-6 form-group">
                                            <label for="start_time">Start Time</label>
                                            <div class="input-group " data-placement="bottom" data-align="top"
                                                data-autoclose="false" data-format="hh:mm">
                                                <input type="hidden" name="eventId" value="{{ $eventId }}">
                                                <input type="hidden" name="serviceId" value="{{ $service->id }}">

                                                <input data-toggle="tooltip" data-placement="bottom" placeholder="06:00 PM"
                                                    title="Start Time" type="text" id="start_time"
                                                    value="{{ $service->appetizer_start_time }}" name="appetizer_start_time"
                                                    class="form-control  timePicker">
                                                <span class="input-group-addon custom-addon bg-primary">
                                                    <i class="fa fa-clock-o text-light" aria-hidden="true"
                                                        style="line-height: 36px;"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 form-group">
                                            <label for="end_time">End Time</label>
                                            <div class="input-group " data-placement="bottom" data-align="top"
                                                data-autoclose="false" data-format="hh:mm">
                                                <input data-toggle="tooltip" data-placement="bottom" placeholder="10:00 PM"
                                                    title="End Time" type="text" id="end_time" name="appetizer_end_time"
                                                    value="{{ $service->appetizer_end_time }}" required
                                                    class="form-control timePicker">
                                                <span class="input-group-addon custom-addon bg-primary">
                                                    <i class="fa fa-clock-o text-light" aria-hidden="true"
                                                        style="line-height: 36px;"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <label class="fs-17 fw-bold ps-4">Main Course</label>
                                        <div class="col-lg-6 form-group">
                                            <label for="main_course_start_time">Start Time</label>
                                            <div class="input-group " data-placement="bottom" data-align="top"
                                                data-autoclose="false" data-format="hh:mm">
                                                <input data-toggle="tooltip" data-placement="bottom" placeholder="06:00 PM"
                                                    title="Start Time" type="text" id="main_course_start_time"
                                                    value="{{ $service->main_course_start_time }}"
                                                    name="main_course_start_time" class="form-control  timePicker">
                                                <span class="input-group-addon custom-addon bg-primary">
                                                    <i class="fa fa-clock-o text-light" aria-hidden="true"
                                                        style="line-height: 36px;"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 form-group">
                                            <label for="main_course_end_time">End Time</label>
                                            <div class="input-group " data-placement="bottom" data-align="top"
                                                data-autoclose="false" data-format="hh:mm">
                                                <input data-toggle="tooltip" data-placement="bottom" placeholder="10:00 PM"
                                                    title="End Time" type="text" id="main_course_end_time"
                                                    value="{{ $service->main_course_end_time }}"
                                                    name="main_course_end_time" required class="form-control timePicker">
                                                <span class="input-group-addon custom-addon bg-primary">
                                                    <i class="fa fa-clock-o text-light" aria-hidden="true"
                                                        style="line-height: 36px;"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <label class="fs-17 fw-bold ps-4">Dessert</label>
                                        <div class="col-lg-6 form-group">
                                            <label for="dessert_start_time">Start Time</label>
                                            <div class="input-group " data-placement="bottom" data-align="top"
                                                data-autoclose="false" data-format="hh:mm">
                                                <input data-toggle="tooltip" data-placement="bottom"
                                                    placeholder="06:00 PM" title="Start Time" type="text"
                                                    id="dessert_start_time" name="dessert_start_time"
                                                    value="{{ $service->dessert_start_time }}"
                                                    class="form-control  timePicker">
                                                <span class="input-group-addon custom-addon bg-primary">
                                                    <i class="fa fa-clock-o text-light" aria-hidden="true"
                                                        style="line-height: 36px;"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 form-group">
                                            <label for="dessert_end_time">End Time</label>
                                            <div class="input-group " data-placement="bottom" data-align="top"
                                                data-autoclose="false" data-format="hh:mm">
                                                <input data-toggle="tooltip" data-placement="bottom"
                                                    placeholder="10:00 PM" title="End Time" type="text"
                                                    id="dessert_end_time" name="dessert_end_time" required
                                                    value="{{ $service->dessert_end_time }}"
                                                    class="form-control timePicker">
                                                <span class="input-group-addon custom-addon bg-primary">
                                                    <i class="fa fa-clock-o text-light" aria-hidden="true"
                                                        style="line-height: 36px;"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <label class="fs-17 fw-bold ps-4">Hot O'Dourves</label>
                                        <div class="col-lg-6 form-group">
                                            <label for="butler_style_start_time">Start Time</label>
                                            <div class="input-group " data-placement="bottom" data-align="top"
                                                data-autoclose="false" data-format="hh:mm">
                                                <input data-toggle="tooltip" data-placement="bottom"
                                                    placeholder="06:00 PM" title="Start Time" type="text"
                                                    value="{{ $service->butler_style_start_time }}"
                                                    id="butler_style_start_time" name="butler_style_start_time"
                                                    class="form-control  timePicker">
                                                <span class="input-group-addon custom-addon bg-primary">
                                                    <i class="fa fa-clock-o text-light" aria-hidden="true"
                                                        style="line-height: 36px;"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 form-group">
                                            <label for="butler_style_end_time">End Time</label>
                                            <div class="input-group " data-placement="bottom" data-align="top"
                                                data-autoclose="false" data-format="hh:mm">
                                                <input data-toggle="tooltip" data-placement="bottom"
                                                    placeholder="10:00 PM" title="End Time" type="text"
                                                    value="{{ $service->butler_style_end_time }}"
                                                    id="butler_style_end_time" name="butler_style_end_time" required
                                                    class="form-control timePicker">
                                                <span class="input-group-addon custom-addon bg-primary">
                                                    <i class="fa fa-clock-o text-light" aria-hidden="true"
                                                        style="line-height: 36px;"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <label class="fs-17 fw-bold ps-4">Cold O'Dourves</label>
                                        <div class="col-lg-6 form-group">
                                            <label for="butler_style_start_time_1">Start Time</label>
                                            <div class="input-group " data-placement="bottom" data-align="top"
                                                data-autoclose="false" data-format="hh:mm">
                                                <input data-toggle="tooltip" data-placement="bottom"
                                                    placeholder="06:00 PM" title="Start Time" type="text"
                                                    value="{{ $service->butler_style_start_time_1 }}"
                                                    id="butler_style_start_time_1" name="butler_style_start_time_1"
                                                    class="form-control  timePicker">
                                                <span class="input-group-addon custom-addon bg-primary">
                                                    <i class="fa fa-clock-o text-light" aria-hidden="true"
                                                        style="line-height: 36px;"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 form-group">
                                            <label for="butler_style_end_time_1">End Time</label>
                                            <div class="input-group " data-placement="bottom" data-align="top"
                                                data-autoclose="false" data-format="hh:mm">
                                                <input data-toggle="tooltip" data-placement="bottom"
                                                    placeholder="10:00 PM" title="End Time" type="text"
                                                    value="{{ $service->butler_style_end_time_1 }}"
                                                    id="butler_style_end_time_1" name="butler_style_end_time_1" required
                                                    class="form-control timePicker">
                                                <span class="input-group-addon custom-addon bg-primary">
                                                    <i class="fa fa-clock-o text-light" aria-hidden="true"
                                                        style="line-height: 36px;"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="d-flex justify-content-end w-100">
                                            <div class="d-inline-block my-2">
                                                <button class="btn ripple btn-primary" id="submitBtn">Save &
                                                    Continue</button>
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
@endsection

@section('js')
    <script>
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
        $('#main_course_start_time').datetimepicker({
            useCurrent: false,
            format: "hh:mm A",
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            }
        }).on('dp.show', function() {
            // Your logic for start time picker
        });

        // For Main Course end time
        $('#main_course_end_time').datetimepicker({
            useCurrent: false,
            format: "hh:mm A",
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            }
        }).on('dp.show', function() {
            // Your logic for end time picker
        });

        // For Dessert start time
        $('#dessert_start_time').datetimepicker({
            useCurrent: false,
            format: "hh:mm A",
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            }
        }).on('dp.show', function() {
            // Your logic for dessert start time picker
        });

        // For Dessert end time
        $('#dessert_end_time').datetimepicker({
            useCurrent: false,
            format: "hh:mm A",
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            }
        }).on('dp.show', function() {
            // Your logic for dessert end time picker
        });
        // For Dessert start time
        $('#butler_style_start_time').datetimepicker({
            useCurrent: false,
            format: "hh:mm A",
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            }
        }).on('dp.show', function() {
            // Your logic for butler_style start time picker
        });

        // For Butler_style end time
        $('#butler_style_end_time').datetimepicker({
            useCurrent: false,
            format: "hh:mm A",
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            }
        }).on('dp.show', function() {
            // Your logic for butler_style end time picker
        });
        $('#butler_style_start_time_1').datetimepicker({
            useCurrent: false,
            format: "hh:mm A",
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            }
        }).on('dp.show', function() {
            // Your logic for butler_style start time picker
        });

        // For Butler_style end time
        $('#butler_style_end_time_1').datetimepicker({
            useCurrent: false,
            format: "hh:mm A",
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            }
        }).on('dp.show', function() {
            // Your logic for butler_style end time picker
        });
    </script>
@endsection
