@extends('Dashboard.Master.master_layout')
@section('title')
EatAnmol - Manage Profile  - EatAnmol
@endsection
@section('content')
    <div class="main-content  pt-0">

        <div class="container-fluid">
            {{-- <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Profile</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Profile</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Manage</li>
                    </ol>
                </div>

            </div> --}}
            <!-- End Page Header -->

            <div class="row square">
                <div class="col-lg-12 col-md-12">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="panel profile-cover">
                                <div class="profile-cover__img">
                                    <img src="../assets/img/users/1.jpg" alt="img" />
                                    <h3 class="h3">{{ Auth::user()->name }}</h3>
                                </div>
                                {{-- <div class="btn-profile">
                                <button class="btn btn-rounded btn-danger">
                                    <i class="fa fa-plus"></i>
                                    <span>Follow</span>
                                </button>
                                <button class="btn btn-rounded btn-success">
                                    <i class="fa fa-comment"></i>
                                    <span>Message</span>
                                </button>
                            </div> --}}
                                <div class="profile-cover__action bg-img"></div>
                                {{-- <div class="profile-cover__info">
                                <ul class="nav">
                                    <li><strong>26</strong>Projects</li>
                                    <li><strong>33</strong>Followers</li>
                                    <li><strong>136</strong>Following</li>
                                </ul>
                            </div> --}}
                                <br><br><br><br><br>
                            </div>
                            <div class="profile-tab tab-menu-heading">
                                <nav class="nav main-nav-line p-3 tabs-menu profile-nav-line bg-gray-100">
                                    <a class="nav-link  active" data-bs-toggle="tab" href="#about">About</a>
                                    <a class="nav-link" data-bs-toggle="tab" href="#edit">Edit Profile</a>
                                    {{-- <a class="nav-link" data-bs-toggle="tab" href="#timeline">Timeline</a> --}}
                                    {{-- <a class="nav-link" data-bs-toggle="tab" href="#gallery">Gallery</a> --}}
                                    {{-- <a class="nav-link" data-bs-toggle="tab" href="#friends">Friends</a> --}}
                                    <a class="nav-link" data-bs-toggle="tab" href="#settings">Account Settings</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row -->
            <div class="row row-sm">
                <div class="col-lg-12 col-md-12">
                    <div class="card custom-card main-content-body-profile">
                        <div class="tab-content">
                            <div class="main-content-body tab-pane p-4 border-top-0 active" id="about">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Personal Information</h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
                                                <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                                                <p><strong>Phone Number:</strong> {{ Auth::user()->phone }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="main-content-body tab-pane p-4 border-top-0" id="edit">
                                <div class="card-body border">
                                    <div class="mb-4 main-content-label">Personal Information</div>
                                    <div class="container p-5">
                                        <div class="container px-5">
                                            <div class="row justify-content-center">
                                                <div class="col-8 col-offset-2">
                                                    <form method="POST" action="{{ route('profile.update') }}" id="edit-form">
                                                        @csrf
                                                        @method('PUT')
                                                        <input class="form-control" type="hidden" placeholder="User ID" name="id" id="id"
                                                            value="{{ Auth::user()->id }}" autocomplete="id">
                                                        <div class="form-group text-start">
                                                            <label>Name</label>
                                                            <input class="form-control" type="text" name="name" id="name" placeholder="John Doe"
                                                                value="{{ Auth::user()->name }}" required autofocus autocomplete="name">
                                                            <small class="error-message text-danger" id="name-error"></small>
                                                        </div>
                                                        <div class="form-group text-start">
                                                            <label>Email</label>
                                                            <input class="form-control" type="email" name="email" id="email" placeholder="john.doe@example.com"
                                                                value="{{ Auth::user()->email }}" required autocomplete="username">
                                                            <small class="error-message text-danger" id="email-error"></small>
                                                        </div>
                                                        <div class="form-group text-start">
                                                            <label>Phone Number</label>
                                                            <input class="form-control" placeholder="(555) 123-4567" type="text" name="phone" id="phone"
                                                                value="{{ Auth::user()->phone }}" required autocomplete="phone">
                                                            <small class="error-message text-danger" id="phone-error"></small>
                                                        </div>

                                                        <button type="submit" class="btn ripple btn-main-primary btn-block">Update Profile</button>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="main-content-body tab-pane p-4 border-top-0" id="settings">
                                <div class="card-body border" data-select2-id="12">

                                    <div class="mb-4 main-content-label">Account Settings</div>
                                    {{-- <div class="form-group ">
                                    <div class="row row-sm">
                                        <div class="col-md-2">
                                            <label class="form-label">Login Verification</label>
                                        </div>
                                        <div class="col-md-10">
                                           <a class="" href="#">Set up Verification</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row row-sm">
                                        <div class="col-md-2">
                                            <label class="form-label">Password Verification</label>
                                        </div>
                                        <div class="col-md-10">
                                            <label class="ckbox mg-b-10">
                                                <input type="checkbox"><span>Require Personal Details</span></label>
                                        </div>
                                    </div>
                                </div> --}}
                                    <div class="row justify-content-center">
                                        <div class="col-6 ">
                                            <div class="card">
                                                @if(Auth::check() && !(Auth::user()->google_id != null || Auth::user()->twitter_id != null))
                                                <div class="card-body">
                                                    {{-- <h5 class="card-title">Account Settings</h5> --}}
                                                    <div class="card-text">
                                                        <a href="{{ route('passwordChange') }}" class="btn btn-primary btn-block">Change
                                                            Password</a>
                                                        {{-- <a href="#" class="btn btn-danger btn-block mb-3">Deactivate
                                                            Account</a> --}}
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        contactPhoneInput = document.getElementById('phone');
        // Phone number input mask
        $('#phone').mask('(999) 999-9999');

        // Validation on textbox leave event
        $('input').on('blur', function() {
            validateField($(this));
        });

        // Form submission validation
        $('#edit-form').on('submit', function(e) {
            debugger;
            e.preventDefault();
            let valid = true;
            $('#edit-form input').each(function() {
                console.log($(this))
                if (!validateField($(this))) {
                    valid = false;
                }
            });

            if (valid) {
                // Form is valid, you can submit it here
                this.submit();
            }
        });

        function validateField(input) {
    const fieldName = input.attr('name');
    const value = input.val();
    const errorContainer = $(`#${fieldName}-error`);

    // Reset error message
    errorContainer.text('');

    // Name field validation (no special characters)
    if (fieldName === 'name') {
        if (/^\s+$/.test(value)) {
            errorContainer.text('Name should not be only spaces.');
            return false;
        }

        const specialChars = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
        if (specialChars.test(value)) {
            errorContainer.text('Name should not contain special characters.');
            return false;
        }
    }

    // Phone field validation
    if (fieldName === 'phone') {
        const phoneNumberPattern = /^\(\d{3}\) \d{3}-\d{4}$/;

        if (!phoneNumberPattern.test(value)) {
            errorContainer.text('Enter a valid phone number (e.g., (123) 456-7890)');
            return false;
        }
    }

    // Email field validation
    if (fieldName === 'email') {
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

        if (!emailPattern.test(value)) {
            errorContainer.text('Enter a valid email address.');
            return false;
        }
    }

    return true;
}

    </script>
@endsection
