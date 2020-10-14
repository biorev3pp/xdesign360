<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}" sizes="16x16">
    <meta name="site-url" content="{{ url('/') }}"> 
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Xseries Sales') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/material-icons/material-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/material-vendors.min.css') }}">
    <link href="{{ asset('css/admin-panel.css') }}" rel="stylesheet">
</head>
<body class="vertical-layout vertical-compact-menu material-vertical-layout material-layout 2-columns  fixed-navbar {{ in_array($menu, ['models', 'media', 'pages'])?'todo-application':'' }}" data-open="click" data-menu="vertical-compact-menu" data-col="2-columns">
    @include('elements.header')
    @include('elements.menu')
    <div class="app-content content mb-3" id="app">
        @yield('content')
    </div>
    @include('elements.footer')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    @stack('scripts')
</body>
</html>
