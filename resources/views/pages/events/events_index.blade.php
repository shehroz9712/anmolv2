@extends('Dashboard.Master.master_layout')
@section('title')
    Events List - EatAnmol
@endsection
@section('content')
    <div class="inner-body">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5"></h2>
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Event List</h2>
                     <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('events.index') }}">Events</a></li>
                        <li class="breadcrumb-item active" aria-current="page">List Event</li>
                    </ol>
                </div>
            </div>
            <div class="d-flex">
                <div class="justify-content-center">

                    <a href="{{ route('events.create') }}" class="btn btn-primary my-2 btn-icon-text">
                        <i class="fe fe-calendar me-2"></i> Add Event
                    </a>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card custom-card p-3 mg-b-20">
                    <div class="card-body">
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
                                    @foreach ($events as $event)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($event->date)->format('m/d/Y') }}</td>
                                            <td>{{ $event->name }}</td>
                                            <td>{{ $event->guests }}</td>
                                            {{-- <td>{{ $event->type }}</td> --}}
                                            <td>{{ $event->start_time }}</td>
                                            <td>{{ $event->end_time }}</td>
                                            <td class="d-flex"> <a href="{{ route('events.show', encrypt($event->id)) }}"
                                                    class="btn btn-main-primary px-3">View</a>
                                                <a href="{{ route('events.invoice.show', encrypt($event->id)) }}"
                                                    class="btn btn-main-primary px-3 ms-3">Show Invoice</a>
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
                                                            type="button" id="dropdownMenuButton2"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
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
                                                                            href="{{ route('menu.index', encrypt($event->journey->eventid)) }}">
                                                                            <i class="fa fa-pencil-alt"></i>
                                                                            Change Full Menu
                                                                        </a></li>
                                                                    <li><a class="dropdown-item "
                                                                            href="{{ route('events.menu.edit', encrypt($event->journey->eventid)) }}">
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
                                                @else
                                                    <p class="ms-3">Event Date Passout</p>
                                                @endif
                                            </td>

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
    <script>
        function MyDate(originalDateStr) {

            // Convert the string to a Date object
            var originalDate = new Date(originalDateStr);

            // Extract components from the Date object
            var month = (originalDate.getMonth() + 1).toString().padStart(2, '0');
            var day = originalDate.getDate().toString().padStart(2, '0');
            var year = originalDate.getFullYear().toString();

            // Format the date as 'MM-dd-yyyy'
            var formattedDateStr = month + '-' + day + '-' + year;
            return formattedDateStr;
        }
    </script>
@endsection

@section('js')
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
