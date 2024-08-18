<!DOCTYPE html>
<html lang="en" id="demo">

<head>
    @include('Dashboard.Includes.stylesheets')
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        th{
            font-size:15px
        }



        strong {
            color: black;
            /* font-weight: bold; */
        }

        th {
            text-align: left;
            background-color: #f4f4f4;
        }

        .container {
            padding: 20px;
        }

        .main-body {
            font-family: Arial, sans-serif;
        }

        .leftmenu {
            padding: 0;
            margin: 0;
        }

        .main-content {
            padding: 0;
            margin: 0;
        }

        .container-fluid {
            width: 100%;
            padding: 0 15px;
            margin-right: auto;
            margin-left: auto;
        }

        .inner-body {
            padding: 15px;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card-body {
            padding: 20px;
        }

        .border-bottom {
            border-bottom: 1px solid #ddd;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .col-lg-12,
        .col-md-6,
        .col-md-4 {
            padding: 15px;
        }

        .col-lg-12 {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .col-md-6 {
            flex: 0 0 50%;
            max-width: 50%;
        }

        .col-md-4 {
            flex: 0 0 33.3333%;
            max-width: 33.3333%;
        }

        .d-flex {
            display: flex;
        }

        .align-items-center {
            align-items: center;
        }

        .justify-content-between {
            justify-content: space-between;
        }

        .mb-4 {
            margin-bottom: 1.5rem;
        }

        .mt-2 {
            margin-top: 0.5rem;
        }

        .my-3 {
            margin-top: 1rem;
            margin-bottom: 1rem;
        }

        .fw-bold {
            font-weight: bold;
        }

        .img-logo {
            height: 50px;
        }

        .text-center {
            text-align: center;
        }

        h4 {
            margin-top: 0;
            margin-bottom: 1rem;
        }

        h6 {
            margin-bottom: 0.5rem;
        }
    </style>
</head>

<body class="ltr main-body leftmenu">

    <div class="">
        <div class="m-0 main-content pt-0 side-content">
            <div class="main-container ">
                <div class="inner-body">
                    <div class="row row-sm">
                        <div class="col-lg-12">
                            <div class="card custom-card mg-b-20" id="invoice">
                                <div class="card-body ">
                                    <div class="text-center">

                                        <a href="{{ route('index') }}" style="text-align: center"><img
                                                src="data:image/png;base64,{{ base64_encode(file_get_contents('https://anmolv2.jmahalal.com/assets/img/brand/logo.png')) }}"
                                                height="50px" class="mobile-logo" alt="logo"></a>
                                    </div>
                                    @php
                                        $event = $journey->event;
                                        $venue = $journey->venue;
                                        $ServiceStyling = $journey->ServiceStyling;
                                        $package = $journey->package;
                                    @endphp
                                    <table>
                                        <thead>
                                            <tr>
                                                <th colspan="2">Event</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><strong>Name</strong></td>
                                                <td>{{ $event->name }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Guests</strong></td>
                                                <td>{{ $event->guests }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Type</strong></td>
                                                <td>{{ $event->type }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Date</strong></td>
                                                @php
                                                    $formattedDate = Carbon\Carbon::parse($event->date)->format(
                                                        'd M Y',
                                                    );
                                                @endphp
                                                <td>{{ $formattedDate }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Start Time</strong></td>
                                                <td>{{ $event->start_time }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>End Time</strong></td>
                                                <td>{{ $event->end_time }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Created At</strong></td>
                                                <td>{{ $event->created_at->format('d M Y') }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Created By</strong></td>
                                                <td>{{ $event->created_user }}</td>
                                            </tr>
                                            @if ($event->type == 'Pick up')
                                                <tr>
                                                    <td><strong>Location</strong></td>
                                                    <td>{{ $event->location }}</td>
                                                </tr>
                                            @endif
                                            @if ($event->type == 'Drop-off')
                                                <tr>
                                                    <td><strong>Address</strong></td>
                                                    <td>{{ $event->address }}</td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <td><strong>Total Amount</strong></td>
                                                <td>$ 00.<small>00</small></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Paid Amount</strong></td>
                                                <td>$ 00.<small>00</small></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    @if ($venue)
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th colspan="2">Venue</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><strong>Address</strong></td>
                                                    <td>{{ $venue->address }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>City, State, ZipCode</strong></td>
                                                    <td>{{ $venue->city }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Contact Person</strong></td>
                                                    <td>{{ $venue->ContactPerson }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Contact Email</strong></td>
                                                    <td>{{ $venue->ContactEmail }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Contact Phone</strong></td>
                                                    <td>{{ $venue->ContactPhone }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    @endif

                                    @if ($menu)
                                        @if ($package)
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th colspan="2">Package</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><strong>Package Name</strong></td>
                                                        <td>{{ $package->package_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Person</strong></td>
                                                        <td>{{ $package->person }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Currency</strong></td>
                                                        <td>{{ $package->currency }} {{ $package->price }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Category</strong></td>
                                                        <td>{{ $package->category->name }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        @endif

                                        <table>
                                            <thead>
                                                <tr>
                                                    <th colspan="2">Menu</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($menu as $key => $item)
                                                    @if ($loop->first || $item->type !== $menu[$loop->index - 1]->type)
                                                        <tr>
                                                            <td colspan="2" style="background-color: #f4f4f4;">
                                                                <strong>{{ ucfirst($item->type) }} Items</strong>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                    <tr>
                                                        <td>{{ $key + 1 }}- {{ $item->dishes->name }}</td>
                                                        <td>({{ ucfirst($item->type) }})</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif

                                    @if ($ServiceStyling)
                                        <!-- Add Service Styling Details Here -->
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('Dashboard.Includes.scripts')

</body>

</html>
