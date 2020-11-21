<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="../image/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="../image/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../image/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="../image/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../image/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="../image/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="../image/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="../image/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../image/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="../image/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../image/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../image/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../image/favicon/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <title>ESALOG</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <style type="text/css">

    </style>

    <!-- Styles -->
    <link href="{{ asset('css/slick-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('css/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

</head>

<body style="background-color: #FCF9F2">
    <div id="app">
        @yield('content')

    </div>
</body>

</html>