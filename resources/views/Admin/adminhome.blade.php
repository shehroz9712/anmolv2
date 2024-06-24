@extends('Dashboard.Master.master_layout')
@section('title')
    Dashboard - EatAnmol
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
    </style>

    </style>
    <!-- Main Content-->
    <div class="main-container container-fluid">
        <div class="inner-body">
            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Welcome To Dashboard</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0)">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </div>
            </div>
            <!-- Row -->
            <div class="row row-sm">
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="card-order ">
                                <label class="main-content-label mb-3 pt-1">Total Users</label>
                                <h2 class="text-end card-item-icon card-icon">
                                    <i class="mdi mdi-account-multiple icon-size float-start text-primary"></i><span
                                        class="font-weight-bold">{{ $users }}</span>
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- COL END -->
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="card-order">
                                <label class="main-content-label mb-3 pt-1">Total Sales (Monthly)</label>
                                <h2 class="text-end"><i class="mdi mdi-cube icon-size float-start text-primary"></i><span
                                        class="font-weight-bold">$89,265</span></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- COL END -->
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="card-order">
                                <label class="main-content-label mb-3 pt-1">Monthly Event / Bookings</label>
                                <h2 class="text-end"><i
                                        class="icon-size mdi mdi-poll-box   float-start text-primary"></i><span
                                        class="font-weight-bold">{{ $event_count }}</span></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- COL END -->
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="card-order">
                                <label class="main-content-label mb-3 pt-1">Today Event / Bookings</label>
                                <h2 class="text-end"><i class="mdi mdi-cart icon-size float-start text-primary"></i><span
                                        class="font-weight-bold">{{ $today_count }}</span></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- COL END -->
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
            <!-- End Page Header -->
            <!--Row-->
            <div class="row row-sm">
                <div class="col-sm-12 col-lg-12 ">
                    <!--Row-->

                    <!--End row-->
                    <!--row-->
                    <div class="row row-sm">
                        <div class="col-sm-12 col-lg-12 col-xl-12">
                            <div class="card custom-card overflow-hidden">

                                <div class="card-body ps-0">
                                    <div class="row row-sm">
                                        <div class="col-lg-12">
                                            <div class="card custom-card p-3 mg-b-20">
                                                <div class="card-header">
                                                    <h6><b>Events</b></h6>
                                                </div>
                                                <div class="card-body p-0 pt-3">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered" id="example2">
                                                            <thead>
                                                                <tr>
                                                                    {{-- <th class="wd-lg-10p">ID</th> --}}
                                                                    <th class="wd-lg-20p">Name</th>
                                                                    <th class="wd-lg-20p">guests</th>
                                                                    <th class="wd-lg-10p">Date</th>
                                                                    <th class="wd-lg-10p">Type</th>
                                                                    {{-- <th class="wd-lg-10p">Occasion</th> --}}
                                                                    {{-- <th class="wd-lg-10p">Start Time</th>
                                                <th class="wd-lg-10p">End Time</th> --}}
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($events as $event)
                                                                    <tr>
                                                                        {{-- <td>{{ $event->id }}</td> --}}
                                                                        <td>{{ $event->name }}</td>
                                                                        <td>{{ $event->guests }}</td>
                                                                        {{-- <td>{{ $event->date }}</td> --}}
                                                                        <td>{{ \Carbon\Carbon::parse($event->date)->format('m/d/Y') }}
                                                                        </td>
                                                                        <td>{{ $event->type }}</td>
                                                                        {{-- <td>{{ $event->occasion }}</td> --}}
                                                                        {{-- <td>{{ $event->start_time }}</td>
                                                    <td>{{ $event->end_time }}</td> --}}


                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- col end -->
                        <div class="col-sm-12 col-lg-12 col-xl-6 mt-xl-6">
                            <div class="card custom-card card-dashboard-calendar pb-0">
                                <label class="main-content-label mb-2 pt-1">Recent transcations</label>
                                <span class="d-block tx-12 mb-2 text-muted">Projects where development work is on
                                    completion</span>
                                <table class="table table-hover m-b-0 transcations mt-2">
                                    <tbody>
                                        <tr>
                                            <td class="wd-5p">
                                                <div class="main-img-user avatar-md">
                                                    <img alt="avatar" class="rounded-circle me-3"
                                                        src="../assets/img/users/5.jpg">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-middle ms-3">
                                                    <div class="d-inline-block">
                                                        <h6 class="mb-1">Flicker</h6>
                                                        <p class="mb-0 tx-13 text-muted">App improvement</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end">
                                                <div class="d-inline-block">
                                                    <h6 class="mb-2 tx-15 font-weight-semibold">$45.234 <i
                                                            class="fas fa-level-up-alt ms-2 text-success m-l-10"></i>
                                                    </h6>
                                                    <p class="mb-0 tx-11 text-muted">12 Jan 2020</p>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="wd-5p">
                                                <div class="main-img-user avatar-md">
                                                    <img alt="avatar" class="rounded-circle me-3"
                                                        src="../assets/img/users/6.jpg">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-middle ms-3">
                                                    <div class="d-inline-block">
                                                        <h6 class="mb-1">Intoxica</h6>
                                                        <p class="mb-0 tx-13 text-muted">Milestone</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end">
                                                <div class="d-inline-block">
                                                    <h6 class="mb-2 tx-15 font-weight-semibold">$23.452 <i
                                                            class="fas fa-level-down-alt ms-2 text-danger m-l-10"></i>
                                                    </h6>
                                                    <p class="mb-0 tx-11 text-muted">23 Jan 2020</p>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="wd-5p">
                                                <div class="main-img-user avatar-md">
                                                    <img alt="avatar" class="rounded-circle me-3"
                                                        src="../assets/img/users/7.jpg">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-middle ms-3">
                                                    <div class="d-inline-block">
                                                        <h6 class="mb-1">Digiwatt</h6>
                                                        <p class="mb-0 tx-13 text-muted">Sales executive</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end">
                                                <div class="d-inline-block">
                                                    <h6 class="mb-2 tx-15 font-weight-semibold">$78.001 <i
                                                            class="fas fa-level-down-alt ms-2 text-danger m-l-10"></i>
                                                    </h6>
                                                    <p class="mb-0 tx-11 text-muted">4 Apr 2020</p>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="wd-5p">
                                                <div class="main-img-user avatar-md">
                                                    <img alt="avatar" class="rounded-circle me-3"
                                                        src="../assets/img/users/8.jpg">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-middle ms-3">
                                                    <div class="d-inline-block">
                                                        <h6 class="mb-1">Flicker</h6>
                                                        <p class="mb-0 tx-13 text-muted">Milestone2</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end">
                                                <div class="d-inline-block">
                                                    <h6 class="mb-2 tx-15 font-weight-semibold">$37.285 <i
                                                            class="fas fa-level-up-alt ms-2 text-success m-l-10"></i>
                                                    </h6>
                                                    <p class="mb-0 tx-11 text-muted">4 Apr 2020</p>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="wd-5p pb-0">
                                                <div class="main-img-user avatar-md">
                                                    <img alt="avatar" class="rounded-circle me-3"
                                                        src="../assets/img/users/4.jpg">
                                                </div>
                                            </td>
                                            <td class="pb-0">
                                                <div class="d-flex align-middle ms-3">
                                                    <div class="d-inline-block">
                                                        <h6 class="mb-1">Flicker</h6>
                                                        <p class="mb-0 tx-13 text-muted">App improvement</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end pb-0">
                                                <div class="d-inline-block">
                                                    <h6 class="mb-2 tx-15 font-weight-semibold">$25.341 <i
                                                            class="fas fa-level-down-alt ms-2 text-danger m-l-10"></i>
                                                    </h6>
                                                    <p class="mb-0 tx-11 text-muted">4 Apr 2020</p>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- col end -->
                        <!-- col end -->
                        <div class="col-sm-12 col-lg-12 col-xl-6 mt-xl-6">
                            <div class="card custom-card card-dashboard-calendar pb-0">
                                <label class="main-content-label mb-2 pt-1">Recent Notification</label>
                                <span class="d-block tx-12 mb-2 text-muted">Projects where development work is on
                                    completion</span>
                                <table class="table table-hover m-b-0 transcations mt-2">
                                    <tbody>
                                        <tr>
                                            <td class="wd-5p">
                                                <div class="main-img-user avatar-md">
                                                    <img alt="avatar" class="rounded-circle me-3"
                                                        src="../assets/img/users/5.jpg">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-middle ms-3">
                                                    <div class="d-inline-block">
                                                        <h6 class="mb-1">Flicker</h6>
                                                        <p class="mb-0 tx-13 text-muted">App improvement</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end">
                                                <div class="d-inline-block">
                                                    <h6 class="mb-2 tx-15 font-weight-semibold">$45.234 <i
                                                            class="fas fa-level-up-alt ms-2 text-success m-l-10"></i>
                                                    </h6>
                                                    <p class="mb-0 tx-11 text-muted">12 Jan 2020</p>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="wd-5p">
                                                <div class="main-img-user avatar-md">
                                                    <img alt="avatar" class="rounded-circle me-3"
                                                        src="../assets/img/users/6.jpg">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-middle ms-3">
                                                    <div class="d-inline-block">
                                                        <h6 class="mb-1">Intoxica</h6>
                                                        <p class="mb-0 tx-13 text-muted">Milestone</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end">
                                                <div class="d-inline-block">
                                                    <h6 class="mb-2 tx-15 font-weight-semibold">$23.452 <i
                                                            class="fas fa-level-down-alt ms-2 text-danger m-l-10"></i>
                                                    </h6>
                                                    <p class="mb-0 tx-11 text-muted">23 Jan 2020</p>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="wd-5p">
                                                <div class="main-img-user avatar-md">
                                                    <img alt="avatar" class="rounded-circle me-3"
                                                        src="../assets/img/users/7.jpg">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-middle ms-3">
                                                    <div class="d-inline-block">
                                                        <h6 class="mb-1">Digiwatt</h6>
                                                        <p class="mb-0 tx-13 text-muted">Sales executive</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end">
                                                <div class="d-inline-block">
                                                    <h6 class="mb-2 tx-15 font-weight-semibold">$78.001 <i
                                                            class="fas fa-level-down-alt ms-2 text-danger m-l-10"></i>
                                                    </h6>
                                                    <p class="mb-0 tx-11 text-muted">4 Apr 2020</p>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="wd-5p">
                                                <div class="main-img-user avatar-md">
                                                    <img alt="avatar" class="rounded-circle me-3"
                                                        src="../assets/img/users/8.jpg">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-middle ms-3">
                                                    <div class="d-inline-block">
                                                        <h6 class="mb-1">Flicker</h6>
                                                        <p class="mb-0 tx-13 text-muted">Milestone2</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end">
                                                <div class="d-inline-block">
                                                    <h6 class="mb-2 tx-15 font-weight-semibold">$37.285 <i
                                                            class="fas fa-level-up-alt ms-2 text-success m-l-10"></i>
                                                    </h6>
                                                    <p class="mb-0 tx-11 text-muted">4 Apr 2020</p>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="wd-5p pb-0">
                                                <div class="main-img-user avatar-md">
                                                    <img alt="avatar" class="rounded-circle me-3"
                                                        src="../assets/img/users/4.jpg">
                                                </div>
                                            </td>
                                            <td class="pb-0">
                                                <div class="d-flex align-middle ms-3">
                                                    <div class="d-inline-block">
                                                        <h6 class="mb-1">Flicker</h6>
                                                        <p class="mb-0 tx-13 text-muted">App improvement</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end pb-0">
                                                <div class="d-inline-block">
                                                    <h6 class="mb-2 tx-15 font-weight-semibold">$25.341 <i
                                                            class="fas fa-level-down-alt ms-2 text-danger m-l-10"></i>
                                                    </h6>
                                                    <p class="mb-0 tx-11 text-muted">4 Apr 2020</p>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- col end -->
                    </div>
                    <!-- Row end -->
                </div>
                <!-- col end -->
                {{-- <div class="col-sm-12 col-lg-12 ">
                    <div class="card custom-card">
                        <div class="card-header border-bottom-0 pb-0 d-flex ps-3 ms-1">
                            <div>
                                <label class="main-content-label mb-2 pt-2">Event Manager</label>
                            </div>
                        </div>
                        <div class="card-body pt-2 mt-0">
                            <div class="list-card mb-0">
                                <div class="d-flex">
                                    <div class="demo-avatar-group my-auto float-end">
                                        <div class="main-img-user avatar-md">
                                            <img alt="avatar" class="rounded-circle me-3"
                                                src="../assets/img/users/4.jpg">
                                        </div>
                                        <div class="d-flex align-middle ms-3">
                                            <div class="d-inline-block">
                                                <h6 class="mb-1">[Event Name]</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ms-auto float-end">
                                        <div class="">
                                            <a href="javascript:void(0)" class="option-dots" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="fe fe-more-horizontal"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-item mt-4">
                                    <div class="card-item-body">
                                        <div class="card-item-stat">
                                            <small class="tx-10 text-primary font-weight-semibold">Status: {Approve/
                                                Pending/ Rejected}</small>
                                            <h6 class=" mt-2">[Manager Name]: Admin</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card custom-card">
                        <div class="card-header border-bottom-0 pb-0 d-flex ps-3 ms-1">
                            <div>
                                <label class="main-content-label mb-2 pt-2">Documents</label>
                            </div>
                        </div>
                        <div class="card-body pt-2 mt-0">
                            <div class="list-card mb-0">
                                <div class="d-flex">
                                    <div class="demo-avatar-group my-auto float-end">
                                        <div class="main-img-user avatar-xs">
                                            <i class="fa fa-file" style="color: #888; font-size: 18px"></i>
                                        </div>
                                        <div class=""> Agreement</div>
                                    </div>
                                    <div class="ms-auto float-end">
                                        <div class="">
                                            <a href="javascript:void(0)" class="option-dots" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-download"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="demo-avatar-group my-auto float-end">
                                        <div class="main-img-user avatar-xs">
                                            <i class="fa fa-file" style="color: #888; font-size: 18px"></i>
                                        </div>
                                        <div class=""> Invoice</div>
                                    </div>
                                    <div class="ms-auto float-end">
                                        <div class="">
                                            <a href="javascript:void(0)" class="option-dots" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-download"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <!-- col end -->

            </div>
            <!-- Row end -->
        </div>
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
