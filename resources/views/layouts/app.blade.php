<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('page-title')

    {{-- Fav-Icon --}}
    <link rel="shortcut icon" href="img/asset/fav-icon.png" type="image/x-icon">
    <link rel="icon" href="img/asset/fav-icon.png" type="image/x-icon">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- Payment --}}
    <!-- includes the Braintree JS client SDK -->
    <script src="https://js.braintreegateway.com/web/dropin/1.26.0/js/dropin.min.js"></script>

    <!-- includes jQuery -->
    <script src="http://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>

    {{-- Fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

    {{-- Google fonts --}}
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

</head>

<body>
    <div id="app">
        <main>
            @yield('content')
        </main>
    </div>

    {{-- JS --}}
    <script src="{{asset('js/app.js')}}"></script>
    @yield('script')
</body>
</html>
