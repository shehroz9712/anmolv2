{{-- {{dd($venue)}} --}}
@extends('Dashboard.Master.master_layout')
@section('title')
EatAnmol - Venue Edit
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
                <li class="breadcrumb-item"><a href="javascript:void(0)">Venue</a></li>
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
                <div>
                    <h6 class="main-content-label mb-1">Edit Customer Venue</h6>
                    <p class="text-muted card-sub-title">Edit the customer venue details.</p>
                </div>
                <div class="row row-sm">
                    <div class="col-md-12 col-lg-12 col-xl-12">
                        <div class="">
                            <form method="POST" action="{{ route('customer-venues.update') }}">
                                @csrf
                                @method('PUT')
                            
                                <input type="hidden" name="venueId" value="{{ $venueId }}">
                                <div class="form-group">
                                    <label for="venue_id">Venue Name</label>
                                    <select class="form-control" id="venue_id" name="venue_id" required>
                                        <option label="Select Venue"></option>
                                        @foreach($venues as $v)
                                            <option value="{{ $v->id }}" data-city="{{ $v->city }}" data-state="{{ $v->state }}" data-zipcode="{{ $v->zipcode }}" data-address="{{ $v->address }}" @if($venue->admin_venue_id == $v->id) selected @endif>{{ $v->name }}</option>
                                        @endforeach
                                        <option value="other">Other</option>
                                    </select>
                                    <small class="error-message text-danger" id="venue_id_error"></small>
                                </div>
                            
                                <div class="form-group d-none" id="otherVenueField">
                                    <label for="otherVenue">Other Venue Name</label>
                                    <input class="form-control" id="otherVenue" name="otherVenue" type="otherVenue" placeholder="Dummy Venue">
                                    <small class="error-message" id="otherVenue_error"></small>
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input class="form-control" id="address" name="address" type="text" value="{{ old('address', $adminVenue->address) }}" required disabled placeholder="123 Dummy Street">
                                    <small class="error-message text-danger" id="address_error"></small>
                                </div>
                                <div class="form-group">
                                    <label for="city">City, State, ZipCode</label>
                                    <input class="form-control" id="city" name="city" type="text" value="{{ old('city', $adminVenue->city) }}" required disabled placeholder="Dummy City, Dummy State, 12345">
                                    <small class="error-message text-danger" id="city_error"></small>
                                </div>
                                                        
                                <div class="form-group">
                                    <label for="ContactPerson">Contact Person</label>
                                    <input class="form-control" id="ContactPerson" name="ContactPerson" value="{{ old('ContactPerson', $venue->ContactPerson) }}" required type="text" placeholder="John Doe">
                                    <small class="error-message text-danger" id="ContactPerson_error"></small>
                                </div>
                            
                                <div class="form-group">
                                    <label for="ContactEmail">Contact Email</label>
                                    <input class="form-control" id="ContactEmail" name="ContactEmail" type="email" value="{{ old('ContactEmail', $venue->ContactEmail) }}" placeholder="dummy@example.com">
                                    <small class="error-message text-danger" id="ContactEmail_error"></small>
                                </div>
                            
                                <div class="form-group">
                                    <label for="ContactPhone">Contact Phone</label>
                                    <input class="form-control" id="ContactPhone" name="ContactPhone" type="tel" value="{{ old('ContactPhone', $venue->ContactPhone) }}" placeholder="(555) 555-5555">
                                    <small class="error-message text-danger" id="ContactPhone_error"></small>
                                </div>
                            
                                <div class="d-flex">
                                    <div class="d-flex justify-content-end w-100">
                                        {{-- <a href="{{ route('customer-venues.index') }}" class="btn btn-purple my-2 btn-icon-text">
                                            <i class="fe fe-grid me-2"></i> View All Venues
                                        </a> --}}
                                        <div class="d-inline-block my-2">
                                            <button class="btn ripple btn-main-primary d-inline-block" id="submitBtn">Update</button>
                                        </div>
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
    document.getElementById('ContactPhone_error').textContent='Enter a valid phone number (e.g., (123) 456-7890)';
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
    validateInput(contactPersonInput, document.getElementById('ContactPerson_error'), 'Contact Person is required.');
});

contactEmailInput.addEventListener('blur', () => {
    const emailPattern = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
    if (validateInput(contactEmailInput, document.getElementById('ContactEmail_error'), 'Contact Email is required.') && !emailPattern.test(contactEmailInput.value)) {
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
    if (!validateInput(contactPersonInput, document.getElementById('ContactPerson_error'), 'Contact Person is required.')) {
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
