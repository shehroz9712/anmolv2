<!DOCTYPE html>
<html lang="en" id="demo">

<head>

	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
	<meta name="description" content="Spruha -  Admin Panel HTML Dashboard Template">
	<meta name="author" content="Spruko Technologies Private Limited">
	<meta name="keywords"
		content="admin,dashboard,panel,bootstrap admin template,bootstrap dashboard,dashboard,themeforest admin dashboard,themeforest admin,themeforest dashboard,themeforest admin panel,themeforest admin template,themeforest admin dashboard,cool admin,it dashboard,admin design,dash templates,saas dashboard,dmin ui design">

	<!-- Favicon -->
	<link rel="icon" href="{{asset('../assets/img/brand/favicon.ico')}}" type="image/x-icon" />
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<!-- Title -->
	<title>

		@yield('title')
	</title>

	@include('Dashboard.Includes.stylesheets')
@yield('stylesheet')
</head>

<body class="ltr main-body leftmenu">

	<!-- Loader -->
	<div id="global-loader">
		<img src="{{asset('../assets/img/loader.svg')}}" class="loader-img" alt="Loader">
	</div>
	<!-- End Loader -->


	<!-- Page -->
	<div class="">

		<!-- Main Header-->
		@include('Dashboard.Includes.header');
		<!-- End Main Header-->

		<!-- Sidemenu -->
		@include('Dashboard.Includes.sidemenu')
		<!-- End Sidemenu -->

		<!-- Main Content-->
	<div class="main-content side-content pt-0">

		<div class="main-container container-fluid">
			<div class="inner-body">
				@yield('content')
		</div>
</div>
</div>
	<!-- End Page -->
	<div class="main-footer text-center" style="bottom: 0px; position: fixed;width:100% ">
		<div class="container">
			<div class="row row-sm">
				<div class="col-md-12">
					<span>Developed  by Cloudscourt 2023 - {{ date('Y') }}, All rights reserved.</span>
				</div>
			</div>
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
	</div>
	<!-- Back-to-top -->
	<a href="#top" id="back-to-top"><i class="fe fe-arrow-up"></i></a>
@include('Dashboard.Includes.scripts')
@yield('js')
<!-- Modal: "guestSignOutModal" -->
<div class="modal fade" id="guestSignOutModal" tabindex="-1" aria-labelledby="guestSignOutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="guestSignOutModalLabel">Warning</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Your data will be lost if you sign out as a Guest. Are you sure you want to sign out?</p>
            </div>
            <div class="modal-footer">
                <button  class="btn btn-primary" type="button" id="showRegistrationButton">Convert To User</button>
                <a class="btn btn-danger" href="{{ route('GuestLogout') }}"
                   >Sign Out</a>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="registrationFormModal" tabindex="-1" aria-labelledby="registrationFormModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="registrationFormModalLabel">Registration Form</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
				<form method="POST" action="{{ route('Convert2User') }}">
					@csrf
					<div class="d-flex-text-center">
						<form id="registrationForm" method="POST" action="{{ route('Convert2User') }}" style="display: none">
							@csrf
							<div class="form-group text-start">
								<label>Name</label>
								<input class="form-control" placeholder="John Doe" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
							</div>

							<div class="form-group text-start">
								<label>Phone Number</label>
								<input class="form-control" placeholder="+1 (555) 123-4567" type="text" name="phone" value="{{ old('phone') }}" required autofocus autocomplete="phone">
							</div>
							<div class="form-group text-start">
								<label>Email</label>
								<input class="form-control" placeholder="john.doe@example.com" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
							</div>
							<div class="form-group text-start">
								<label>Password</label>
								<div class="input-group">
									<input class="form-control" type="password" name="password" id="passwordInput" placeholder="Enter your password">
									<div class="input-group-append">
										<button class="btn btn-toggle-password" type="button" id="togglePassword">
											<i class="fa fa-eye" id="passwordToggleIcon"></i>
										</button>
									</div>
								</div>
							</div>

							<div class="form-group text-start">
								<label>Confirm Password</label>
								<div class="input-group">
									<input class="form-control" type="password" name="password_confirmation" id="confirmPasswordInput" placeholder="Confirm your password">
									<div class="input-group-append">
										<button class="btn btn-toggle-password" type="button" id="toggleConfirmPassword">
											<i class="fa fa-eye" id="confirmPasswordToggleIcon"></i>
										</button>
									</div>
								</div>
							</div>

							<button class="btn ripple btn-main-primary btn-block">Convert Account & Logout</button>
						</form>
					</div>
				</form>

            </div>
        </div>
    </div>
</div>
<script>
    const showRegistrationButton = document.getElementById('showRegistrationButton');

    showRegistrationButton.addEventListener('click', function() {
        $('#registrationFormModal').modal('show'); // Show the nested registration modal
    });
</script>

</body>

</html>
