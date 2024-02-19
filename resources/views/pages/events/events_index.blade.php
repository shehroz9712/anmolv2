@extends('Dashboard.Master.master_layout')
@section('title')
    EatAnmol - Events Index
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
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
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
                        <div class="table-responsive tasks">
                            <table class="table card-table table-vcenter text-nowrap mb-0 border">
                                <thead>
                                    <tr>
                                        <th class="wd-lg-20p">Name</th>
                                        <th class="wd-lg-20p">Guests</th>
                                        <th class="wd-lg-10p">Date</th>
                                        <th class="wd-lg-10p">Type</th>
                                        <th class="wd-lg-10p">Start Time</th>
                                        <th class="wd-lg-10p">End Time</th>
                                        <th class="wd-lg-20p">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($events as $event)
                                        <tr>
                                            <td>{{ $event->name }}</td>
                                            <td>{{ $event->guests }}</td>
                                            <td>{{ \Carbon\Carbon::parse($event->date)->format('m/d/Y') }}</td>
                                            <td>{{ $event->type }}</td>
                                            <td>{{ $event->start_time }}</td>
                                            <td>{{ $event->end_time }}</td>
                                            <td class="d-flex">
                                                <form id="editEventForm" class=" mx-1" method="POST"
                                                    action="{{ route('events.edit') }}">
                                                    @csrf
                                                    @method('POST')
                                                    <!-- Adding this line to specify the method as POST -->
                                                    <input type="hidden" name="eventId" value="{{ $event->id }}">
                                                    <button type="submit" class="btn btn-main-primary px-3">Edit</button>
                                                </form>

                                                <form action="{{ route('events.destroy', $event->id) }}" method="POST"
                                                    style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger px-3"
                                                        onclick="return confirm('Are you sure you want to delete this event?')">Delete</button>
                                                </form>
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
@endsection
