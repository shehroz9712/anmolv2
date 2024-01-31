
<!DOCTYPE html>
<html lang="en-US">

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
    <title>Admin Panel - Eat Anmol</title>
    <link rel="stylesheet" media="screen"
        href="{{ asset('assets/tripleseat/d12lx3pio9mr3b.cloudfront.net/assets/01/fa_bundle-c4bdd483be2b1dae791c0b3cb38bdbe27f559eac1b9a55c950cf64b858ac1882.css') }}" />
        <link href="{{ asset('assets/tripleseat/d12lx3pio9mr3b.cloudfront.net/marketing_site/style.css') }}" id='base-style-css'
        media='all' rel='stylesheet' type='text/css'>
    <script src="{{ asset('assets/tripleseat/d12lx3pio9mr3b.cloudfront.net/assets/01/jquery_bundle-16319aafdbe0f8e90b79c96663d5f937405614f2aa47071526a39a63a437170c.js') }}"
        crossorigin="anonymous"></script>
    <script src="{{ asset('assets/tripleseat/d12lx3pio9mr3b.cloudfront.net/assets/01/rails-3b92853778d4282132e4be897e0d4e173a9163595e5e9907bc7f0e31b21f1f3d.js') }}"
        crossorigin="anonymous"></script>
    

    </head>

<body>
    <div class='wrapper'>
        <main class='main' id='main'>
            <div class='login-holder'>
                <div class='intro-section'>
                    <div class='bg-img' style="background-image: url({{ asset('assets/img/media/signinpage.jpg') }});">
                    </div>
                    <div class='intro'>
                        <div class='container'>
                            <h1>Sign In to Eat Anmol</h1>
                            <p>Get ready to embark on a hassle-free journey to delicious meals. Eat Anmol's platform
                                offers you the power to explore, order, and enjoy your favorite cuisines, all at your
                                fingertips.</p>
                            {{-- <div class='btn-hold'>
                                <a class='btn' href="{{ route('register') }}"><small>Create An Account</small></a>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class='login-block'>
                    <div class='container'>
                        <div class='form-holder'>
                            <div class='logo'>
                                <a href='login.html'
                                    style="filter: invert(50%) hue-rotate(180deg) brightness(200%)">
                                    <img alt='logo' src='{{ asset('assets/img/brand/logo.png') }}'>
                                </a>
                            </div>

                            <div class='login-form'>
                                <h2>Admin Panel Sign In</h2>

                                <form class="sign-form lwa-form" action="{{ route('admin.login') }}" method="POST"
                                    onsubmit="return validateForm()">
                                    @csrf
                                    <label>
                                        <label class="lwa_user_login" for="login">Email Address</label>
                                        <input type="text" name="email" id="login" class="lwa_user_login"
                                            placeholder="" placeholder="Enter Your Email" autofocus="autofocus"
                                             />
                                        <small class="text-danger" id="email-error"></small>
                                        @if ($errors->has('email'))
                                        <small class="text-danger">{{ $errors->first('email') }}</small>
                                    @endif
                                    </label>

                                    <label>
                                        <label class="lwa_user_pass input" for="password">Password</label>
                                        <input type="password" name="password" id="password"
                                            class="lwa_user_pass input" placeholder="" placeholder="Enter your password"
                                             />
                                        <small class="error-message text-danger" id="password-error"></small>
                                    </label>

                                    <label class='check'>
                                        <input type="checkbox" name="remember_me" id="remember_me" value="1"
                                            checked="checked" />
                                        <span class='fake-checkbox'></span>
                                        <span class='label' for='remember_me'>Remember me?</span>
                                    </label>

                                    <div class='row mb-2 ' style="gap: 0px">
                                        <div class="col-6">
                                            {{-- <a class="password lwa-links-remember"
                                                href="{{ route('password.request') }}">Forgot Password?</a> --}}

                                        </div>
                                        <div class="col-6 text-end">
                                            <button class="lwa_wp-submit a btn btn-sm" type="submit">Sign In As Admin</button>

                                            <input type="hidden" name="browser_mobile" id="browser_mobile" value="1" />

                                        </div>
                                    </div>
                                    <small class="text-danger" id="auth-error"></small>
                                </form>
                            </div>
                            {{-- <div class="container text-center">
                                <div>
                                    <a href="{{ route('google-auth') }}"
                                        class="full-width-button  login-with-google-btn d-block my-2 mx-1">
                                        &nbsp; Sign in with Google
                                    </a>
                                    <a href="{{ url('auth/apple') }}"
                                        class="full-width-button  login-with-apple-btn d-block my-2 mx-1">
                                        &nbsp; Sign in with Apple
                                    </a>
                                </div>

                            </div> --}}

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
    <script
        src="{{ asset('assets/tripleseat/d12lx3pio9mr3b.cloudfront.net/assets/01/jquery_bundle-16319aafdbe0f8e90b79c96663d5f937405614f2aa47071526a39a63a437170c.js') }}"
        crossorigin="anonymous"></script>
    <script
        src="{{ asset('assets/tripleseat/d12lx3pio9mr3b.cloudfront.net/assets/01/rails-3b92853778d4282132e4be897e0d4e173a9163595e5e9907bc7f0e31b21f1f3d.js') }}"
        crossorigin="anonymous"></script>

    <script>
        function validateEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        function validateField(input) {
            const fieldName = input.name;
            const value = input.value;
            const errorContainer = document.getElementById(`${fieldName}-error`);

            switch (fieldName) {
                case 'email':
                    if (!validateEmail(value)) {
                        errorContainer.textContent = 'Invalid email format.';
                    } else {
                        errorContainer.textContent = '';
                    }
                    break;
                case 'password':
                    if (value.length < 8) {
                        errorContainer.textContent = 'Password must be at least 8 characters long.';
                    } else {
                        errorContainer.textContent = '';
                    }
                    break;
                // Add other cases for additional fields if needed
            }
        }

        function validateForm() {
            const emailInput = document.getElementById('login');
            const passwordInput = document.getElementById('password');
            const emailError = document.getElementById('email-error');
            const passwordError = document.getElementById('password-error');
            const authError = document.getElementById('auth-error');

            // Validate email
            const emailValue = emailInput.value;
            if (!validateEmail(emailValue)) {
                emailError.textContent = 'Invalid email format.';
                authError.textContent = '';
                return false;
            } else {
                emailError.textContent = '';
            }

            // Validate password
            const passwordValue = passwordInput.value;
            if (passwordValue.length < 8) {
                passwordError.textContent = 'Password must be at least 8 characters long.';
                authError.textContent = '';
                return false;
            } else {
                passwordError.textContent = '';
            }

            // Additional validation logic can be added here if needed

            // Clear authentication error
            authError.textContent = '';

            return true;
        }
    </script>
</body>

</html>

