<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'E-Commerce')</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('dashboard/img/G1.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Noto+Sans+Khmer:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Remix icon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <!-- Datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <!-- Moment.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <!-- Dashboard -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/styles.min.css') }}">
    <!-- Summernote -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <!-- Custom Style -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Custom Dashboard -->
    <link rel="stylesheet" href="{{ asset('css/custom-dashboard/style.css') }}">
    <!-- Scwitch Button -->
    <link rel="stylesheet" href="{{ asset('css/switch-botton/style.css') }}">
</head>

<body class="bg-light">
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        @include('layouts.sidebar')

        <div class="body-wrapper">
            @include('layouts.navbar')

            @yield('content')

            <p class="text-center">Copyright &copy; {{ date('Y') }} G1E1Y4G24</p>
        </div>
    </div>

    <div id="pageLoading">
        <div class="loading">
            <span class="spinner-border text-light" aria-hidden="true"></span>
        </div>
    </div>
</body>
<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>
<!-- Sweet Alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Datatable -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.13.7/api/sum().js"></script>

<!-- Dashbaord -->
<script src="{{ asset('dashboard/assets/js/sidebarmenu.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/app.min.js') }}"></script>

<!-- ChartJS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Custome Script -->
<script src="{{ asset('js/script.js') }}"></script>
<!-- Specific Scripts -->
@yield('script')

</html>
