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
                                                <h5 class="text-start">Forgot Your Password?</h5>
                                                <form method="POST" action="{{ route('password.email') }}">
                                                    @csrf
                                                    <div class="form-group text-start">
                                                        <label>Email</label>
                                                        <input class="form-control" placeholder="Enter your email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="email">
                                                        @if ($errors->has('email'))
                                                            <small class="alert alert-danger p-2">{{ $errors->first('email') }}</small>
                                                        @endif
                                                    </div>
                                                    <button class="btn ripple btn-main-primary btn-block">Email Password Reset Link</button>
                                                </form>
                                              
                                                </div>
                                                <div class="mysection text-start ms-0">
                                                    @if (Route::has('password.request'))
                                                        <div class="mb-1"><a
                                                                href="{{ route('password.request') }}">Forgot
                                                                password?</a></div><br>
                                                    @endif
                                                    <div>Don't have an account? <a href="/register"><b>Register
                                                                Here</b></a>
                                                        Or <a href="{{ route('guest-home') }}"><b>Continue As
                                                                Guest</b></a>
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
            </div>
        </div>
    </div>
    

    @include('Dashboard.Includes.scripts')
</body>

</html>
