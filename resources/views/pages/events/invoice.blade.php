@extends('Dashboard.Master.master_layout')

@section('title')
    Events Invoice - EatAnmol
@endsection

@section('content')
    <div class="inner-body">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">Event Invoice</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('events.index') }}">Events</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Invoice Event</li>
                </ol>
            </div>
        </div>
        <!-- End Page Header -->

        @php
            $event = $journey->event;
            $venue = $journey->venue;
            $ServiceStyling = $journey->ServiceStyling;
            $package = $journey->package;
        @endphp

        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card custom-card p-3 mg-b-20">
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card" id="invoice">
                                        <div class="card-body">
                                            <div class="invoice-title">
                                                <h4 class="float-end font-size-15">Invoice #{{ $event->id }} <span
                                                        class="badge bg-danger font-size-12 ms-2">Unpaid</span></h4>
                                                <div class="mb-4">
                                                    <h2 class="mb-1 text-muted">Event Invoice</h2>
                                                </div>
                                                <div class="text-muted">
                                                    <p class="mb-1">Event Name: {{ $event->name }}</p>
                                                    <p class="mb-1">Event Date: {{ $event->date }}</p>
                                                    <p class="mb-1">Location: {{ $event->location }}</p>
                                                    <p class="mb-1"><i class="uil uil-envelope-alt me-1"></i>
                                                        {{ $event->contact_email }}</p>
                                                    <p><i class="uil uil-phone me-1"></i> {{ $event->contact_phone }}</p>
                                                </div>
                                            </div>

                                            <hr class="my-4">

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="text-muted">
                                                        <h5 class="font-size-16 mb-3">Billed To:</h5>
                                                        <h5 class="font-size-15 mb-2">{{ $event->client_name }}</h5>
                                                        <p class="mb-1">{{ $event->client_address }}</p>
                                                        <p class="mb-1">{{ $event->client_email }}</p>
                                                        <p>{{ $event->client_phone }}</p>
                                                    </div>
                                                </div>
                                                <!-- end col -->
                                                <div class="col-sm-6">
                                                    <div class="text-muted text-sm-end">
                                                        <div>
                                                            <h5 class="font-size-15 mb-1">Invoice No:</h5>
                                                            <p>#{{ $event->id }}</p>
                                                        </div>
                                                        <div class="mt-4">
                                                            <h5 class="font-size-15 mb-1">Invoice Date:</h5>
                                                            <p>{{ $event->date }}</p>
                                                        </div>
                                                        <div class="mt-4">
                                                            <h5 class="font-size-15 mb-1">Event Type:</h5>
                                                            <p>{{ $event->type }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col -->
                                            </div>
                                            <!-- end row -->

                                            @if ($venue)
                                                <div class="py-2 mt-4">
                                                    <h5 class="font-size-15">Venue Details</h5>
                                                    <div class="text-muted">
                                                        <p class="mb-1"><strong>Address:</strong> {{ $venue->address }}
                                                        </p>
                                                        <p class="mb-1"><strong>City:</strong> {{ $venue->city }}</p>
                                                        <p class="mb-1"><strong>Contact Person:</strong>
                                                            {{ $venue->contact_person }}</p>
                                                        <p class="mb-1"><strong>Contact Email:</strong>
                                                            {{ $venue->contact_email }}</p>
                                                        <p><strong>Contact Phone:</strong> {{ $venue->contact_phone }}</p>
                                                    </div>
                                                </div>
                                            @endif

                                            @if ($package)
                                                <div class="py-2 mt-4">
                                                    <h5 class="font-size-15">Package Details</h5>
                                                    <div class="text-muted">
                                                        <p class="mb-1"><strong>Package Name:</strong>
                                                            {{ $package->package_name }}</p>
                                                        <p class="mb-1"><strong>Person Count:</strong>
                                                            {{ $package->person }}</p>
                                                        <p class="mb-1"><strong>Currency:</strong>
                                                            {{ $package->currency }} {{ $package->price }}</p>
                                                        <p><strong>Category:</strong> {{ $package->category->name }}</p>
                                                    </div>
                                                </div>
                                            @endif

                                            @if ($menu)
                                                <div class="py-2 mt-4">
                                                    <h5 class="font-size-15">Menu Items</h5>
                                                    <div class="text-muted">
                                                        @foreach ($menu as $key => $item)
                                                            @if ($loop->first || $item->type !== $menu[$loop->index - 1]->type)
                                                                <h6 class="font-size-15 mb-2">{{ ucfirst($item->type) }}
                                                                    Items</h6>
                                                            @endif
                                                            <p class="mb-1">{{ $key + 1 }}.
                                                                {{ $item->dishes->name }} ({{ ucfirst($item->type) }})</p>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="d-print-none mt-4">
                                                <div class="float-end">
                                                    <a href="javascript:printInvoice()" class="btn btn-success me-1"><i
                                                            class="fa fa-print"></i> Print</a>
                                                    <a href="#" class="btn btn-primary w-md">Send</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end col -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Billing Form Section -->
        {{-- <div class="container mt-4">
            <h4>Billing Form</h4>
            <form action="{{ route('billing.store') }}" method="POST">
                @csrf
                <!-- Your billing form fields here -->
                <div class="form-group">
                    <label for="client_name">Client Name</label>
                    <input type="text" class="form-control" id="client_name" name="client_name" required>
                </div>
                <div class="form-group">
                    <label for="client_address">Client Address</label>
                    <input type="text" class="form-control" id="client_address" name="client_address" required>
                </div>
                <div class="form-group">
                    <label for="client_email">Client Email</label>
                    <input type="email" class="form-control" id="client_email" name="client_email" required>
                </div>
                <div class="form-group">
                    <label for="client_phone">Client Phone</label>
                    <input type="text" class="form-control" id="client_phone" name="client_phone" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div> --}}

    </div>
@endsection

@section('js')
    <script>
        function printInvoice() {
            var printContent = document.getElementById('invoice').innerHTML;
            var originalContent = document.body.innerHTML;

            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = originalContent;
        }
    </script>
@endsection
s
