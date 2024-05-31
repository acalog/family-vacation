
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#F31561"/>

    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Title -->
    <title>@yield('title', config('app.name'))</title>

    <!-- Check if browser has javascript -->
    <script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>

    <!-- Scripts -->
    <script src="{{ asset('/static/js/dropzone.js') }}"></script>
    <script src="{{ asset('/static/js/details.js') }}"></script>

    
    <!-- Styles -->
    <link href="{{ asset('/static/css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('/static/css/dropzone.css') }}" rel="stylesheet">
    <link href="{{ asset('/static/css/gallery.css') }}" rel="stylesheet">
    <link href="{{ asset('/static/css/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('/static/css/icons.css') }}" rel="stylesheet">

</head>
