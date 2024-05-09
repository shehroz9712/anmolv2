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
    <link href="{{ asset('assets/tripleseat/d12lx3pio9mr3b.cloudfront.net/marketing_site/style.css') }}"
        id='base-style-css' media='all' rel='stylesheet' type='text/css'>
    <script
        src="{{ asset('assets/tripleseat/d12lx3pio9mr3b.cloudfront.net/assets/01/jquery_bundle-16319aafdbe0f8e90b79c96663d5f937405614f2aa47071526a39a63a437170c.js') }}"
        crossorigin="anonymous"></script>
    <script
        src="{{ asset('assets/tripleseat/d12lx3pio9mr3b.cloudfront.net/assets/01/rails-3b92853778d4282132e4be897e0d4e173a9163595e5e9907bc7f0e31b21f1f3d.js') }}"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


</head>



<body class=" ltr  main-body leftmenu error-1 ">
    <div class='wrapper'>
        <main class='main' id='main'>
            <div class='bg-black login-holder'>
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
                                <a class='btn' href="{{ route('login') }}"><small style="font-size:16px">Sign
                                        In</small></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='login-block'>
                    <div class='container'>
                        <div class='form-holder'>
                            <div class='logo'>
                                <a href='{{ route('login') }}' style="">
                                    <img alt='logo' src='{{ asset('assets/img/brand/logo-light.png') }}'>
                                </a>
                            </div>

                            <div class='login-form'>
                                <h2>Create an Account</h2>

                                <form class="sign-form lwa-form" id="registration-form"
                                    action="{{ route('register') }}" method="POST">
                                    @csrf
                                    <label>
                                        <label class="lwa_user_login" for="name">Name</label>
                                        <input type="text" name="name" id="name" class="lwa_user_login"
                                            placeholder="" placeholder="Enter Your Name" autofocus="autofocus"
                                            onblur="validateField(this)" />
                                        <small class="text-danger" id="name-error"></small>
                                    </label>

                                    <label>
                                        <label class="lwa_user_login" for="phone">Phone Number</label>
                                        <input type="text" name="phone" id="phone" class="lwa_user_login"
                                            placeholder="" placeholder="Enter Your Phone Number"
                                            onblur="validateField(this)" />
                                        <small class="text-danger" id="phone-error"></small>
                                    </label>

                                    <label>
                                        <label class="lwa_user_login" for="email">Email Address</label>
                                        <input type="text" name="email" id="email" class="lwa_user_login"
                                            placeholder="" placeholder="Enter Your Email"
                                            onblur="validateField(this)" />
                                        <small class="text-danger" id="email-error"></small>
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                    </label>

                                    <label>
                                        <label class="lwa_user_pass input" for="password">Password</label>
                                        <input type="password" name="password" id="password"
                                            class="lwa_user_pass input" placeholder="" placeholder="Enter your password"
                                            onblur="validateField(this)" />
                                        <small class="error-message text-danger" id="password-error"></small>
                                    </label>

                                    <label>
                                        <label class="lwa_user_pass input" for="password_confirmation">Confirm
                                            Password</label>
                                        <input type="password" name="password_confirmation" id="confirmPasswordInput"
                                            class="lwa_user_pass input"placeholder=""
                                            placeholder="Confirm your password" onblur="validateField(this)" />
                                        <small class="error-message text-danger" id="confirmPassword-error"></small>
                                    </label>

                                    <button class="lwa_wp-submit a btn btn-sm" type="submit">Create Account</button>

                                    <input type="hidden" name="browser_mobile" id="browser_mobile"
                                        value="1" />
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
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/65a0c2458d261e1b5f523041/1hjtvdo8t';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
    <script
        src="{{ asset('assets/tripleseat/d12lx3pio9mr3b.cloudfront.net/assets/01/jquery_bundle-16319aafdbe0f8e90b79c96663d5f937405614f2aa47071526a39a63a437170c.js') }}"
        crossorigin="anonymous"></script>
    <script
        src="{{ asset('assets/tripleseat/d12lx3pio9mr3b.cloudfront.net/assets/01/rails-3b92853778d4282132e4be897e0d4e173a9163595e5e9907bc7f0e31b21f1f3d.js') }}"
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
                if (password.length < 8) {
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
                if (password.length < 8) {
                    errorContainer.text('Password Must Contain 8 Chracters With Numbers.');
                    return false;
                }
            }


            return true;
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script
        src="{{ asset('assets/tripleseat/d12lx3pio9mr3b.cloudfront.net/assets/01/jquery_bundle-16319aafdbe0f8e90b79c96663d5f937405614f2aa47071526a39a63a437170c.js') }}"
        crossorigin="anonymous"></script>
    <script
        src="{{ asset('assets/tripleseat/d12lx3pio9mr3b.cloudfront.net/assets/01/rails-3b92853778d4282132e4be897e0d4e173a9163595e5e9907bc7f0e31b21f1f3d.js') }}"
        crossorigin="anonymous"></script>
    @if (Session::has('message'))
        toastr.options = {
        "closeButton": true,
        "progressBar": true
        }
        toastr.success("{{ session('message') }}");
    @endif

    @if (Session::has('error'))
        toastr.options = {
        "closeButton": true,
        "progressBar": true
        }
        toastr.error("{{ session('error') }}");
    @endif

    @if (Session::has('info'))
        toastr.options = {
        "closeButton": true,
        "progressBar": true
        }
        toastr.info("{{ session('info') }}");
    @endif

    @if (Session::has('warning'))
        toastr.options = {
        "closeButton": true,
        "progressBar": true
        }
        toastr.warning("{{ session('warning') }}");
    @endif

</body>

</html>
