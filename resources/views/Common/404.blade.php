<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
		<meta name="description" content="Spruha -  Admin Panel HTML Dashboard Template">
		<meta name="author" content="Spruko Technologies Private Limited">
		<meta name="keywords" content="admin,dashboard,panel,bootstrap admin template,bootstrap dashboard,dashboard,themeforest admin dashboard,themeforest admin,themeforest dashboard,themeforest admin panel,themeforest admin template,themeforest admin dashboard,cool admin,it dashboard,admin design,dash templates,saas dashboard,dmin ui design">
@include('Dashboard.Includes.stylesheets')
<title>404 - Not Found </title>

	</head>

	<body class="ltr main-body leftmenu error-1">

		<!-- Loader -->
		<div id="global-loader">
			<img src="../assets/img/loader.svg" class="loader-img" alt="Loader">
		</div>
		<!-- End Loader -->

		<!-- Page -->
		<div class="page main-signin-wrapper bg-primary construction">

			<div class="container ">
				<div class="construction1 text-center details text-white">
					<div class="">
						<div class="col-lg-12">
							<h1 class="tx-140 mb-0">404</h1>
						</div>
						<div class="col-lg-12 ">
							<h1>Oops.The Page you are looking  for doesn't  exit..</h1>
							<h6 class="tx-15 mt-3 mb-4 text-white-50">You may have mistyped the address or the page may have moved. Try searching below.</h6>
							<a class="btn ripple btn-success text-center mb-2" href="javascript:history.go(-1)">Back to Previous Page</a>

						</div>
					</div>
				</div>
			</div>

		</div>
		@includeIf('Dashboard.Includes.scripts')
	</body>
</html>