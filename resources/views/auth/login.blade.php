<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>The Inventory</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('dashboard/img/G1.ico') }}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Noto+Sans+Khmer:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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
    <!-- Dashboard -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/styles.min.css') }}">
    <!-- Custom Style -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <div class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <svg id="Layer_2" width="180" data-name="Layer 2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 252.6 66.27">
                                        <defs><style>.cls-1 {fill: url(#linear-gradient-2);}.cls-2 {stroke: url(#radial-gradient-4);}.cls-2, .cls-3, .cls-4 {stroke-miterlimit: 10;}.cls-2, .cls-3, .cls-4, .cls-5 {fill: none;}.cls-3 {stroke: url(#radial-gradient-5);}.cls-6 {fill: url(#linear-gradient-6);}.cls-4 {stroke: url(#radial-gradient-3);}.cls-7 {fill: url(#radial-gradient);}.cls-8 {fill: url(#linear-gradient-5);}.cls-9 {fill: url(#radial-gradient-2);}.cls-10 {fill: url(#linear-gradient-3);}.cls-11 {fill: url(#linear-gradient);}.cls-12 {fill: url(#linear-gradient-4);}</style><linearGradient id="linear-gradient" x1="82.63" y1="-50.18" x2="228.36" y2="95.55" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#26beff"/><stop offset=".2" stop-color="#2893f8"/><stop offset=".59" stop-color="#2d44ed"/><stop offset=".86" stop-color="#2f13e5"/><stop offset="1" stop-color="#3100e3"/></linearGradient><radialGradient id="radial-gradient" cx="789.72" cy="401.09" fx="789.72" fy="401.09" r="46.81" gradientTransform="translate(465.07 -769.47) rotate(90)" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#26beff"/><stop offset=".2" stop-color="#2893f8"/><stop offset=".59" stop-color="#2d44ed"/><stop offset=".86" stop-color="#2f13e5"/><stop offset="1" stop-color="#3100e3"/></radialGradient><radialGradient id="radial-gradient-2" cx="44.13" cy=".81" fx="44.13" fy=".81" r="51.81" gradientTransform="translate(.24 1.56) rotate(-.14)" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#26d0ff"/><stop offset=".41" stop-color="#1495ff"/><stop offset=".81" stop-color="#0564ff"/><stop offset="1" stop-color="#0051ff"/></radialGradient><linearGradient id="linear-gradient-2" x1="44.89" y1="-9.59" x2="39.29" y2="31.9" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#26ffff"/><stop offset=".19" stop-color="#26ecff"/><stop offset=".73" stop-color="#26bbff"/><stop offset="1" stop-color="#26a8ff"/></linearGradient><linearGradient id="linear-gradient-3" x1="40.7" y1="39.28" x2="40.7" y2="-20.16" xlink:href="#linear-gradient-2"/><linearGradient id="linear-gradient-4" x1="49.51" y1="34.74" x2="83.52" y2="48.2" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#26d0ff"/><stop offset=".41" stop-color="#1495ff"/><stop offset=".81" stop-color="#0564ff"/><stop offset="1" stop-color="#0051ff"/></linearGradient><radialGradient id="radial-gradient-3" cx="48.99" cy="37.64" fx="48.99" fy="37.64" r="13.01" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#fff"/><stop offset=".4" stop-color="#f2efef"/><stop offset="1" stop-color="#e3dddd"/></radialGradient><linearGradient id="linear-gradient-5" x1="23.41" y1="45.84" x2="29.38" y2="71.14" xlink:href="#linear-gradient"/><linearGradient id="linear-gradient-6" x1="15.37" y1="39.11" x2="15.37" y2="6.64" xlink:href="#linear-gradient-2"/><radialGradient id="radial-gradient-4" cx="15.37" cy="26.81" fx="15.37" fy="26.81" r="5.32" xlink:href="#radial-gradient-3"/><radialGradient id="radial-gradient-5" cx="30.34" cy="50.7" fx="30.34" fy="50.7" r="5.77" xlink:href="#radial-gradient-3"/></defs>
                                        <g id="OBJECTS"><g><rect class="cls-5" width="252.6" height="66.27"/><g><g><path d="M89.2,22.37h2.3v25.78h-2.3V22.37Z"/><path d="M94.2,22.37h2.56l7.81,22.18h.14l8.1-22.18h2.56l-9.65,25.78h-2.23l-9.29-25.78Z"/><path d="M120.88,24.57v9.61h11.09v2.16h-11.09v9.61h12.24v2.2h-14.54V22.37h14.54v2.2h-12.24Z"/><path d="M137.9,22.37h2.99l14,21.74h.14l-.14-4.97V22.37h2.3v25.78h-2.38l-14.62-22.72h-.14l.14,4.97v17.75h-2.3V22.37Z"/><path d="M168.21,48.15V24.57h-7.31v-2.2h16.92v2.2h-7.31v23.58h-2.3Z"/><path d="M192.23,48.73c-1.9,0-3.65-.35-5.26-1.06-1.61-.71-2.99-1.67-4.16-2.9-1.16-1.22-2.08-2.65-2.74-4.28-.66-1.63-.99-3.37-.99-5.22s.33-3.59,.99-5.22c.66-1.63,1.57-3.06,2.74-4.28,1.16-1.22,2.55-2.19,4.16-2.9,1.61-.71,3.36-1.06,5.26-1.06s3.61,.35,5.22,1.06c1.61,.71,3,1.67,4.18,2.9,1.18,1.22,2.09,2.65,2.75,4.28,.66,1.63,.99,3.37,.99,5.22s-.33,3.59-.99,5.22c-.66,1.63-1.58,3.06-2.75,4.28-1.18,1.22-2.57,2.19-4.18,2.9-1.61,.71-3.35,1.06-5.22,1.06Zm0-2.2c1.46,0,2.86-.28,4.18-.83,1.32-.55,2.47-1.33,3.44-2.32,.97-1,1.75-2.18,2.32-3.56,.58-1.38,.86-2.9,.86-4.55s-.29-3.17-.86-4.55c-.58-1.38-1.35-2.57-2.32-3.56-.97-1-2.12-1.77-3.44-2.32-1.32-.55-2.71-.83-4.18-.83s-2.89,.28-4.19,.83c-1.31,.55-2.45,1.33-3.44,2.32-.98,1-1.76,2.18-2.32,3.56-.56,1.38-.85,2.9-.85,4.55s.28,3.17,.85,4.55c.56,1.38,1.34,2.57,2.32,3.56,.98,1,2.13,1.77,3.44,2.32,1.31,.55,2.71,.83,4.19,.83Z"/><path d="M209.54,22.37h8.53c1.08,0,2.09,.19,3.04,.56,.95,.37,1.78,.89,2.48,1.55,.71,.66,1.27,1.45,1.67,2.38,.41,.92,.61,1.94,.61,3.04,0,.91-.16,1.77-.49,2.57-.32,.8-.77,1.52-1.33,2.14-.56,.62-1.23,1.16-2,1.6-.77,.44-1.6,.76-2.48,.95l-.07,.11,7.34,10.73v.14h-2.63l-7.27-10.73h-5.11v10.73h-2.3V22.37Zm8.21,12.89c.77,0,1.5-.13,2.2-.4,.7-.26,1.31-.63,1.85-1.1,.54-.47,.97-1.03,1.28-1.69,.31-.66,.47-1.39,.47-2.18,0-.74-.14-1.45-.43-2.11-.29-.66-.68-1.22-1.17-1.69-.49-.47-1.07-.84-1.75-1.12-.67-.28-1.4-.41-2.2-.41h-6.16v10.69h5.9Z"/><path d="M235.89,48.15v-11.66l-8.89-14.11h2.7l7.27,11.74h.14l7.13-11.74h2.7l-8.75,14.11v11.66h-2.3Z"/></g><g><path class="cls-11" d="M89.2,22.37h2.3v25.78h-2.3V22.37Z"/><path class="cls-11" d="M94.2,22.37h2.56l7.81,22.18h.14l8.1-22.18h2.56l-9.65,25.78h-2.23l-9.29-25.78Z"/><path class="cls-11" d="M120.88,24.57v9.61h11.09v2.16h-11.09v9.61h12.24v2.2h-14.54V22.37h14.54v2.2h-12.24Z"/><path class="cls-11" d="M137.9,22.37h2.99l14,21.74h.14l-.14-4.97V22.37h2.3v25.78h-2.38l-14.62-22.72h-.14l.14,4.97v17.75h-2.3V22.37Z"/><path class="cls-11" d="M168.21,48.15V24.57h-7.31v-2.2h16.92v2.2h-7.31v23.58h-2.3Z"/><path class="cls-11" d="M192.23,48.73c-1.9,0-3.65-.35-5.26-1.06-1.61-.71-2.99-1.67-4.16-2.9-1.16-1.22-2.08-2.65-2.74-4.28-.66-1.63-.99-3.37-.99-5.22s.33-3.59,.99-5.22c.66-1.63,1.57-3.06,2.74-4.28,1.16-1.22,2.55-2.19,4.16-2.9,1.61-.71,3.36-1.06,5.26-1.06s3.61,.35,5.22,1.06c1.61,.71,3,1.67,4.18,2.9,1.18,1.22,2.09,2.65,2.75,4.28,.66,1.63,.99,3.37,.99,5.22s-.33,3.59-.99,5.22c-.66,1.63-1.58,3.06-2.75,4.28-1.18,1.22-2.57,2.19-4.18,2.9-1.61,.71-3.35,1.06-5.22,1.06Zm0-2.2c1.46,0,2.86-.28,4.18-.83,1.32-.55,2.47-1.33,3.44-2.32,.97-1,1.75-2.18,2.32-3.56,.58-1.38,.86-2.9,.86-4.55s-.29-3.17-.86-4.55c-.58-1.38-1.35-2.57-2.32-3.56-.97-1-2.12-1.77-3.44-2.32-1.32-.55-2.71-.83-4.18-.83s-2.89,.28-4.19,.83c-1.31,.55-2.45,1.33-3.44,2.32-.98,1-1.76,2.18-2.32,3.56-.56,1.38-.85,2.9-.85,4.55s.28,3.17,.85,4.55c.56,1.38,1.34,2.57,2.32,3.56,.98,1,2.13,1.77,3.44,2.32,1.31,.55,2.71,.83,4.19,.83Z"/><path class="cls-11" d="M209.54,22.37h8.53c1.08,0,2.09,.19,3.04,.56,.95,.37,1.78,.89,2.48,1.55,.71,.66,1.27,1.45,1.67,2.38,.41,.92,.61,1.94,.61,3.04,0,.91-.16,1.77-.49,2.57-.32,.8-.77,1.52-1.33,2.14-.56,.62-1.23,1.16-2,1.6-.77,.44-1.6,.76-2.48,.95l-.07,.11,7.34,10.73v.14h-2.63l-7.27-10.73h-5.11v10.73h-2.3V22.37Zm8.21,12.89c.77,0,1.5-.13,2.2-.4,.7-.26,1.31-.63,1.85-1.1,.54-.47,.97-1.03,1.28-1.69,.31-.66,.47-1.39,.47-2.18,0-.74-.14-1.45-.43-2.11-.29-.66-.68-1.22-1.17-1.69-.49-.47-1.07-.84-1.75-1.12-.67-.28-1.4-.41-2.2-.41h-6.16v10.69h5.9Z"/><path class="cls-11" d="M235.89,48.15v-11.66l-8.89-14.11h2.7l7.27,11.74h.14l7.13-11.74h2.7l-8.75,14.11v11.66h-2.3Z"/></g></g><g><path class="cls-7" d="M59.39,36.27l-16.61-9.59c-1.29-.75-2.88-.75-4.17,0l-16.61,9.59c-1.29,.75-2.09,2.12-2.09,3.61v4.97c0,1.49,.79,2.87,2.09,3.61l16.61,9.59c1.29,.75,2.88,.75,4.17,0l16.61-9.59c1.29-.75,2.09-2.12,2.09-3.61v-4.97c0-1.49-.79-2.87-2.09-3.61Z"/><path class="cls-9" d="M59.38,25.76l-16.63-9.55c-1.29-.74-2.88-.74-4.17,.01l-16.58,9.63c-1.29,.75-2.08,2.13-2.08,3.62v4.97c.02,1.49,.81,2.87,2.11,3.61l16.63,9.55c1.29,.74,2.88,.74,4.17-.01l16.58-9.63c1.29-.75,2.08-2.13,2.08-3.62v-4.97c-.02-1.49-.81-2.87-2.11-3.61Z"/><path class="cls-1" d="M59.39,15.34L42.79,5.76c-1.29-.75-2.88-.75-4.17,0L22.01,15.34c-1.29,.75-2.09,2.12-2.09,3.61v4.97c0,1.49,.79,2.87,2.09,3.61l16.61,9.59c1.29,.75,2.88,.75,4.17,0l16.61-9.59c1.29-.75,2.09-2.12,2.09-3.61v-4.97c0-1.49-.79-2.87-2.09-3.61Z"/><path class="cls-10" d="M59.39,15.34L42.79,5.76c-1.29-.75-2.88-.75-4.17,0L22.01,15.34c-.61,.35-1.1,.85-1.46,1.43,.36,.58,.85,1.07,1.46,1.43l16.61,9.59c1.29,.75,2.88,.75,4.17,0l16.61-9.59c.61-.35,1.1-.85,1.46-1.43-.36-.58-.85-1.07-1.46-1.43Z"/><path class="cls-12" d="M77.23,39.02l-12.61-7.28c-.98-.57-2.19-.57-3.17,0l-12.61,7.28c-.46,.27-.84,.64-1.11,1.08,.27,.44,.65,.82,1.11,1.08l12.61,7.28c.98,.57,2.19,.57,3.17,0l12.61-7.28c.46-.27,.84-.64,1.11-1.08-.27-.44-.65-.82-1.11-1.08Z"/><path class="cls-4" d="M63.18,36.56l-12.61-7.28c-.98-.57-2.19-.57-3.17,0l-12.61,7.28c-.46,.27-.84,.64-1.11,1.08,.27,.44,.65,.82,1.11,1.08l12.61,7.28c.98,.57,2.19,.57,3.17,0l12.61-7.28c.46-.27,.84-.64,1.11-1.08-.27-.44-.65-.82-1.11-1.08Z"/><path class="cls-8" d="M36.78,53.42l-10.1-5.83c-.79-.45-1.75-.45-2.54,0l-10.11,5.83c-.37,.21-.67,.52-.89,.87,.22,.35,.52,.65,.89,.87l10.11,5.83c.79,.45,1.75,.45,2.54,0l10.1-5.83c.37-.21,.67-.52,.89-.87-.22-.35-.52-.65-.89-.87Z"/><path class="cls-6" d="M25.58,26.03l-9.07-5.24c-.71-.41-1.57-.41-2.28,0l-9.07,5.24c-.33,.19-.6,.46-.8,.78,.19,.32,.46,.59,.8,.78l9.07,5.24c.71,.41,1.57,.41,2.28,0l9.07-5.24c.33-.19,.6-.46,.8-.78-.19-.32-.46-.59-.8-.78Z"/><path class="cls-2" d="M20.81,26.4l-4.83-2.79c-.38-.22-.84-.22-1.21,0l-4.84,2.79c-.18,.1-.32,.25-.42,.41,.1,.17,.25,.31,.42,.41l4.84,2.79c.38,.22,.84,.22,1.21,0l4.83-2.79c.18-.1,.32-.25,.42-.41-.1-.17-.25-.31-.42-.41Z"/><path class="cls-3" d="M36.29,50.25l-5.29-3.05c-.41-.24-.92-.24-1.33,0l-5.29,3.05c-.19,.11-.35,.27-.46,.45,.11,.18,.27,.34,.46,.45l5.29,3.05c.41,.24,.92,.24,1.33,0l5.29-3.05c.19-.11,.35-.27,.46-.45-.11-.18-.27-.34-.46-.45Z"/></g></g></g>
                                    </svg>
                                </div>
                                <p class="text-center">Inventory Control System</p>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                        <input type="email" class="form-control" name="email" id="email" aria-describedby="email"
                                            autocomplete="off" value="{{ old('email') }}" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password" id="password" autocomplete="off" required>
                                    </div>
                                    <button class="btn btn-primary w-100 py-8 mb-4">{{ __('Login') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>
<!-- Dashbaord -->
<script src="{{ asset('dashboard/assets/js/sidebarmenu.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/app.min.js') }}"></script>
{{-- Custom Script --}}
<script src="{{ asset('js/script.js') }}"></script>

@error('email')
    <script>
        toastr.error('{{ $message }}')
    </script>
@enderror

</html>
