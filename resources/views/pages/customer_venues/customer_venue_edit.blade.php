{{-- {{dd($venue)}} --}}
@extends('Dashboard.Master.master_layout')
@section('title')
Venue Edit - EatAnmol
@endsection
@section('stylesheet')
    <style>
    </style>
@endsection

@section('content')
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5"></h2>
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">Venue Edit</h2>
                 <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('events.index') }}">Events</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Venue</li>
                </ol>
            </div>
        </div>
        {{-- <div class="d-flex">
        <div class="justify-content-center">
            <a href="{{ route('customer-venues.index') }}" class="btn btn-primary my-2 btn-icon-text">
                <i class="fe fe-grid me-2"></i> View All
            </a>
        </div>
    </div> --}}
    </div>
    <div class="row row-sm">
        <div class=" col-md-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="row row-sm">
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="">
                                <form id="editEventForm" method="POST"
                                    action="{{ route('customer-venues.update', $venue->id) }}">
                                    @csrf
                                    @method('PUT') <!-- Use PUT for updating existing resource -->

                                    <input type="hidden" name="venueId" id="venueId" value="{{ $venue->id }}">

                                    <div class="form-group">
                                        <label for="name">Venue Name</label>
                                        <input data-toggle="tooltip" data-placement="bottom" aria-autocomplete="false"
                                            required placeholder="Venue name" title="Address"
                                            class="form-control @error('name') is-invalid @enderror" autocomplete="false"
                                            id="name" name="name" type="text"
                                            value="{{ old('name', $venue->name) }}">
                                        <small id="addressError" class="text-danger"></small>
                                    </div>

                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input data-toggle="tooltip" data-placement="bottom" placeholder="123 Main St"
                                            title="Address" class="form-control @error('address') is-invalid @enderror"
                                            id="address" name="address" type="text" required
                                            value="{{ old('address', $venue->address) }}">
                                        <small class="error-message" id="address_error"></small>
                                    </div>

                                    <div class="form-group">
                                        <label for="city">City, State, ZipCode</label>
                                        <input data-toggle="tooltip" data-placement="bottom"
                                            placeholder="City, State, ZipCode" title="City"
                                            class="form-control @error('city') is-invalid @enderror" id="city"
                                            name="city" type="text" required value="{{ old('city', $venue->city) }}">
                                        <small class="error-message" id="city_error"></small>
                                    </div>

                                    <div class="form-group">
                                        <label for="ContactPerson">Contact Person</label>
                                        <input data-toggle="tooltip" data-placement="bottom" placeholder="John Doe"
                                            title="Contact Person"
                                            class="form-control @error('ContactPerson') is-invalid @enderror"
                                            id="ContactPerson" name="ContactPerson" type="text"
                                            value="{{ old('ContactPerson', $venue->ContactPerson) }}">
                                        <small class="error-message" id="ContactPerson_error"></small>
                                    </div>

                                    <div class="form-group">
                                        <label for="ContactEmail">Contact Email</label>
                                        <input data-toggle="tooltip" data-placement="bottom"
                                            placeholder="john.doe@example.com" title="Contact Email"
                                            class="form-control @error('ContactEmail') is-invalid @enderror"
                                            id="ContactEmail" name="ContactEmail" type="email"
                                            value="{{ old('ContactEmail', $venue->ContactEmail) }}">
                                        <small class="error-message" id="ContactEmail_error"></small>
                                    </div>

                                    <div class="form-group">
                                        <label for="ContactPhone">Contact Phone</label>
                                        <input data-toggle="tooltip" data-placement="bottom" placeholder="+1 (555) 123-4567"
                                            title="Contact Phone"
                                            class="form-control @error('ContactPhone') is-invalid @enderror"
                                            id="ContactPhone" name="ContactPhone" type="tel"
                                            value="{{ old('ContactPhone', $venue->ContactPhone) }}">
                                        <small class="error-message" id="ContactPhone_error"></small>
                                    </div>

                                    <div class="d-flex">
                                        <div class="d-flex justify-content-end w-100">
                                            <div class="d-inline-block my-2">
                                                <button class="btn ripple btn-main-primary d-inline-block"
                                                    id="submitBtn">Save & Continue</button>
                                            </div>
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

            var input = document.getElementById('name');
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


                var cityzip = ''; // Declare the variable
                place.address_components.forEach(function(component) {
                    if (component.types.includes('locality')) {
                        cityzip += component.long_name + ', '; // Concatenate locality
                    } else if (component.types.includes('administrative_area_level_1')) {
                        cityzip += component.long_name + ', '; // Concatenate administrative_area_level_1
                    } else if (component.types.includes('postal_code')) {
                        cityzip += component.long_name; // Concatenate postal_code
                    }
                });

                document.getElementById('city').value = cityzip;
            });
        }
    </script>

    <script>
        document.getElementById('venue_id').addEventListener('change', function() {
            const cityInput = document.getElementById('city');
            // const stateInput = document.getElementById('state');
            // const zipcodeInput = document.getElementById('zipcode');
            const addressInput = document.getElementById('address');
            const otherVenueField = document.getElementById('otherVenueField');
            const selectedOption = this.options[this.selectedIndex];

            if (selectedOption.value === 'other') {
                cityInput.removeAttribute('disabled');
                // stateInput.removeAttribute('disabled');
                // zipcodeInput.removeAttribute('disabled');
                addressInput.removeAttribute('disabled');
                cityInput.value = '';
                // stateInput.value = '';
                // zipcodeInput.value = '';
                addressInput.value = '';

                otherVenueField.classList.remove('d-none');
            } else {
                otherVenueField.classList.add('d-none');
                // Update the values from the selected option.
                cityInput.setAttribute('disabled', 'disabled');
                // stateInput.setAttribute('disabled', 'disabled');
                // zipcodeInput.setAttribute('disabled', 'disabled');
                addressInput.setAttribute('disabled', 'disabled');
                cityInput.value = selectedOption.getAttribute('data-city') || '';
                stateInput.value = selectedOption.getAttribute('data-state') || '';
                zipcodeInput.value = selectedOption.getAttribute('data-zipcode') || '';
                addressInput.value = selectedOption.getAttribute('data-address') || '';
            }
        });


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

        // stateInput.addEventListener('blur', () => {
        //     validateInput(stateInput, document.getElementById('state_error'), 'State is required.');
        // });

        // zipcodeInput.addEventListener('blur', () => {
        //     validateInput(zipcodeInput, document.getElementById('zipcode_error'), 'Zipcode is required.');
        // });

        addressInput.addEventListener('blur', () => {
            validateInput(addressInput, document.getElementById('address_error'), 'Address is required.');
        });

        contactPersonInput.addEventListener('blur', () => {
            validateInput(contactPersonInput, document.getElementById('ContactPerson_error'),
                'Contact Person is required.');
        });

        contactEmailInput.addEventListener('blur', () => {
            const emailPattern = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
            if (validateInput(contactEmailInput, document.getElementById('ContactEmail_error'),
                    'Contact Email is required.') && !emailPattern.test(contactEmailInput.value)) {
                document.getElementById('ContactEmail_error').textContent = 'Invalid email format.';
            }
        });

        // contactPhoneInput.addEventListener('blur', () => {

        // });

        document.getElementById('submitBtn').addEventListener('click', function(e) {
            e.preventDefault();

            // Validate venue selection
            const venueId = document.getElementById('venue_id');
            if (venueId.value === '') {
                document.getElementById('venue_id_error').textContent = 'Please select a venue.';
                return;
            }

            // Validate other fields
            let isValid = true;
            if (!validateInput(cityInput, document.getElementById('city_error'), 'City is required.')) {
                isValid = false;
            }
            // if (!validateInput(stateInput, document.getElementById('state_error'), 'State is required.')) {
            //     isValid = false;
            // }
            // if (!validateInput(zipcodeInput, document.getElementById('zipcode_error'), 'Zipcode is required.')) {
            //     isValid = false;
            // }
            if (!validateInput(addressInput, document.getElementById('address_error'), 'Address is required.')) {
                isValid = false;
            }
            if (!validateInput(contactPersonInput, document.getElementById('ContactPerson_error'),
                    'Contact Person is required.')) {
                isValid = false;
            }

            const emailPattern = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
            if (contactEmailInput.value.trim() !== '' && !emailPattern.test(contactEmailInput.value)) {
                document.getElementById('ContactEmail_error').textContent = 'Invalid email format.';
                isValid = false;
            }

            // Implement phone number validation if needed

            if (isValid) {
                document.getElementById('submitBtn').closest('form').submit();
            }
        });
    </script>
@endsection
