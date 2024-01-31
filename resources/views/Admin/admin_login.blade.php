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
    <title>Spruha - Bootstrap Premium HTML Dashboard Template</title>
    @include('Dashboard.Includes.stylesheets')
    <link rel="stylesheet" href="../assets/css/signin.css" />
    <style>
        @media (max-width: 1299px) and (min-width: 991px) {
            .admin-signpages {
                width: 60%;
                border-radius: 6px;
                margin: 5em auto;
                display: flex;
            }
        }
    </style>
</head>

<body class="ltr main-body leftmenu error-1">
    <div id="global-loader">
        <img src="../assets/img/loader.svg" class="loader-img" alt="Loader">
    </div>
    <div class="row admin-signpages signpages text-center">
        <div class="card">
            <div class="row row-sm">
                <div class="col-lg-6 col-xl-5 d-none d-lg-block text-center bg-primary details">
                    <div class="mt-5 pt-4 p-2 pos-absolute">
                        <img src="../assets/img/brand/logo-light.png"
                            class="d-lg-none header-brand-img text-start float-start mb-4 error-logo-light"
                            alt="logo">
                        <img src="../assets/img/brand/logo.png"
                            class=" d-lg-none header-brand-img text-start float-start mb-4 error-logo" alt="logo">
                        <div class="clearfix"></div>
                        <img src="../assets/img/svgs/user.svg" class="ht-100 mb-0" alt="user">
                        <h5 class="mt-4 text-white">Create Your Account</h5>
                        <span class="tx-white-6 tx-13 mb-5 mt-xl-0">Signup to create, discover and connect with the
                            global community</span>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-7 col-xs-12 col-sm-12 login_form">
                    <div class="main-container container-fluid">
                        <div class="row row-sm">
                            <div class="card-body mt-2 mb-2">
                                <!-- Content from your first code snippet -->
                                <div class="row text-center">
                                    <div class="col-md-12">
                                        <div class="card p-3" style="min-height: 100vh">
                                            <div class="row row-sm">
                                                <div class="w-100 col-lg-12 col-xl-12 col-xs-12 col-sm-12 login_form">
                                                    <div class="main-container container-fluid">
                                                        <div class="row row-sm">
                                                            <div class="card-body">
                                                                <!-- Login form from your second HTML code -->
                                                                <h5 class="text-start">Sign in to Your Account</h5>
                                                                <form method="POST" action="{{ route('login') }}">
                                                                    @csrf
                                                                    <div class="form-group text-start">
                                                                        <label>Email</label>
                                                                        <input class="form-control"
                                                                            placeholder="Enter Your Email"
                                                                            type="email" name="email">
                                                                    </div>
                                                                    <div class="form-group text-start">
                                                                        <label>Password</label>
                                                                        <div class="input-group">
                                                                            <input class="form-control" type="password"
                                                                                name="password" id="passwordInput"
                                                                                placeholder="Enter your password">
                                                                            <div class="input-group-append">
                                                                                <button
                                                                                    class="btn btn-outline-primary btn-toggle-password"
                                                                                    type="button" id="togglePassword">
                                                                                    <i class="fa fa-eye"
                                                                                        id="passwordToggleIcon"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group text-start">
                                                                        <label for="remember_me"
                                                                            class="inline-flex items-center">
                                                                            <input id="remember_me" type="checkbox"
                                                                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                                                                name="remember">
                                                                            <span
                                                                                class="ml-2 text-sm text-gray-600">Remember
                                                                                me</span>
                                                                        </label>
                                                                    </div>
                                                                    <button
                                                                        class="btn ripple btn-main-primary btn-block">Sign
                                                                        In</button>
                                                                </form>
                                                                <br>
                                                                <h5>Or</h5><br>
                                                                <div class="text-center">
                                                                    <a href="{{ route('google-auth') }}"
                                                                        class="full-width-button d-block login-with-google-btn m-2">
                                                                        &nbsp; Sign in with Google
                                                                    </a>
                                                                    <a href="{{ url('auth/apple') }}"
                                                                        class="full-width-button d-block login-with-apple-btn m-2">
                                                                        &nbsp; Sign in with Apple
                                                                    </a>
                                                                </div>
                                                                <div class="text-start ms-0">
                                                                    @if (Route::has('password.request'))
                                                                        <div class="mb-1"><a
                                                                                href="{{ route('password.request') }}">Forgot
                                                                                password?</a></div>
                                                                    @endif
                                                                    <div>Don't have an account? <a
                                                                            href="/register"><b>Register Here</b></a> Or
                                                                        <a href="{{ route('guest-home') }}"><b>Continue
                                                                                As Guest</b></a>
                                                                    </div>
                                                                </div>
                                                                <!-- End of the login form -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End of content from your first code snippet -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const passwordInput = document.getElementById('passwordInput');
        const passwordToggleIcon = document.getElementById('passwordToggleIcon');
        const togglePassword = document.getElementById('togglePassword');

        togglePassword.addEventListener('click', function() {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordToggleIcon.classList.remove('fa-eye');
                passwordToggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordToggleIcon.classList.remove('fa-eye-slash');
                passwordToggleIcon.classList.add('fa-eye');
            }
        });
    </script>

    @include('Dashboard.Includes.scripts')
</body>

</html>
