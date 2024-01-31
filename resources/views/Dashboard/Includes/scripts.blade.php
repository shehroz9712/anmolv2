<!-- Jquery js -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap js -->
<script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

<!-- Internal Chart.Bundle js -->
<script src="{{ asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>

<!-- Peity js -->
<script src="{{ asset('assets/plugins/peity/jquery.peity.min.js') }}"></script>

<!-- Select2 js -->
<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/select2.js') }}"></script>

<!-- Perfect-scrollbar js -->
<script src="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

<!-- Sidemenu js -->
<script src="{{ asset('assets/plugins/sidemenu/sidemenu.js') }}"></script>

<!-- Sidebar js -->
<script src="{{ asset('assets/plugins/sidebar/sidebar.js') }}"></script>

<!-- Internal Morris js -->
<script src="{{ asset('assets/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('assets/plugins/morris.js/morris.min.js') }}"></script>

<!-- Circle Progress js -->
<script src="{{ asset('assets/js/circle-progress.min.js') }}"></script>
<script src="{{ asset('assets/js/chart-circle.js') }}"></script>

<!-- Internal Dashboard js -->
<script src="{{ asset('assets/js/index.js') }}"></script>

<!-- Color Theme js -->
<script src="{{ asset('assets/js/themeColors.js') }}"></script>

<!-- Sticky js -->
<script src="{{ asset('assets/js/sticky.js') }}"></script>

<!-- Custom js -->
<script src="{{ asset('assets/js/custom.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="{{ URL::asset('assets/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script> 
<script src="{{ URL::asset('assets/plugins/treeview/treeview.js') }}"></script> 

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script src="{{ URL::asset('assets/js/clockpicker.min.js') }}"></script> 

<script>
	
 function myfunction(){
	
    window.history.pushState({}, '', '/');
    window.history.forward();
	
	}
	window.addEventListener('popstate', function () {
		
		window.history.pushState({}, '', '/');
    window.history.forward();
});
</script>

<script>
	// debugger
    @if(Session::has('message'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.success("{{ session('message') }}");
  @endif

  @if(Session::has('error'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.error("{{ session('error') }}");
  @endif

  @if(Session::has('info'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.info("{{ session('info') }}");
  @endif

  @if(Session::has('warning'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.warning("{{ session('warning') }}");
  @endif
  
  $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

</script>