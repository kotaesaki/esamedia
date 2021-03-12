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

  <title>管理画面 / LOGLOG</title>

  <!-- Scripts -->
  <script src="{{ mix('js/app.js') }}" defer></script>


  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

</head>

<body>
  <div class="wrapper">
    <div id='loader'>
      <div class="spinner"></div>
    </div>
    <!--ヘッダーのバー-->
    <nav class="navbar navbar-expand-sm head-nav">

      <input id="nav-input" type="checkbox" class="nav-unshown">
      <label id="nav-open" for="nav-input"><span></span></label>
      <label class="nav-unshown" id="nav-close" for="nav-input"></label>
      <div id="nav-content">
        <ul class="list-unstyled components" id="dashbar">
          <li>
            <a href="{{route('admin.home')}}" @if(Request::is('admin/home')) class="active" @else class="non-active"
              @endif><i class="fas fa-list-alt"></i> Posts List</a>
          </li>
          <li>
            <a href="{{route('show_form')}}" @if(Request::is('admin/home/new')) class="active" @else class="non-active"
              @endif><i class="fas fa-plus"></i> New post</a>
          </li>
          <li>
            <a href="{{route('show_comment')}}" @if(Request::is('admin/home/comment')) class="active" @else
              class="non-active" @endif><i class="fas fa-comments"></i> Comments</a>
          </li>

          @if(Auth::user()->user_status == "admin")
          <li>
            <a href="{{route('show_users')}}" @if(Request::is('admin/home/users')) class="active" @else
              class="non-active" @endif><i class="fas fa-users"></i> Users List</a>
          </li>
          @endif

          <li>
            <a href="{{route('admin.register')}}" @if(Request::is('admin/home/register')) class="active" @else
              class="non-active" @endif><i class="fas fa-user-plus"></i> User Register</a>
          </li>
          <li>
            <a href="{{route('get_category')}}" @if(Request::is('admin/home/category')) class="active" @else
              class="non-active" @endif><i class="fas fa-angle-right"></i> Category</a>
          </li>
          <li>
            <a href="{{route('get_tag')}}" @if(Request::is('admin/home/tag')) class="active" @else class="non-active"
              @endif><i class="fas fa-tags"></i> Tags</a>
          </li>
          <li>
            <a href="{{route('index')}}" class="non-active" target="_blank">
              LOGLOG</a>
          </li>
        </ul>
      </div>

      <a class="navbar-brand brand-name" href="{{route('admin.home')}}">管理ページ</a>
      <div class="profile">
        <ul class="">
          <li class="">
            <a id="navbarDropdown" class="nav-link dropdown-toggle top-profile" href="#" role="button"
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">

              <a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                {{ __('ログアウト') }}
              </a>

              <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </div>
          </li>
        </ul>
      </div>
    </nav>

    <div class="row" style="margin-right:0; margin-left:0;">
      <!-- Sidebar -->
      <nav id="sidebar" class="col-md-2">
        <ul class="list-unstyled components" id="dashbar">
          <li>
            <a href="{{route('admin.home')}}" @if(Request::is('admin/home')) class="active" @else class="non-active"
              @endif><i class="fas fa-list-alt"></i> Posts List</a>
          </li>
          <li>
            <a href="{{route('show_form')}}" @if(Request::is('admin/home/new')) class="active" @else class="non-active"
              @endif><i class="fas fa-plus"></i> New post</a>
          </li>
          <li>
            <a href="{{route('show_comment')}}" @if(Request::is('admin/home/comment')) class="active" @else
              class="non-active" @endif><i class="fas fa-comments"></i> Comments</a>
          </li>
          @if(Auth::user()->user_status == "admin")
          <li>
            <a href="{{route('show_users')}}" @if(Request::is('admin/home/users')) class="active" @else
              class="non-active" @endif><i class="fas fa-users"></i> Users List</a>
          </li>
          @endif

          <li>
            <a href="{{route('admin.register')}}" @if(Request::is('admin/home/register')) class="active" @else
              class="non-active" @endif><i class="fas fa-user-plus"></i> User Register</a>
          </li>
          <li>
            <a href="{{route('get_category')}}" @if(Request::is('admin/home/category')) class="active" @else
              class="non-active" @endif><i class="fas fa-angle-right"></i> Category</a>
          </li>
          <li>
            <a href="{{route('get_tag')}}" @if(Request::is('admin/home/tag')) class="active" @else class="non-active"
              @endif><i class="fas fa-tags"></i> Tags</a>
          </li>
          <li>
            <a href="{{route('index')}}" class="non-active" target="_blank">
              LOGLOG</a>
          </li>
        </ul>

      </nav>
      <div class="col-md-10 main">
        <main class="py-4">
          @yield('content')
        </main>
      </div>

    </div>
    <footer class="d-flex align-items-center justify-content-center footer">
      <span style="color: #7F7F7F;">COPYRIGHT@LOGLOG</span>
    </footer>
  </div>

  <script>
    window.addEventListener('load', function load() {
        const loader = document.getElementById('loader');
        setTimeout(function() {
          loader.classList.add('fadeOut');
        }, 300);
      });
  </script>
</body>