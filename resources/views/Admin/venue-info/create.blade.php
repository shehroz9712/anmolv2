@extends('Dashboard.Master.master_layout')

@section('stylesheet')
    <style>
        /* Add your custom CSS styles here */
    </style>
@endsection

@section('content')
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">Add Admin Venue</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>

                <li class="breadcrumb-item"><a href="{{ route('venue-info.index') }}">Admin Venues</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Admin Venue</li>
            </ol>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div>
                        <h6 class="main-content-label mb-1">Add Admin Venue</h6>
                        <p class="text-muted card-sub-title">Add a new admin venue with details.</p>
                    </div>
                    <div class="row row-sm">
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="">
                                <form method="POST" action="{{ route('venue-info.store') }}"
                                    onsubmit="return validateForm();">
                                    @csrf
                                    <div class="form-group">
                                        <label for="venueAddress">Venue Name</label>
                                        <input required placeholder="Venue name" title="Venue Name"
                                            class="form-control @error('venueAddress') is-invalid @enderror"
                                            id="venueAddress" name="venueAddress" type="text">
                                    </div>

                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input required placeholder="123 Main St" title="Address"
                                            class="form-control @error('address') is-invalid @enderror" id="address"
                                            name="address" type="text">
                                    </div>

                                    <div class="form-group">
                                        <label for="city">City, State, ZipCode</label>
                                        <input required placeholder="City, State, ZipCode" title="City, State, ZipCode"
                                            class="form-control @error('city') is-invalid @enderror" id="city"
                                            name="city" type="text">
                                    </div>

                                    <div class="form-group">
                                        <label for="ContactPerson">Contact Person</label>
                                        <input placeholder="John Doe" title="Contact Person"
                                            class="form-control @error('ContactPerson') is-invalid @enderror"
                                            id="ContactPerson" name="ContactPerson" type="text">
                                    </div>

                                    <div class="form-group">
                                        <label for="ContactEmail">Contact Email</label>
                                        <input placeholder="john.doe@example.com" title="Contact Email"
                                            class="form-control @error('ContactEmail') is-invalid @enderror"
                                            id="ContactEmail" name="ContactEmail" type="email">
                                    </div>

                                    <div class="form-group">
                                        <label for="ContactPhone">Contact Phone</label>
                                        <input placeholder="+1 (555) 123-4567" title="Contact Phone"
                                            class="form-control @error('ContactPhone') is-invalid @enderror"
                                            id="ContactPhone" name="ContactPhone" type="tel">
                                    </div>

                                    <input type="hidden" id="lat" name="lat">
                                    <input type="hidden" id="long" name="long">

                                    <button class="btn ripple btn-main-primary btn-block">Submit</button>
                                </form>
                                <div id="map" style="display: none;" style="height: 400px;"></div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
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

            var input = document.getElementById('venueAddress');
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

                map.setZoom(17);
                map.setCenter(place.geometry.location);

                document.getElementById('address').value = place.name;

                var cityzip = '';
                place.address_components.forEach(function(component) {
                    if (component.types.includes('locality')) {
                        cityzip += component.long_name + ', ';
                    } else if (component.types.includes('administrative_area_level_1')) {
                        cityzip += component.long_name + ', ';
                    } else if (component.types.includes('postal_code')) {
                        cityzip += component.long_name;
                    }
                });

                document.getElementById('city').value = cityzip;

                // Fetch contact details via AJAX
                fetch('{{ route('get.contact.details') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            address: document.getElementById('address').value
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            document.getElementById('ContactPerson').value = data.data.contact_person;
                            document.getElementById('ContactEmail').value = data.data.contact_email;
                            document.getElementById('ContactPhone').value = data.data.contact_phone;
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });


        }
    </script>
@endsection
