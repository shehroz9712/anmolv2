@extends('Dashboard.Master.master_layout')
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
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0)">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Calender</li>
                    </ol>
                </div>
            </div>
            <!-- End Row -->
            <div class="row mb-3">
                <div class="col-lg-12">
                    <div class="card  overflow-hidden">

                        <div class="card-body ps-0">
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
                navLinks: true, // can click day/week names to navigate views
                businessHours: true, // display business hours
                // editable: true,
                selectable: true,
                events: @json($appointments),
                eventClick: function(info) {
                    // Destroy existing popovers
                    $('.popover').popover('dispose');

                    // Create popover content
                    var content = info.event.extendedProps.fullMessage || 'No additional details';

                    // Use Bootstrap's popover
                    var popover = new bootstrap.Popover(info.el, {
                        title: info.event.title,
                        content: content,
                        html: true, // Allow HTML content
                        placement: 'top',
                        trigger: 'focus'
                    });

                    // Show the popover
                    popover.show();
                }

            });
            calendar.render();
        });

    </script>

@endsection
