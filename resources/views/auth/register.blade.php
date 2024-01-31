{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="description" content="Spruha - Admin Panel HTML Dashboard Template">
    <meta name="author" content="Spruko Technologies Private Limited">
    <meta name="keywords"
        content="admin,dashboard,panel,bootstrap admin template,bootstrap dashboard,dashboard,themeforest admin dashboard,themeforest admin,themeforest dashboard,themeforest admin panel,themeforest admin template,themeforest admin dashboard,cool admin,it dashboard,admin design,dash templates,saas dashboard,dmin ui design">
    <link rel="icon" href="../assets/img/brand/favicon.ico" type="image/x-icon" />
    <title>Customer Panel - Eat Anmol</title>
    @include('Dashboard.Includes.stylesheets')
    <link rel="stylesheet" href="../assets/css/signin.css" />
</head>

<body class=" ltr  main-body leftmenu error-1 ">
    <div id="global-loader">
        <img src="../assets/img/loader.svg" class="loader-img" alt="Loader">
    </div>
    <div class="page main-signin-wrapper">
        <div class="row" style="min-height: 100vh;overflow-y: hidden">
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

                            </div>

                        </div>
                    </div>
                </section>
            </div>
            <div class="col-12 col-md-6 sign-form col-lg-4"
                style="padding: 0px !important; max-height: 100vh; overflow-y: auto;overflow-x: hidden">
                <div class="container p-3">
                    <div class="row  text-center">
                        <div class="col-md-12">
                            <div class="card p-3">
                                <div class="row row-sm">
    
                                    <div class="w-100 col-lg-12 col-xl-12 col-xs-12 col-sm-12 login_form ">
                                        <div class="main-container container">
                                            <div class="container">
                                                <div class="row row-sm">
                                                <div class="card p-5">
                                                    <img src="{{asset('assets/img/brand/logo.png')}}" alt="">
                                                </div>
                                                </div>
                                            </div>
                                            <div class="row row-sm">
                                                <div class="card-body  ">
                                                    <img src="../assets/img/brand/logo-light.png"
                                                        class="d-lg-none header-brand-img text-start float-start  error-logo-light"
                                                        alt="logo">
                                                    <img src="../assets/img/brand/logo.png"
                                                        class="d-lg-none header-brand-img text-start float-start  error-logo"
                                                        alt="logo">
                                                    <div class="clearfix"></div>
                                                    <h5 class="text-start ">Sign Up</h5>
                                                    <form method="POST" action="{{ route('register') }}"
                                                        id="registration-form">
                                                        @csrf
                                                        <div class="form-group text-start">
                                                            <label for="name">Name</label>
                                                            <input class="form-control" type="text" name="name"
                                                                id="name" placeholder="Enter your Name"
                                                                value="{{ old('name') }}" required autofocus>
                                                            <small class="error-message text-danger"
                                                                id="name-error"></small>
                                                        </div>
    
                                                        <div class="form-group text-start">
                                                            <label for="phone">Phone Number</label>
                                                            <input class="form-control" type="text" name="phone"
                                                                id="phone" placeholder="Enter your Phone Number"
                                                                value="{{ old('phone') }}" required>
                                                            <small class="error-message text-danger"
                                                                id="phone-error"></small>
                                                        </div>
    
                                                        <div class="form-group text-start">
                                                            <label for="email">Email</label>
                                                            <input class="form-control" type="email" name="email"
                                                                id="email" placeholder="Enter your email"
                                                                value="{{ old('email') }}" required>
                                                            <small class="error-message text-danger"
                                                                id="email-error"></small>
                                                        </div>
    
                                                        <div class="form-group text-start">
                                                            <label for="password">Password</label>
                                                            <div class="input-group">
                                                                <input class="form-control" type="password" name="password"
                                                                    id="password" placeholder="Enter your password"
                                                                    required>
                                                                <div class="input-group-append">
                                                                    <button
                                                                        class="btn  btn-toggle-password"
                                                                        type="button" id="togglePassword">
                                                                        <i class="fa fa-eye" id="passwordToggleIcon"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <small class="error-message text-danger"
                                                                id="password-error"></small>
                                                        </div>
    
                                                        <div class="form-group text-start">
                                                            <label for="password_confirmation">Confirm Password</label>
                                                            <div class="input-group">
                                                                <input class="form-control" type="password"
                                                                    name="password_confirmation" id="confirmPasswordInput"
                                                                    placeholder="Confirm your password" required>
                                                                <div class="input-group-append">
                                                                    <button
                                                                        class="btn  btn-toggle-password"
                                                                        type="button" id="toggleConfirmPassword">
                                                                        <i class="fa fa-eye"
                                                                            id="confirmPasswordToggleIcon"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <small class="error-message text-danger"
                                                                id="confirmPassword-error"></small>
                                                        </div>
    
                                                        <button class="btn ripple btn-main-primary btn-block"
                                                            type="submit">Create Account</button>
                                                    </form>
                                                    <br>
                                                    <div class="text-start  ms-0">
                                                        <p class="">Already have an account? <a href="/login"><b>Sign
                                                            In</b></a></p>
                                                    </div>
                                                    <div class=" text-center ">
                                                        <div>
                                                            <a href="{{ route('google-auth') }}"
                                                                class="full-width-button login-with-google-btn d-block my-2">
                                                               Sign in with Google
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="mysection text-start ms-0 pt-3">
                                                      
                                                        <div>Don't want to create account now?  <a href="{{ route('guest-home') }}"><b>Continue as
                                                                    Guest</b></a>
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
        </div>
    </div>
    <script>
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('confirmPasswordInput');
        const passwordToggleIcon = document.getElementById('passwordToggleIcon');
        const confirmPasswordToggleIcon = document.getElementById('confirmPasswordToggleIcon');
        const togglePassword = document.getElementById('togglePassword');
        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');

        function togglePasswordVisibility(input, toggleButton, toggleIcon) {
            if (input.type === 'password') {
                input.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        togglePassword.addEventListener('click', function() {
            togglePasswordVisibility(passwordInput, togglePassword, passwordToggleIcon);
        });

        toggleConfirmPassword.addEventListener('click', function() {
            togglePasswordVisibility(confirmPasswordInput, toggleConfirmPassword, confirmPasswordToggleIcon);
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        // Phone number input mask
        $('#phone').mask('(999) 999-9999');

        // Validation on textbox leave event
        $('input').on('blur', function() {
            validateField($(this));
        });

        // Form submission validation
        $('#registration-form').on('submit', function(e) {
            e.preventDefault();
            let valid = true;
            $('input').each(function() {
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
            // Name field validation (no special characters)
            if (fieldName === 'phone') {
                const phoneNumberPattern = /^\(\d{3}\) \d{3}-\d{4}$/;

                if (!phoneNumberPattern.test(value)) {
                    errorContainer.text('Enter a valid phone number (e.g., (123) 456-7890)');
                }

            }
            if (fieldName === 'email') {
                const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

                if (!emailPattern.test(value)) {
                    errorContainer.text('Enter a valid email address.');
                }
            }

            // Password and Confirm Password validation
            if (fieldName === 'password' || fieldName === 'confirmPasswordInput') {
                const password = $('#password').val();
                const confirmPassword = $('#confirmPasswordInput').val();
                if (password !== confirmPassword) {
                    errorContainer.text('Passwords do not match.');
                    return false;
                }
                if(password.length<8){
                    errorContainer.text('Password Must Contain 8 Chracters With Numbers.');
                    return false;
                }
            }
           

            return true;
        }
    </script>

    @include('Dashboard.Includes.scripts')
</body>

</html> --}}




<!DOCTYPE html>
<html lang="en">

<head>
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type">

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="noindex, nofollow" name="robots">
    <link href="http://s.w.org/" rel="dns-prefetch">
    <link href="https://fonts.googleapis.com/" rel="preconnect">
    <link rel="icon" href="../assets/img/brand/favicon.ico" type="image/x-icon" />
    <link crossorigin="" href="https://fonts.gstatic.com/" rel="preconnect">

    <link rel="stylesheet" href="{{ asset('assets/css/social.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <title>Customer Panel - Eat Anmol</title>
    <link rel="stylesheet" media="screen"
        href="{{ asset('assets/tripleseat/d12lx3pio9mr3b.cloudfront.net/assets/01/fa_bundle-c4bdd483be2b1dae791c0b3cb38bdbe27f559eac1b9a55c950cf64b858ac1882.css') }}" />
        <link href="{{ asset('assets/tripleseat/d12lx3pio9mr3b.cloudfront.net/marketing_site/style.css') }}" id='base-style-css'
        media='all' rel='stylesheet' type='text/css'>
    <script src="{{ asset('assets/tripleseat/d12lx3pio9mr3b.cloudfront.net/assets/01/jquery_bundle-16319aafdbe0f8e90b79c96663d5f937405614f2aa47071526a39a63a437170c.js') }}"
        crossorigin="anonymous"></script>
    <script src="{{ asset('assets/tripleseat/d12lx3pio9mr3b.cloudfront.net/assets/01/rails-3b92853778d4282132e4be897e0d4e173a9163595e5e9907bc7f0e31b21f1f3d.js') }}"
        crossorigin="anonymous">
    </script><script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


    </head>



<body class=" ltr  main-body leftmenu error-1 ">
    <div class='wrapper'>
        <main class='main' id='main'>
            <div class='login-holder'>
                <div class='intro-section'>
                    <div class='bg-img' style="background-image: url({{ asset('assets/img/media/signinpage.jpg') }});">
                    </div>
                    <div class='intro'>
                        <div class='container'>
                            <h1>Create An Account with Eat Anmol</h1>
                            <p>Get ready to embark on a hassle-free journey to delicious meals. Eat Anmol's platform
                                offers you the power to explore, order, and enjoy your favorite cuisines, all at your
                                fingertips.</p>
                            <div class='btn-hold'>
                                <a class='btn' href="{{ route('login') }}"><small style="font-size:16px">Sign In</small></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='login-block'>
                    <div class='container'>
                        <div class='form-holder'>
                            <div class='logo'>
                                <a href='register.html'
                                    style="filter: invert(50%) hue-rotate(180deg) brightness(200%)">
                                    <img alt='logo' src='{{ asset('assets/img/brand/logo.png') }}'>
                                </a>
                            </div>

                            <div class='login-form'>
                                <h2>Create an Account</h2>

                                <form class="sign-form lwa-form" id="registration-form" action="{{ route('register') }}" method="POST"
                                    >
                                    @csrf
                                    <label>
                                        <label class="lwa_user_login" for="name">Name</label>
                                        <input type="text" name="name" id="name" class="lwa_user_login"
                                           placeholder="" placeholder="Enter Your Name"  autofocus="autofocus"
                                            onblur="validateField(this)" />
                                        <small class="text-danger" id="name-error"></small>
                                    </label>

                                    <label>
                                        <label class="lwa_user_login" for="phone">Phone Number</label>
                                        <input type="text" name="phone" id="phone" class="lwa_user_login" 
                                           placeholder="" placeholder="Enter Your Phone Number"  onblur="validateField(this)" />
                                        <small class="text-danger" id="phone-error"></small>
                                    </label>

                                    <label>
                                        <label class="lwa_user_login" for="email">Email Address</label>
                                        <input type="text" name="email" id="email" class="lwa_user_login"
                                           placeholder="" placeholder="Enter Your Email" onblur="validateField(this)" />
                                        <small class="text-danger" id="email-error"></small>
                                        @if ($errors->has('email'))
                                        <small class="text-danger">{{ $errors->first('email') }}</small>
                                        @endif
                                    </label>

                                    <label>
                                        <label class="lwa_user_pass input" for="password">Password</label>
                                        <input type="password" name="password" id="password" class="lwa_user_pass input"
                                           placeholder="" placeholder="Enter your password" onblur="validateField(this)" />
                                        <small class="error-message text-danger" id="password-error"></small>
                                    </label>

                                    <label>
                                        <label class="lwa_user_pass input" for="password_confirmation">Confirm Password</label>
                                        <input type="password" name="password_confirmation" id="confirmPasswordInput"
                                            class="lwa_user_pass input"placeholder="" placeholder="Confirm your password"
                                            onblur="validateField(this)" />
                                        <small class="error-message text-danger" id="confirmPassword-error"></small>
                                    </label>

                                    <button class="lwa_wp-submit a btn btn-sm" type="submit">Create Account</button>

                                    <input type="hidden" name="browser_mobile" id="browser_mobile" value="1" />
                                </form>
                            </div>

                            <div class="container text-center">
                              
                                <div>
                                    <a href="{{ route('google-auth') }}"
                                        class="full-width-button  login-with-google-btn d-block my-2 mx-1">
                                        &nbsp; Sign in with Google
                                    </a>
                                   
                                </div>
                            </div>
                        </div>
                        <div class='footer-nav '>
                            <small>
                                Already have an account? <a href="{{ route('login') }}"><b>Sign In</b></a> Or <a
                                    href="{{ route('guest-home') }}"><b>Continue as Guest</b></a>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/65a0c2458d261e1b5f523041/1hjtvdo8t';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->
    <script src="{{ asset('assets/tripleseat/d12lx3pio9mr3b.cloudfront.net/assets/01/jquery_bundle-16319aafdbe0f8e90b79c96663d5f937405614f2aa47071526a39a63a437170c.js') }}"
        crossorigin="anonymous"></script>
    <script src="{{ asset('assets/tripleseat/d12lx3pio9mr3b.cloudfront.net/assets/01/rails-3b92853778d4282132e4be897e0d4e173a9163595e5e9907bc7f0e31b21f1f3d.js') }}"
        crossorigin="anonymous"></script>

    <script>
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('confirmPasswordInput');
        // const passwordToggleIcon = document.getElementById('passwordToggleIcon');
        // const confirmPasswordToggleIcon = document.getElementById('confirmPasswordToggleIcon');
        // const togglePassword = document.getElementById('togglePassword');
        // const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');

        // function togglePasswordVisibility(input, toggleButton, toggleIcon) {
        //     if (input.type === 'password') {
        //         input.type = 'text';
        //         toggleIcon.classList.remove('fa-eye');
        //         toggleIcon.classList.add('fa-eye-slash');
        //     } else {
        //         input.type = 'password';
        //         toggleIcon.classList.remove('fa-eye-slash');
        //         toggleIcon.classList.add('fa-eye');
        //     }
        // }

        // togglePassword.addEventListener('click', function() {
        //     togglePasswordVisibility(passwordInput, togglePassword, passwordToggleIcon);
        // });

        // toggleConfirmPassword.addEventListener('click', function() {
        //     togglePasswordVisibility(confirmPasswordInput, toggleConfirmPassword, confirmPasswordToggleIcon);
        // });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        // Phone number input mask
        $('#phone').mask('(999) 999-9999');

        // Validation on textbox leave event
        $('input').on('blur', function() {
            validateField($(this));
        });

        // Form submission validation
        $('#registration-form').on('submit', function(e) {
            e.preventDefault();
            let valid = true;
            $('input').each(function() {
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
            const fieldName = input?.attr('name');
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
            // Name field validation (no special characters)
            if (fieldName === 'phone') {
                const phoneNumberPattern = /^\(\d{3}\) \d{3}-\d{4}$/;

                if (!phoneNumberPattern.test(value)) {
                    errorContainer.text('Enter a valid phone number (e.g., (123) 456-7890)');
                    return false;
                }

            }
            if (fieldName === 'email') {
                const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

                if (!emailPattern.test(value)) {
                    errorContainer.text('Enter a valid email address.');
                    return false;
                }
            }

            // Password and Confirm Password validation
            if (fieldName === 'password' || fieldName === 'confirmPasswordInput') {
                const password = $('#password').val();
                const confirmPassword = $('#confirmPasswordInput').val();
                if (password !== confirmPassword) {
                    errorContainer.text('Passwords do not match.');
                    return false;
                }
                if(password.length<8){
                    errorContainer.text('Password Must Contain 8 Chracters With Numbers.');
                    return false;
                }
            }
           

            return true;
        }
    </script>
<script>
    // Phone number input mask
    $('#phone').mask('(999) 999-9999');

    // Validation on textbox leave event
    $('input').on('blur', function() {
        validateField($(this));
    });

    // Form submission validation
    $('#registration-form').on('submit', function(e) {
        e.preventDefault();
        let valid = true;
        $('input').each(function() {
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
        // Name field validation (no special characters)
        if (fieldName === 'phone') {
            const phoneNumberPattern = /^\(\d{3}\) \d{3}-\d{4}$/;

            if (!phoneNumberPattern.test(value)) {
                errorContainer.text('Enter a valid phone number (e.g., (123) 456-7890)');
            }

        }
        if (fieldName === 'email') {
            const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

            if (!emailPattern.test(value)) {
                errorContainer.text('Enter a valid email address.');
            }
        }

        // Password and Confirm Password validation
        if (fieldName === 'password' || fieldName === 'confirmPasswordInput') {
            const password = $('#password').val();
            const confirmPassword = $('#confirmPasswordInput').val();
            if (password !== confirmPassword) {
                errorContainer.text('Passwords do not match.');
                return false;
            }
            if(password.length<8){
                errorContainer.text('Password Must Contain 8 Chracters With Numbers.');
                return false;
            }
        }
       

        return true;
    }
</script>
<script
src="{{ asset('assets/tripleseat/d12lx3pio9mr3b.cloudfront.net/assets/01/jquery_bundle-16319aafdbe0f8e90b79c96663d5f937405614f2aa47071526a39a63a437170c.js') }}"
crossorigin="anonymous"></script>
<script
src="{{ asset('assets/tripleseat/d12lx3pio9mr3b.cloudfront.net/assets/01/rails-3b92853778d4282132e4be897e0d4e173a9163595e5e9907bc7f0e31b21f1f3d.js') }}"
crossorigin="anonymous"></script>


</body>

</html>
