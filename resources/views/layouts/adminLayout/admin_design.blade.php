
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset("backendassets/images/favicon.png") }}">
    <title>@yield('title')</title>
    <!-- Custom CSS -->
    <link href="{{asset("backendassets/libs/flot/css/float-chart.css")}}" rel="stylesheet">
    <link href="{{asset("css/habilitations.css")}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{asset("backendassets/libs/bootstrap/dist/css/bootstrap.min.css")}}" rel="stylesheet">
    <link href=" {{ asset("backenddist/css/style.min.css") }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset("backendassets/libs/quill/dist/quill.snow.css")}}">
    
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.32.4/sweetalert2.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{asset("backendassets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css")}}">

    <!-- Custom CSS Of table-->
    <link href="{{asset("backendassets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css")}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset("backendassets/libs/select2/dist/css/select2.min.css")}}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<style>

input {
    width: 300px;
}
 
.show-password {
    font-size: 9px;
    text-transform: uppercase;
    position: absolute;
    cursor: pointer;
    margin-left: -48px;
}
    </style>
</head>
<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->

    <div id="main-wrapper">

        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        @include('layouts.adminLayout.admin_header')
        <!-- ============================================================== -->
        <!-- End Topbar header -->

        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        @include('layouts.adminLayout.admin_sidebar')
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
         <div class="page-wrapper">
            <!--Dashboard -->
            @yield('content')
            <!--End Dashboard -->

            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
             {{-- @include('layouts.adminLayout.admin_footer')--}}
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
		</div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->

    </div>

    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ asset("backendassets/libs/jquery/dist/jquery.min.js")}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset("backendassets/libs/popper.js/dist/umd/popper.min.js")}}"></script>
    <script src="{{ asset("backendassets/libs/bootstrap/dist/js/bootstrap.min.js")}}"></script>
    <script src="{{ asset("backendassets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js")}}"></script>
    <script src="{{ asset("backendassets/extra-libs/sparkline/sparkline.js")}}"></script>
    <!--Wave Effects -->
    <script src="{{ asset("backenddist/js/waves.js")}}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset("backenddist/js/sidebarmenu.js")}}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset("backenddist/js/custom.min.js")}}"></script>
    <!--This page JavaScript -->
    <!-- <script src="../../dist/js/pages/dashboards/dashboard1.js")}}"></script> -->
    <!-- Charts js Files -->
    <script src="{{ asset("backendassets/libs/flot/excanvas.js")}}"></script>
    <script src="{{ asset("backendassets/libs/flot/jquery.flot.js")}}"></script>
    <script src="{{ asset("backendassets/libs/flot/jquery.flot.pie.js")}}"></script>
    <script src="{{ asset("backendassets/libs/flot/jquery.flot.time.js")}}"></script>
    <script src="{{ asset("backendassets/libs/jquery-validation/dist/jquery.validate.min.js")}}"></script>
    <script src="{{ asset("backendassets/libs/chart/matrix.form_validation.js")}}"></script>
    <script src="{{ asset("backendassets/libs/flot/jquery.flot.stack.js")}}"></script>
    <script src="{{ asset("backendassets/libs/flot/jquery.flot.crosshair.js")}}"></script>
    <script src="{{ asset("backendassets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js")}}"></script>
    <script src="{{ asset("backenddist/js/pages/chart/chart-page-init.js")}}"></script>
    <script src="{{ asset("backendassets/libs/quill/dist/quill.min.js")}}"></script>
    <script src="{{ asset("backendassets/libs/select2/dist/js/select2.full.min.js")}}"></script>
    <script src="{{ asset("backendassets/libs/select2/dist/js/select2.min.js")}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.32.4/sweetalert2.all.js"></script>


    <!-- Custom Script Of table-->

    <script src="{{ asset("backendassets/extra-libs/DataTables/datatables.js")}}"></script>
    <script src="{{ asset("js/datepicker-fr.js")}}"></script>
  
    @yield('footer_scripts')

    @include('flashy::message')
    @include('sweet::alert')
</body>

</html>
