<meta charset="UTF-8">
<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="X-UA-Compatible" content="IE=9" />
{{-- <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
<meta name="Author" content="Spruko Technologies Private Limited">
<meta name="Keywords" content="admin,admin dashboard,admin dashboard template,admin panel template,admin template,admin theme,bootstrap 4 admin template,bootstrap 4 dashboard,bootstrap admin,bootstrap admin dashboard,bootstrap admin panel,bootstrap admin template,bootstrap admin theme,bootstrap dashboard,bootstrap form template,bootstrap panel,bootstrap ui kit,dashboard bootstrap 4,dashboard design,dashboard html,dashboard template,dashboard ui kit,envato templates,flat ui,html,html and css templates,html dashboard template,html5,jquery html,premium,premium quality,sidebar bootstrap 4,template admin bootstrap 4"/> --}}

<!-- Title -->
<title> {{ config('app.name', 'Laravel') }} - @yield('title')</title>

<!-- Favicon -->
<link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon" />

<!-- Icons css -->
<link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">

<!--  Owl-carousel css-->
<link href="{{ asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" />

<!--- Internal Sweet-Alert css-->
<link href="{{ asset('assets/plugins/sweet-alert/sweetalert.css') }}" rel="stylesheet"><!-- P-scroll bar css-->
<link href="{{ asset('assets/plugins/perfect-scrollbar/p-scrollbar.css') }}" rel="stylesheet" />
<!-- Internal Data table css -->
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">



<!-- Maps css -->
<link href="{{ asset('assets/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet">

<!--  Right-sidemenu css -->
<link href="{{ asset('assets/plugins/sidebar/sidebar.css') }}" rel="stylesheet">

<!-- Sidemenu css -->
<link rel="stylesheet" href="{{ asset('assets/admin_css/closed-sidemenu.css') }}">
<link href="{{ asset('assets/admin_css/style.css') }}" rel="stylesheet">
<link href="{{ asset('assets/admin_css/style-dark.css') }}" rel="stylesheet">


<!---Skinmodes css-->
<link href="{{ asset('assets/css/skin-modes.css') }}" rel="stylesheet" />
	<!--Internal  Datetimepicker-slider css -->
    <link href="{{ asset('assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/pickerjs/picker.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/css/jquery.signature.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/jquery-ui.css') }}" rel="stylesheet">

<style>
    .invalid-feedback {
        display: block;
    }
    table i{
        margin-left: 5px;
    }
    table.dataTable tbody td {
        font-size: 12px;
    }
</style>
