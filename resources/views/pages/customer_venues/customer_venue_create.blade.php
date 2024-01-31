{{-- {{dd($eventId)}} --}}
@extends('Dashboard.Master.master_layout')
@section('title')
EatAnmol - Venue Create
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
            <h2 class="main-content-title tx-24 mg-b-5">Venue Add</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Venue</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Venue</li>
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
                <div>
                    <h6 class="main-content-label mb-1">Add Venue</h6>
                    <p class="text-muted card-sub-title">Add a new venue with venue name and related details.</p>
                </div>
                <div class="row row-sm">
                    <div class="col-md-12 col-lg-12 col-xl-12">
                        <div class="">
                            <form method="POST" action="{{ route('customer-venues.store') }}">
                                @csrf
                                
                                <input type="hidden" name="event_id" id="event_id"  value="{{ $eventId ?? null }}">
                                <div class="form-group">
                                    <label for="venue_id">Venue Name</label>
                                    <select class="form-control" data-toggle="tooltip" data-placement="bottom" title="Select Venue" id="venue_id" name="venue_id" required>
                                        <option label="Select Venue"></option>
                                        @foreach($venues as $venue)
                                            <option value="{{ $venue->id }}" data-city="{{ $venue->city }}" data-state="{{ $venue->state }}" data-zipcode="{{ $venue->zipcode }}" data-address="{{ $venue->address }}">{{ $venue->name }}</option>
                                        @endforeach
                                        <option value="other">Other</option>
                                    </select>
                                    <small class="error-message" id="venue_id_error"></small>
                                </div>
                                <div class="form-group d-none" id="otherVenueField">
                                    <label for="otherVenue">Other Venue Name</label>
                                    <input data-toggle="tooltip" data-placement="bottom" placeholder="John Doe Venue" title="Venue Name" class="form-control" id="otherVenue" name="otherVenue" type="otherVenue">
                                    <small class="error-message" id="otherVenue_error"></small>
                                </div>
                              
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input data-toggle="tooltip" data-placement="bottom" placeholder="123 Main St" title="Address" class="form-control" id="address" name="address" type="text" required>
                                    <small class="error-message" id="address_error"></small>
                                </div>
                                <div class="form-group">
                                    <label for="city">City, State, ZipCode</label>
                                    <input data-toggle="tooltip" data-placement="bottom" placeholder="Karachi" title="City" class="form-control" id="city" name="city" type="text" required>
                                    <small class="error-message" id="city_error"></small>
                                </div>
                                <div class="form-group">
                                    <label for="ContactPerson">Contact Person</label>
                                    <input data-toggle="tooltip" data-placement="bottom" placeholder="John Doe" title="Contact Person" class="form-control" id="ContactPerson" name="ContactPerson" required type="text">
                                    <small class="error-message" id="ContactPerson_error"></small>
                                </div>
                                <div class="form-group">
                                    <label for="ContactEmail">Contact Email</label>
                                    <input data-toggle="tooltip" data-placement="bottom" placeholder="john.doe@example.com" title="Contact Email" class="form-control" id="ContactEmail" name="ContactEmail" type="email">
                                    <small class="error-message" id="ContactEmail_error"></small>
                                </div>
                                <div class="form-group">
                                    <label for="ContactPhone">Contact Phone</label>
                                    <input data-toggle="tooltip" data-placement="bottom" placeholder="+1 (555) 123-4567" title="Contact Phone" class="form-control" id="ContactPhone" name="ContactPhone" type="tel">
                                    <small class="error-message" id="ContactPhone_error"></small>
                                </div>
                                <div class="d-flex ">
                                    <div class="d-flex justify-content-end w-100">
                                        {{-- <a href="{{ route('customer-venues.index') }}" class="btn btn-purple my-2 btn-icon-text">
                                            <i class="fe fe-grid me-2"></i> View All Venues
                                        </a> --}}
                                        <div class="d-inline-block my-2"> <button class="btn ripple btn-main-primary d-inline-block" id="submitBtn">Submit</button></div>
                                    </div>
                                </div>
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
    document.getElementById('venue_id').addEventListener('change', function() {
        const cityInput = document.getElementById('city');
        // const stateInput = document.getElementById('state');
        // const zipcodeInput = document.getElementById('zipcode');
        const addressInput = document.getElementById('address');
        const otherVenueField = document.getElementById('otherVenueField');
        console.log(otherVenueField.classList);
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
            cityInput.setAttribute('required', 'required');
            // stateInput.setAttribute('required', 'required');
            // zipcodeInput.setAttribute('required', 'required');
            addressInput.setAttribute('required', 'required');
            cityInput.value = selectedOption.getAttribute('data-city') || '';
            // stateInput.value = selectedOption.getAttribute('data-state') || '';
            // zipcodeInput.value = selectedOption.getAttribute('data-zipcode') || '';
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
    document.getElementById('ContactPhone_error').textContent='Enter a valid phone number (e.g., (123) 456-7890)';
}
    });

    

    otherVenue.addEventListener('blur', () => {
        validateInput(otherVenue, document.getElementById('otherVenue_error'), 'Venue is required.');
    });

    // stateInput.addEventListener('blur', () => {
        // validateInput(stateInput, document.getElementById('state_error'), 'State is required.');
    // });

    // zipcodeInput.addEventListener('blur', () => {
    //     validateInput(zipcodeInput, document.getElementById('zipcode_error'), 'Zipcode is required.');
    // });

    addressInput.addEventListener('blur', () => {
        validateInput(addressInput, document.getElementById('address_error'), 'Address is required.');
    });

    contactPersonInput.addEventListener('blur', () => {
        validateInput(contactPersonInput, document.getElementById('ContactPerson_error'), 'Contact Person is required.');
    });

    contactEmailInput.addEventListener('blur', () => {
        const emailPattern = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
        if (validateInput(contactEmailInput, document.getElementById('ContactEmail_error'), 'Contact Email is required.') && !emailPattern.test(contactEmailInput.value)) {
            document.getElementById('ContactEmail_error').textContent = 'Invalid email format.';
        }
    });


    document.getElementById('submitBtn').addEventListener('click', function(e) {
        e.preventDefault();
        const venueId = document.getElementById('venue_id');

        // Validate venue selection
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
        if (!validateInput(contactPersonInput, document.getElementById('ContactPerson_error'), 'Contact Person is required.')) {
            isValid = false;
        }

        const emailPattern = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
        if (contactEmailInput.value.trim() !== '' && !emailPattern.test(contactEmailInput.value)) {
            document.getElementById('ContactEmail_error').textContent = 'Invalid email format.';
            isValid = false;
        }

        if (isValid) {
            document.getElementById('submitBtn').closest('form').submit();
        }
    });
</script>
@endsection
