<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ESALOG</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body style="background-color: #F5F5F5">
    <div id="app">
    <nav class="navbar navbar-expand-sm navbar-white bg-white">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav4" aria-controls="navbarNav4" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">ESALOG</a>
        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">ホーム</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">ブログ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">このブログについて</a>
                </li>
            </ul>
        </div>
    </nav>
        

        <main class="py-4">
            @yield('content')
        </main>

        <footer class="d-flex align-items-center justify-content-center" style="background-color: #FFFFFF; height: 70px;">
            <span style="color: #7F7F7F;">COPYRIGHT@KOTA ESAKI</span>
        </footer>
    </div>
</body>
</html>
