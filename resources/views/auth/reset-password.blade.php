<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="description" content="Spruha - Admin Panel HTML Dashboard Template">
    <meta name="author" content="Spruko Technologies Private Limited">
    <meta name="keywords"
        content="admin, dashboard, panel, bootstrap admin template, bootstrap dashboard, dashboard, themeforest admin dashboard, themeforest admin, themeforest dashboard, themeforest admin panel, themeforest admin template, themeforest admin dashboard, cool admin, it dashboard, admin design, dash templates, saas dashboard, dmin ui design">
    <link rel="icon" href="../assets/img/brand/favicon.ico" type="image/x-icon" />
    <title>Customer Panel - Eat Anmol</title>
    @include('Dashboard.Includes.stylesheets')
    <link rel="stylesheet" href="../assets/css/signin.css" />
</head>

<body class="ltr main-body leftmenu error-1">
    <div id="global-loader">
        <img src="../assets/img/loader.svg" class="loader-img" alt="Loader">
    </div>
    <div class="page main-signin-wrapper">
        <div class="row" style="height: 100vh">
            <div class="d-none d-md-block col-md-6  col-lg-8" style="padding: 0px !important;overflow: hidden">
                <section id="thehero">
                    <div class="the-inner">
                        <div class="container">
                            <div class="row">
                                <div class="d-flex justify-content-center align-item-center text-center p-0 mb-0">
                                    <img class="d-inline" src="{{ asset('assets/img/brand/logo.png') }}" width="20%"
                                        alt="Logo">
                                </div>
                                <p class="text-dark pt-0 p-3">Get ready to embark on a hassle-free journey to event
                                    perfection. Anmol's website offers you the power to create unforgettable occasions
                                    and craft your ideal menu, all at your fingertips. From selecting the finest
                                    culinary delights to customizing your events, our platform is your canvas to bring
                                    your vision to life. Explore, create, and design your dreams before you log in –
                                    your event, your menu, your way.</p>

                                <div class="container text-center">
                                    <a href="{{ route('register') }}" class="btn btn-primary"><button
                                            class="btn btn-primary">Create An Account</button></a>
                                    <a href="{{ route('login') }}" class="btn btn-primary"><button
                                            class="btn btn-primary">Login</button></a>
                                </div>
                            </div>
                        </div>
                </section>
            </div>
            <div class="col-12 col-md-6 sign-form col-lg-4 "
                style="padding: 0px !important; max-height: 100vh; overflow-y: hidden;overflow-x: hidden; ">
                <div class="row text-center ">
                    <div class="col-md-12">
                        <div class="card p-3" style="min-height: 100vh;justify-content: center">
                            <div class="row row-sm ">
                                <div class="w-100 col-lg-12 col-xl-12 col-xs-12 col-sm-12 login_form">
                                    <div class="main-container container-fluid">
                                        <div class="container">
                                            <div class="row row-sm">
                                                <div class="text-center ">
                                                    <span class="bg-white p-3"> <img
                                                            src="{{ asset('assets/img/brand/logo.png') }}"
                                                            width="20%" alt=""></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row row-sm text-center">
                                            <div class="card-body p-5">
                                                <!-- Login form from your second HTML code -->
                                                <h5 class="text-start">Reset Your Password!</h5>
                                                <form method="POST" action="{{ route('password.store') }}">
                                                    @csrf
                                                    <input type="hidden" name="token"
                                                        value="{{ $request->route('token') }}">
                                                    <div class="form-group text-start">
                                                        <label>Email</label>
                                                        <input class="form-control" id="email" disabled
                                                            placeholder="Enter your email" type="email"
                                                            value="{{ old('email', $request->email) }}" disabled
                                                            autocomplete="email">
                                                        <input class="form-control" hidden
                                                            placeholder="Enter your email" type="email" name="email"
                                                            value="{{ old('email', $request->email) }}" required
                                                            autofocus autocomplete="email">
                                                    </div>
                                                    <div class="form-group text-start">
                                                        <label>New Password</label>
                                                        <input class="form-control" placeholder="Enter your password"
                                                            type="password" name="password" required
                                                            autocomplete="new-password">
                                                        <small class="error-message text-danger"
                                                            id="password-error"></small>
                                                            @if ($errors->has('email'))
                                                                <small
                                                                    class="alert alert-danger p-2">{{ $errors->first('email') }}</small>
                                                            @endif
                                                    </div>
                                                    <div class="form-group text-start">
                                                        <label>Confirm Password</label>
                                                        <input class="form-control" placeholder="Confirm your password"
                                                            type="password" name="password_confirmation" required
                                                            autocomplete="new-password">
                                                        <small class="error-message text-danger"
                                                            id="password_confirmation-error"></small>
                                                    </div>
                                                    <button onclick="validatePassword()"
                                                        class="btn ripple btn-main-primary btn-block">Reset
                                                        Password</button>
                                                </form>


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
    </div>


    @include('Dashboard.Includes.scripts')
    <script>
        const passwordInput = document.querySelector('input[name="password"]');
        const passwordConfirmationInput = document.querySelector('input[name="password_confirmation"]');
        const passwordError = document.getElementById('password-error');
        const passwordConfirmationError = document.getElementById('password_confirmation-error');

        // Function to validate the password
        function validatePassword() {
            const password = passwordInput.value;
            const passwordConfirmation = passwordConfirmationInput.value;

            if (password.length < 8) {
                passwordError.textContent = 'Password must contain at least 8 characters and numbers.';
                return false;
            } else if (!/\d/.test(password)) {
                passwordError.textContent = 'Password must contain at least one number.';
                return false;
            } else {
                passwordError.textContent = '';

            }

            // Check password confirmation and show error if it doesn't match
            if (password !== passwordConfirmation) {
                passwordConfirmationError.textContent = 'Passwords do not match.';
                return false;

            } else {

                passwordConfirmationError.textContent = '';
                return true;
            }
            return true;
        }

        // Listen for the blur event on the password input
        passwordInput.addEventListener('blur', validatePassword);

        // Listen for the blur event on the password confirmation input
        passwordConfirmationInput.addEventListener('blur', validatePassword);
    </script>
</body>

</html>
