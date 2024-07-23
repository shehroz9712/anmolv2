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

            <li class="breadcrumb-item"><a href="{{ route('admin-venues.index') }}">Admin Venues</a></li>
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
                            <form method="POST" action="{{ route('admin-venues.store') }}" onsubmit="return validateForm();">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input class="form-control" id="name" name="name" required type="text">
                                    <small id="nameError" class="text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input class="form-control" id="address" name="address" required type="text">
                                    <small id="addressError" class="text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label for="city">City, State, ZipCode</label>
                                    <input class="form-control" id="city" name="city" required type="text">
                                    <small id="cityError" class="text-danger"></small>
                                </div>
                                {{-- <div class="form-group">
                                    <label for "state">State</label>
                                    <input class="form-control" id="state" name="state" required type="text">
                                    <small id="stateError" class="text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label for="zipcode">Zipcode</label>
                                    <input class="form-control" id="zipcode" name="zipcode" required type="text">
                                    <small id="zipcodeError" class="text-danger"></small>
                                </div> --}}
                                <button class="btn ripple btn-main-primary btn-block">Submit</button>
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
        }else if (/[^a-zA-Z0-9\s]/.test(cityValue)) {
            cityError.innerText = 'Enter a valid city';
            return false;
        }

        return true;
    }

    // Function to validate the state field
    // function validateState() {
    //     const stateInput = document.getElementById('state');
    //     const stateError = document.getElementById('stateError');
    //     const stateValue = stateInput.value;

    //     stateError.innerText = ''; // Reset previous error message

    //     if (stateValue.trim() === '') {
    //         stateError.innerText = 'State is required';
    //         return false;
    //     }else if (/[^a-zA-Z0-9\s]/.test(stateValue)) {
    //         stateError.innerText = 'Enter a valid state';
    //         return false;
    //     }

    //     return true;
    // }

    // // Function to validate the zipcode field
    // function validateZipcode() {
    //     const zipcodeInput = document.getElementById('zipcode');
    //     const zipcodeError = document.getElementById('zipcodeError');
    //     const zipcodeValue = zipcodeInput.value;

    //     zipcodeError.innerText = ''; // Reset previous error message

    //     if (zipcodeValue.trim() === '') {
    //         zipcodeError.innerText = 'Zipcode is required';
    //         return false;
    //     } else if (!/^\d{5}$/.test(zipcodeValue)) {
    //         zipcodeError.innerText = 'Zipcode should be 5 digits';
    //         return false;
    //     }

    //     return true;
    // }

    function validateForm() {
        // Perform client-side validation for all fields
        const isNameValid = validateName();
        const isAddressValid = validateAddress();
        const isCityValid = validateCity();
        // const isStateValid = validateState();
        // const isZipcodeValid = validateZipcode();

        // Submit the form if all fields are valid
        return isNameValid && isAddressValid && isCityValid && isStateValid && isZipcodeValid;
    }

    // Add blur event listeners to trigger validation on input leave
    document.getElementById('name').addEventListener('blur', validateName);
    document.getElementById('address').addEventListener('blur', validateAddress);
    document.getElementById('city').addEventListener('blur', validateCity);
    // document.getElementById('state').addEventListener('blur', validateState);
    // document.getElementById('zipcode').addEventListener('blur', validateZipcode);
</script>
@endsection
