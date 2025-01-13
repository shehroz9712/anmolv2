@extends('Dashboard.Master.master_layout')

@section('stylesheet')
    <style>
    </style>
@endsection

@section('content')
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">Edit Admin Venue</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('venue-info.index') }}">Admin Venues</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Admin Venue</li>
            </ol>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div>
                        <h6 class="main-content-label mb-1">Edit Admin Venue</h6>
                        <p class="text-muted card-sub-title">Edit the admin venue details.</p>
                    </div>
                    <div class="row row-sm">
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="">
                                <form method="POST" action="{{ route('venue-info.update', $venueInfo->id) }}" onsubmit="return validateForm();">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="venueAddress">Venue Name</label>
                                        <input value="{{ $venueInfo->name }}" required placeholder="Venue name" 
                                               class="form-control @error('venueAddress') is-invalid @enderror" 
                                               id="venueAddress" name="venueAddress" type="text">
                                    </div>

                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input value="{{ $venueInfo->address }}" required placeholder="123 Main St" 
                                               class="form-control @error('address') is-invalid @enderror" 
                                               id="address" name="address" type="text">
                                    </div>

                                    <div class="form-group">
                                        <label for="city">City, State, ZipCode</label>
                                        <input value="{{ $venueInfo->city }}" required placeholder="City, State, ZipCode" 
                                               class="form-control @error('city') is-invalid @enderror" 
                                               id="city" name="city" type="text">
                                    </div>

                                    <div class="form-group">
                                        <label for="ContactPerson">Contact Person</label>
                                        <input value="{{ $venueInfo->contact_name }}" placeholder="John Doe" 
                                               class="form-control @error('ContactPerson') is-invalid @enderror" 
                                               id="ContactPerson" name="ContactPerson" type="text">
                                    </div>

                                    <div class="form-group">
                                        <label for="ContactEmail">Contact Email</label>
                                        <input value="{{ $venueInfo->contact_email }}" placeholder="john.doe@example.com" 
                                               class="form-control @error('ContactEmail') is-invalid @enderror" 
                                               id="ContactEmail" name="ContactEmail" type="email">
                                    </div>

                                    <div class="form-group">
                                        <label for="ContactPhone">Contact Phone</label>
                                        <input value="{{ $venueInfo->contact_phone }}" placeholder="+1 (555) 123-4567" 
                                               class="form-control @error('ContactPhone') is-invalid @enderror" 
                                               id="ContactPhone" name="ContactPhone" type="tel">
                                    </div>

                                    <input type="hidden" id="lat" name="lat" value="{{ $venueInfo->lat }}">
                                    <input type="hidden" id="long" name="long" value="{{ $venueInfo->long }}">

                                    <button class="btn ripple btn-main-primary btn-block">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        // Function to validate the name field
        function validateName() {
            const nameInput = document.getElementById('name');
            const nameError = document.getElementById('nameError');
            const nameValue = nameInput.value;

            nameError.innerText = ''; // Reset previous error message

            if (nameValue.trim() === '') {
                nameError.innerText = 'Name is required';
                return false;
            } else if (/[^a-zA-Z0-9\s]/.test(nameValue)) {
                nameError.innerText = 'Name should only contain letters, numbers, and spaces';
                return false;
            }

            return true;
        }

        // Function to validate the address field
        function validateAddress() {
            const addressInput = document.getElementById('address');
            const addressError = document.getElementById('addressError');
            const addressValue = addressInput.value;

            addressError.innerText = ''; // Reset previous error message

            if (addressValue.trim() === '') {
                addressError.innerText = 'Address is required';
                return false;
            }

            return true;
        }

        // Function to validate the city field
        function validateCity() {
            const cityInput = document.getElementById('city');
            const cityError = document.getElementById('cityError');
            const cityValue = cityInput.value;

            cityError.innerText = ''; // Reset previous error message

            if (cityValue.trim() === '') {
                cityError.innerText = 'City is required';
                return false;
            } else if (/[^a-zA-Z0-9\s]/.test(cityValue)) {
                cityError.innerText = 'Enter a valid city';
                return false;
            }

            return true;
        }

        // Function to validate the state field
        function validateState() {
            const stateInput = document.getElementById('state');
            const stateError = document.getElementById('stateError');
            const stateValue = stateInput.value;

            stateError.innerText = ''; // Reset previous error message

            if (stateValue.trim() === '') {
                stateError.innerText = 'State is required';
                return false;
            } else if (/[^a-zA-Z0-9\s]/.test(stateValue)) {
                stateError.innerText = 'Enter a valid state';
                return false;
            }

            return true;
        }

        // Function to validate the zipcode field
        function validateZipcode() {
            const zipcodeInput = document.getElementById('zipcode');
            const zipcodeError = document.getElementById('zipcodeError');
            const zipcodeValue = zipcodeInput.value;

            zipcodeError.innerText = ''; // Reset previous error message

            if (zipcodeValue.trim() === '') {
                zipcodeError.innerText = 'Zipcode is required';
                return false;
            } else if (!/^\d{5}$/.test(zipcodeValue)) {
                zipcodeError.innerText = 'Zipcode should be 5 digits';
                return false;
            }

            return true;
        }

        function validateForm() {
            // Perform client-side validation for all fields
            const isNameValid = validateName();
            const isAddressValid = validateAddress();
            const isCityValid = validateCity();
            const isStateValid = validateState();
            const isZipcodeValid = validateZipcode();

            // Submit the form if all fields are valid
            return isNameValid && isAddressValid && isCityValid && isStateValid && isZipcodeValid;
        }

        // Add blur event listeners to trigger validation on input leave
        document.getElementById('name').addEventListener('blur', validateName);
        document.getElementById('address').addEventListener('blur', validateAddress);
        document.getElementById('city').addEventListener('blur', validateCity);
        document.getElementById('state').addEventListener('blur', validateState);
        document.getElementById('zipcode').addEventListener('blur', validateZipcode);
    </script>
@endsection
