{{-- {{dd($eventId)}} --}}
@extends('Dashboard.Master.master_layout')
@section('title')
    Venue Create - EatAnmol
@endsection
@section('stylesheet')
    <style>
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
            cursor: pointer;
        }

        .custom-addon i {
            color: #333;
        }

        .error-message {
            color: #ff0000;
            font-size: 12px;
        }
    </style>
@endsection

@section('content')
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5"></h2>
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">Venue</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('events.index') }}">Events</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Venue</li>
                </ol>
            </div>
        </div>

    </div>
    <div class="row row-sm">
        <div class=" col-md-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="row row-sm">
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="">
                                <form method="POST" action="{{ route('Venues.store') }}">
                                    @csrf

                                    <input type="hidden" name="event_id" id="event_id"
                                        value="{{ $eventId ? decrypt($eventId) : null }}">
                                    <div class="form-group">
                                        <label for="venueAddress">Venue Name</label>
                                        <input data-toggle="tooltip" data-placement="bottom" aria-autocomplete="false"
                                            required placeholder="Venue name" title="Address"
                                            class="form-control  @error('venueAddress') is-invalid @enderror"
                                            autocomplete="false" id="venueAddress" name="venueAddress" type="text">
                                        <small id="addressError" class="text-danger"></small>
                                    </div>

                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input data-toggle="tooltip" data-placement="bottom" placeholder="123 Main St"
                                            title="Address" class="form-control  @error('address') is-invalid @enderror"
                                            id="address" name="address" type="text" required>
                                        <small class="error-message" id="address_error"></small>
                                    </div>

                                    <div class="form-group">
                                        <label for="city">City, State, ZipCode</label>
                                        <input data-toggle="tooltip" data-placement="bottom"
                                            placeholder="City, State, ZipCode" title="City"
                                            class="form-control  @error('city') is-invalid @enderror" id="city"
                                            name="city" type="text" required>
                                        <small class="error-message" id="city_error"></small>
                                    </div>





                                    <div class="form-group">
                                        <label for="ContactPerson">Contact Person</label>
                                        <input data-toggle="tooltip" data-placement="bottom" placeholder="John Doe"
                                            title="Contact Person"
                                            class="form-control  @error('ContactPerson') is-invalid @enderror"
                                            id="ContactPerson" name="ContactPerson" type="text">
                                        <small class="error-message" id="ContactPerson_error"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="ContactEmail">Contact Email</label>
                                        <input data-toggle="tooltip" data-placement="bottom"
                                            placeholder="john.doe@example.com" title="Contact Email"
                                            class="form-control  @error('ContactEmail') is-invalid @enderror"
                                            id="ContactEmail" name="ContactEmail" type="email">
                                        <small class="error-message" id="ContactEmail_error"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="ContactPhone">Contact Phone</label>
                                        <input data-toggle="tooltip" data-placement="bottom" placeholder="+1 (555) 123-4567"
                                            title="Contact Phone"
                                            class="form-control  @error('ContactPhone') is-invalid @enderror"
                                            id="ContactPhone" name="ContactPhone" type="tel">
                                        <small class="error-message" id="ContactPhone_error"></small>
                                    </div>
                                    <div class="d-flex ">
                                        <div class="d-flex justify-content-end w-100">
                                            {{-- <a href="{{ route('Venues.index') }}" class="btn btn-purple my-2 btn-icon-text">
                                            <i class="fe fe-grid me-2"></i> View All Venues
                                        </a> --}}
                                            <div class="d-inline-block my-2"> <button
                                                    class="btn ripple btn-main-primary d-inline-block" id="submitBtn">Save
                                                    & Continue</button></div>
                                        </div>
                                    </div>
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
















    <script>
        function validateInput(inputElement, errorElement, errorMessage) {
            const inputValue = inputElement.value.trim();
            if (inputValue === '') {
                errorElement.textContent = errorMessage;
                return false;
            } else {
                errorElement.textContent = '';
                return true;
            }

        }

        const cityInput = document.getElementById('city');
        // const stateInput = document.getElementById('state');
        // const zipcodeInput = document.getElementById('zipcode');
        const otherVenue = document.getElementById('otherVenue');
        const addressInput = document.getElementById('address');
        const contactPersonInput = document.getElementById('ContactPerson');
        const contactEmailInput = document.getElementById('ContactEmail');
        const contactPhoneInput = document.getElementById('ContactPhone');

        cityInput.addEventListener('blur', () => {
            validateInput(cityInput, document.getElementById('city_error'), 'City is required.');
        });

        $('#ContactPhone').mask('(999) 999-9999');
        contactPhoneInput.addEventListener('blur', () => {
            const phoneNumberPattern = /^\(\d{3}\) \d{3}-\d{4}$/;

            if (!phoneNumberPattern.test(contactPhoneInput.value)) {
                document.getElementById('ContactPhone_error').textContent =
                    'Enter a valid phone number (e.g., (123) 456-7890)';
            }
        });
    </script>
@endsection
