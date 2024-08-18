@extends('Dashboard.Master.master_layout')
@section('title')
    Events Detail - EatAnmol
@endsection
@section('content')
    <div class="inner-body">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5"></h2>
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Event Details</h2>

                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('events.index') }}">Events</a></li>
                        <li class="breadcrumb-item active" aria-current="page">show Event</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card custom-card p-3 mg-b-20" id="invoice">
                    <div class="card-body">

                        @php
                            $event = $journey->event;
                            $venue = $journey->venue;
                            $ServiceStyling = $journey->ServiceStyling;
                            $package = $journey->package;
                        @endphp
                        <div class="container">

                            <div class="row ">
                                <div class="align-items-center d-flex justify-content-between mb-4">

                                    <h4 class="mb-0">Event</h4>
                                    <a href="{{ route('index') }}"><img
                                            src="https://anmolv2.jmahalal.com/assets/img/brand/logo.png" height="50px"
                                            class="mobile-logo" alt="logo"></a>
                                </div>
                                <hr>
                                <div class="col-lg-12">
                                    <div class="row">

                                        <div class="border-bottom col-md-6 mt-2">
                                            <div class="row">
                                                <h6 class="col-sm-4 fw-bold">Name</h6>
                                                <div class="col-sm-8">{{ $event->name }}</div>
                                            </div>
                                        </div>
                                        <div class="border-bottom col-md-6 mt-2">
                                            <div class="row">
                                                <h6 class="col-sm-4 fw-bold">Guests</h6>
                                                <div class="col-sm-8">{{ $event->guests }}</div>
                                            </div>
                                        </div>
                                        <div class="border-bottom col-md-6 mt-2">
                                            <div class="row">
                                                <h6 class="col-sm-4 fw-bold">Type</h6>
                                                <div class="col-sm-8">{{ $event->type }}</div>
                                            </div>
                                        </div>
                                        <div class="border-bottom col-md-6 mt-2">
                                            <div class="row">
                                                <h6 class="col-sm-4 fw-bold">Date</h6>

                                                @php
                                                    $formattedDate = Carbon\Carbon::parse($event->date)->format(
                                                        'd M Y',
                                                    );
                                                @endphp
                                                <div class="col-sm-8">{{ $formattedDate }}</div>
                                            </div>
                                        </div>

                                        <div class="border-bottom col-md-6 mt-2">
                                            <div class="row">
                                                <h6 class="col-sm-4 fw-bold">Start Time</h6>
                                                <div class="col-sm-8">{{ $event->start_time }}</div>
                                            </div>
                                        </div>
                                        <div class="border-bottom col-md-6 mt-2">
                                            <div class="row">
                                                <h6 class="col-sm-4 fw-bold">End Time</h6>
                                                <div class="col-sm-8">{{ $event->end_time }}</div>
                                            </div>
                                        </div>

                                        <div class="border-bottom col-md-6 mt-2">
                                            <div class="row">
                                                <h6 class="col-sm-4 fw-bold">Created At</h6>
                                                <div class="col-sm-8">{{ $event->created_at->format('d M Y') }}</div>
                                            </div>
                                        </div>

                                        <div class="border-bottom col-md-6 mt-2">
                                            <div class="row">
                                                <h6 class="col-sm-4 fw-bold">Created By</h6>
                                                <div class="col-sm-8">{{ $event->created_user }}</div>
                                            </div>
                                        </div>
                                        @if ($event->type == 'Pick up')
                                            <div class="border-bottom col-md-6 mt-2">
                                                <div class="row">
                                                    <h6 class="col-sm-4 fw-bold">Location</h6>
                                                    <div class="col-sm-8">{{ $event->location }}</div>
                                                </div>
                                            </div>
                                        @endif

                                        @if ($event->type == 'Drop-off')
                                            <div class="border-bottom col-md-6 mt-2">
                                                <div class="row">
                                                    <h6 class="col-sm-4 fw-bold">Address</h6>
                                                    <div class="col-sm-8">{{ $event->address }}</div>
                                                </div>
                                            </div>
                                        @endif


                                        <div class="border-bottom col-md-6 mt-2">
                                            <div class="row">
                                                <h6 class="col-sm-4 fw-bold">Total Amount</h6>
                                                <div class="col-sm-8">$ 00.<small>00</small> </div>
                                            </div>
                                        </div>
                                        <div class="border-bottom col-md-6 mt-2">
                                            <div class="row">
                                                <h6 class="col-sm-4 fw-bold">Paid Amount</h6>
                                                <div class="col-sm-8">$ 00.<small>00</small></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if ($venue)
                                    <div class="row mt-3 ">
                                        <h4>Venue</h4>
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="border-bottom col-md-6 mt-2">
                                                    <div class="row">
                                                        <h6 class="col-sm-4 fw-bold">Address</h6>
                                                        <div class="col-sm-8">{{ $venue->address }}</div>
                                                    </div>
                                                </div>
                                                <div class="border-bottom col-md-6 mt-2">
                                                    <div class="row">
                                                        <h6 class="col-sm-4 fw-bold">City, State, ZipCode</h6>
                                                        <div class="col-sm-8">{{ $venue->city }}</div>
                                                    </div>
                                                </div>
                                                <div class="border-bottom col-md-6 mt-2">
                                                    <div class="row">
                                                        <h6 class="col-sm-4 fw-bold">Contact Person</h6>
                                                        <div class="col-sm-8">{{ $venue->ContactPerson }}</div>
                                                    </div>
                                                </div>
                                                <div class="border-bottom col-md-6 mt-2">
                                                    <div class="row">
                                                        <h6 class="col-sm-4 fw-bold">Contact Email</h6>
                                                        <div class="col-sm-8">{{ $venue->ContactEmail }}</div>
                                                    </div>
                                                </div>
                                                <div class="border-bottom col-md-6 mt-2">
                                                    <div class="row">
                                                        <h6 class="col-sm-4 fw-bold">Contact Phone</h6>
                                                        <div class="col-sm-8">{{ $venue->ContactPhone }}</div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if ($menu)
                                    @if ($package)
                                        <div class="row mt-3 ">
                                            <h4>Package</h4>
                                            <div class="col-lg-12">
                                                <div class="row">

                                                    <div class="border-bottom col-md-6 mt-2">
                                                        <div class="row">
                                                            <h6 class="col-sm-4 fw-bold">Package Name</h6>
                                                            <div class="col-sm-8">{{ $package->package_name }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="border-bottom col-md-6 mt-2">
                                                        <div class="row">
                                                            <h6 class="col-sm-4 fw-bold">Person</h6>
                                                            <div class="col-sm-8">{{ $package->person }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="border-bottom col-md-6 mt-2">
                                                        <div class="row">
                                                            <h6 class="col-sm-4 fw-bold">Currency</h6>
                                                            <div class="col-sm-8">{{ $package->currency }}
                                                                {{ $package->price }}</div>
                                                        </div>
                                                    </div>

                                                    <div class="border-bottom col-md-6 mt-2">
                                                        <div class="row">
                                                            <h6 class="col-sm-4 fw-bold">Category</h6>
                                                            <div class="col-sm-8">{{ $package->category->name }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row mt-3 ">
                                        <h4>Menu</h4>
                                        <div class="col-lg-12">
                                            <div class="row">
                                                @foreach ($menu as $key => $item)
                                                    @if ($loop->first || $item->type !== $menu[$loop->index - 1]->type)
                                                        <h4 class="my-3">{{ ucfirst($item->type) }} Items</h4>
                                                    @endif
                                                    <div class="border-bottom col-md-4 my-2">
                                                        {{ $key + 1 }}-
                                                        {{ $item->dishes->name }} ({{ ucfirst($item->type) }})

                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if ($ServiceStyling)
                                @endif

                                <!--<div class="row">-->
                                <div class="col-lg-12 text-end">

                                    <a href="{{ route('event.print.invoice', encrypt($event->id)) }}"
                                        class="btn btn-main-primary me-1"><i class="fa fa-print"></i> PDF</a>
                                </div>
                                <!--</div>-->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
