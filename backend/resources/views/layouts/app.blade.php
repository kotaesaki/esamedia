<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ESALOG</title>

    <!-- Scripts -->
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <style type="text/css">
    @font-face {
        font-family: Slick;
        src: url('{{ public_path('fonts/slick.woff') }}');
    }
    </style>

    <!-- Styles -->
    <link href="{{ asset('css/slick-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('css/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    
    <style>
    
    </style>
</head>
<body style="background-color: #F5F5F5">
    <div id="app">
    <nav class="navbar navbar-expand-sm navbar-white bg-white">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav4" aria-controls="navbarNav4" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="{{route('index')}}">ESALOG</a>
        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('index')}}">ホーム</a>
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
        <div class="container">
        <div class="row justify-content-center">
            @yield('content')

            <div class="col-md-4">

            <aside class="aside-s">
            <span class="text-s">SEARCH</span>
            <form method="get" action="{{ route('search') }}" class="search_container">
            <input type="text" name="keyword" size="25" placeholder="　キーワード検索">
            <input type="submit" value="&#xf002">
            </form>

            </aside>

            <aside class="aside-s">
            <span class="text-s">NEW</span>
            @foreach($posts_new as $post_new)
            <div class="new-box d-flex justify-content-center">
            <a href="{{ route('show_page',['post_id' => $post_new->post_id])}}">
            <div class="box-img-new">
            <img class="content-img-new" src="{{ Storage::url($post_new->file_path) }}" alt="Card image cap">
            </div>
            <h2 class="content-title-new float-left">{{ $post_new->post_title }}</h2><br>
            </a>
            </div>
            @endforeach

            </aside>
            <aside class="aside-s">
            <span class="text-s">CATEGORY</span>
            </aside>
            <aside class="aside-s">
            <span class="text-s">About me</span>
            </aside>
            
            </div>
        </div>
        </div>
        </main>

        <footer class="d-flex align-items-center justify-content-center" style="background-color: #FFFFFF; height: 70px;">
            <span style="color: #7F7F7F;">COPYRIGHT@KOTA ESAKI</span>
        </footer>
    </div>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script type="text/javascript"src="{{ asset('js/slick.min.js') }}" defer></script>
    <script type="text/javascript">
        $(function() {
            $('.slider').slick({ //{}を入れる
                arrows: false,	
                autoplay: true, //「オプション名: 値」の形式で書く
                dots: true, //複数書く場合は「,」でつなぐ
  });        });
    </script>
</body>
</html>
