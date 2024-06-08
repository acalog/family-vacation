
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
    <link rel= "stylesheet" href= "https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" >

    <!-- Styles -->
    <link href="{{ asset('/static/css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('/static/css/dropzone.css') }}" rel="stylesheet">
    <link href="{{ asset('/static/css/gallery.css') }}" rel="stylesheet">
    <link href="{{ asset('/static/css/icons.css') }}" rel="stylesheet">
</head>
