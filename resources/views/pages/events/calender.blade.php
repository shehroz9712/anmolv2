@extends('Dashboard.Master.master_layout')
@section('title')
    Event Calender - EatAnmol
@endsection
@section('content')
    <style>
        #calendar-container {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }

        .fc-header-toolbar {
            /*
                                                                                                                the calendar will be butting up against the edges,
                                                                                                                but let's scoot in the header's buttons
                                                                                                                */
            padding-top: 1em;
            padding-left: 1em;
            padding-right: 1em;
        }

        .fc-event-title.fc-sticky {
            text-wrap: pretty;
        }
    </style>

    </style>
    <!-- Main Content-->
    <div class="main-container container-fluid">
        <div class="inner-body">
            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Calender</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>

                        <li class="breadcrumb-item active" aria-current="page">Calender</li>
                    </ol>
                </div>
            </div>
            <!-- End Row -->
            <div class="row mb-3">
                <div class="col-lg-12">
                    <div class="card  overflow-hidden">

                        <div class="card-body ps-0">
                            <div class="row">
                                <div class="col-lg-3 ms-3">
                                    <div class="form-group">
                                        <label for="type">Event Type</label>
                                        <select class="form-control" required id="type" name="type">
                                            <option label="Select Event Type"></option>
                                            <option value="all" {{ (isset($type) && $type == 'all') ? 'selected' : '' }}>All</option>

                                            <option value="Pick up" {{ (isset($type) && $type == 'Pick up') ? 'selected' : '' }}>Pick up</option>
                                            <option value="Drop-off" {{ (isset($type) && $type == 'Drop-off') ? 'selected' : '' }}>Drop-off</option>
                                            <option value="Setup service" {{ (isset($type) && $type == 'Setup service') ? 'selected' : '' }}>Setup service</option>
                                            <option value="Off-premise" {{ (isset($type) && $type == 'Off-premise') ? 'selected' : '' }}>Off-premise</option>
                                            <option value="Full service" {{ (isset($type) && $type == 'Full service') ? 'selected' : '' }}>Full service</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id='calendar'></div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Row end -->
    </div>
    <!-- End Main Content-->
@endsection
@section('js')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.13/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var currentDate = new Date();
            var currentDateString = currentDate.toISOString().slice(0, 10);

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                height: 'auto',
                selectMirror: true,
                nowIndicator: true,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                },
                initialDate: currentDateString,
                navLinks: true,
                businessHours: true,
                selectable: true,
                events: @json($appointments),
                eventClick: function(info) {
                    // Dispose of any existing popover
                    $('.popover').popover('dispose');

                    // Create a new popover
                    var content = info.event.extendedProps.fullMessage || 'No additional details';

                    var popover = new bootstrap.Popover(info.el, {
                        title: info.event.extendedProps.event_title,
                        content: content,
                        html: true,
                        placement: 'top',
                        trigger: 'manual' // Use manual trigger for more control
                    });

                    // Show the popover
                    popover.show();

                    // Function to handle click outside
                    function handleClickOutside(event) {
                        if (!info.el.contains(event.target) && !document.querySelector('.popover').contains(event.target)) {
                            popover.hide();
                            document.removeEventListener('click', handleClickOutside);
                        }
                    }

                    // Attach event listener to document to handle click outside
                    document.addEventListener('click', handleClickOutside);
                }
            });

            calendar.render();
        });
    </script>

   <script>
    document.addEventListener('DOMContentLoaded', function() {
        var eventTypeSelect = document.getElementById('type');

        eventTypeSelect.addEventListener('change', function() {
            var selectedType = this.value;

            if (selectedType) {
                // Use the Laravel route() function to generate the route URL
                var url = "{{ route('calender.index', ':type') }}";

                // Replace the placeholder with the selected event type
                url = url.replace(':type', encodeURIComponent(selectedType));

                // Redirect to the constructed URL
                window.location.href = url;
            }
        });
    });
</script>
@endsection
