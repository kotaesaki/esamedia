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

    <title>LOGLOG</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <style type="text/css">

    </style>

    <!-- Styles -->
    <link href="{{ asset('css/slick-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('css/slick.css') }}" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

</head>

<body style="background-color: #FCF9F2">
    <div id="app">
        <nav class="navbar navbar-expand-sm nav-top justify-content-center">
            <a class="brand" href="{{route('index')}}">LOGLOG</a>
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
                                        <img class="content-img-new" src="{{ $post_new->file_path }}"
                                            alt="Card image cap">
                                        <h2 class="content-title-new">{{ $post_new->post_title }}</h2>
                                    </div>
                                </a>
                            </div>
                            @endforeach

                        </aside>
                        <aside id="categories" class="aside-s">
                            <span class="text-s">CATEGORY</span>
                            <ul id="side-category" class="cp_list">
                                @foreach($terms_parent as $term_parent)
                                <li class="cp_parent"><a
                                        href="{{ route('search_category',['term_slug'=> $term_parent->term_slug])}}">{{ $term_parent->term_name}}</a>
                                </li>
                                <ul>
                                    @foreach($terms_child as $term_child)
                                    @if($term_parent->term_id == $term_child->parent)
                                    <li><i class="fas fa-angle-right"></i><a
                                            href="{{ route('search_category',['term_slug'=> $term_child->term_slug])}}">{{ $term_child->term_name}}</a>
                                    </li>
                                    <ul>
                                        @foreach($terms_child as $term_childd)
                                        @if($term_child->term_id == $term_childd->parent)
                                        <li><i class="fas fa-angle-right"></i><a
                                                href="{{ route('search_category',['term_slug'=> $term_childd->term_slug])}}">{{ $term_childd->term_name}}</a>
                                        </li>
                                        @endif
                                        @endforeach
                                    </ul>
                                    @endif
                                    @endforeach
                                </ul>
                                @endforeach
                            </ul>
                        </aside>
                        <aside class="aside-s">
                            <span class="text-s">TAGS</span><br>
                            @foreach($terms_tag as $term_tag)
                            <a href="{{ route('search_tag',['term_slug'=> $term_tag->term_slug])}}"
                                class="btn-flat-dashed-border">{{ $term_tag->term_name}}</a>
                            @endforeach
                        </aside>
                        <aside class="aside-s">
                            <span class="text-s">About me</span>
                        </aside>

                    </div>
                </div>
            </div>
        </main>

        <footer class="d-flex align-items-center justify-content-center"
            style="background-color: #FFFFFF; height: 70px;">
            <span style="color: #7F7F7F;">COPYRIGHT@KOTA ESAKI</span>
        </footer>
    </div>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/slick.min.js') }}" defer></script>
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