<!-- Bootstrap css -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css  ">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- Icons css -->
<link href="{{ asset('../assets/plugins/web-fonts/icons.css') }}" rel="stylesheet" />
<link href="{{ asset('../assets/plugins/web-fonts/font-awesome/font-awesome.min.css') }}" rel="stylesheet" />
<link href="{{ asset('../assets/plugins/web-fonts/plugin.css') }}" rel="stylesheet" />

<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.css') }}" rel="stylesheet" />

<link href="{{ asset('assets/plugins/datatable/css/buttons.bootstrap5.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/datatable/css/responsive.bootstrap5.css') }}" rel="stylesheet" />

<link href="{{ asset('assets/bootstrap-datepicker-css/bootstrap-datepicker.css') }}" />
<link href="{{ asset('assets/bootstrap-datepicker-css/bootstrap-datepicker.css.map') }}" />

<!-- Style css -->
<!-- Select2 css -->
<link href="{{ asset('../assets/plugins/treeview/treeview.css') }}"rel="stylesheet" />
<link href="{{ asset('../assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

<!-- Mutipleselect css -->
<link rel="stylesheet" href="{{ asset('../assets/plugins/multipleselect/multiple-select.css') }}">

<link href="{{ asset('../assets/css/social.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
    integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
<link id="style" href="{{ asset('../assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
<link id="style" href="{{ asset('assets/bootstrap-datepicker-css/bootstrap-datepicker.css') }}" rel="stylesheet" />
<link id="style" href="{{ asset('assets/css/timepicker.css') }}" rel="stylesheet" />
<link href="{{ asset('../assets/css/style.css') }}" rel="stylesheet">


<style>
    /* Styling the toast container */
    .main-footer.text-center {
        z-index: 99;
    }

    .toast {
        position: fixed;
        right: 10px;
        top: 10px;
        background-color: #333;
        color: #fff;
        border-radius: 5px;
        padding: 10px;
        max-width: 300px;
        z-index: 9999;
        display: block;
        opacity: 1;
    }

    /* Styling the toast message text */
    .toast-message {
        font-size: 14px;
    }

    /* Styling the toast progress bar */
    .toast-progress {
        height: 4px;
        background-color: #006d6d;
        width: 0;
    }

    /* Styling the close button */
    .toast-close-button {
        position: absolute;
        top: 5px;
        right: 5px;
        background-color: transparent;
        color: #fff;
        border: none;
        cursor: pointer;
        font-size: 18px;
    }

    /* Hover effect for close button */
    .toast-close-button:hover {
        color: #ff0000;
    }

    /* Styling for a Success Toast */
    .toast.toast-success {
        background-color: #4caf50 !important;
        /* Green */
    }

    /* Styling for a Warning Toast */
    .toast.toast-warning {
        background-color: #ff9800 !important;
        /* Orange */
    }

    /* Styling for an Info Toast */
    .toast.toast-info {
        background-color: #2196f3 !important;
        /* Blue */
    }

    /* Styling for an Error Toast */
    .toast.toast-error {
        background-color: #f44336 !important;
        /* Red */
    }


    .btn-primary,
    .btn-main-primary {
        background-color: #fc7b03 !important;
        border: 0px !important;
        padding: 8px 30px;
    }

    .btn-primary:hover,
    .btn-main-primary:hover {
        background-color: #c76305 !important;
        box-shadow: 0px 0px 2px #07040078 !important
    }

    .btn-primary:focus,
    .btn-main-primary:focus {
        background-color: #c76305 !important;
        box-shadow: 0px 0px 2px #07040078 !important
    }

    .btn {
        text-transform: capitalize;
    }

    button.fc-today-button.fc-button.fc-button-primary,
    button.fc-button.fc-button-primary {
        text-transform: capitalize;
    }

    label {
        font-weight: 500;
    }

    .main-notification-list .media.new {
        background: #fff5e9;
    }
</style>
