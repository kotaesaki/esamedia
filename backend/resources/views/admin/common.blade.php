<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>管理者画面 / ESALOG</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
      #loader {
        transition: all 0.3s ease-in-out;
        opacity: 1;
        visibility: visible;
        position: fixed;
        height: 100vh;
        width: 100%;
        background: #fff;
        z-index: 90000;
      }

      #loader.fadeOut {
        opacity: 0;
        visibility: hidden;
      }

      .spinner {
        width: 40px;
        height: 40px;
        position: absolute;
        top: calc(50% - 20px);
        left: calc(50% - 20px);
        background-color: #333;
        border-radius: 100%;
        -webkit-animation: sk-scaleout 1.0s infinite ease-in-out;
        animation: sk-scaleout 1.0s infinite ease-in-out;
      }

      @-webkit-keyframes sk-scaleout {
        0% { -webkit-transform: scale(0) }
        100% {
          -webkit-transform: scale(1.0);
          opacity: 0;
        }
      }

      @keyframes sk-scaleout {
        0% {
          -webkit-transform: scale(0);
          transform: scale(0);
        } 100% {
          -webkit-transform: scale(1.0);
          transform: scale(1.0);
          opacity: 0;
        }
      }

      #sidebar {
        width: 250px;
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        z-index: 999;
        background-color: #7386D5;
        color: #FFFFFF;
        transition: all 0.3s;
        padding: 75px 10px 20px 10px;
      }
      .add-image{
        width:30px;
        height:30px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
        filter: invert(1);
        
      }
      .add-image-btn{
        position:relative;
        width:50px;
        height:50px;
        border-radius: 50%;
        background-color: #A8ABB1;
        margin-bottom:100px;
      }

      .image-btn {
          display: none; /* アップロードボタンのスタイルを無効にする */
      }
      .FlexTextarea {
        position: relative;
        font-size: 1rem;
        line-height: 1.8;

      }

      .FlexTextarea__dummy {
        overflow: hidden;
        visibility: hidden;
        box-sizing: border-box;
        padding: 5px 15px;
        min-height: 500px;
        white-space: pre-wrap;
        word-wrap: break-word;
        overflow-wrap: break-word;
        border: 1px solid;
      }

      .FlexTextarea__textarea {
        position: absolute;
        top: 0;
        left: 0;
        display: block;
        overflow: hidden;
        width: 100%;
        height: 100%;
        background-color: transparent;
        border: 1px solid #b6c3c6;
        border-radius: 4px;
        color: inherit;
        font: inherit;
        letter-spacing: inherit;
        resize: none;
        border-width:0px;
        border-style:None; 
        font-size: 17px;
      }

      .FlexTextarea__textarea:focus {
        box-shadow: 0 0 0 4px rgba(35, 167, 195, 0.3);
        outline: 0;
      }
      .userInfo__icon{
        width: 100%;
        height: 300px;
        object-fit: cover;
      }
      .file-preview{
        position:relative;
        height:100px;
        margin-bottom:350px;
      }
      .image-label{
        position:relative;
        padding:5%;
        height:50px;
      }

    </style>
</head>

<body style="background-color: #F5F5F5">
    <div class="wrapper">
    <div id='loader'>
      <div class="spinner"></div>
    </div>
    <script>
      window.addEventListener('load', function load() {
        const loader = document.getElementById('loader');
        setTimeout(function() {
          loader.classList.add('fadeOut');
        }, 300);
      });
    </script>

    <div class="row">
      <!-- Sidebar -->
    <nav id="sidebar" class="col-md-2">
        <ul class="list-unstyled components" id="dashbar">
            <li>
                <a href="">記事一覧を表示する
</a>
            </li>
            <li>
                <a href="{{route('show_form')}}">記事を作成する
</a>
            </li>
            
            <li>
                <a href="#">編集者を表示する
</a>
            </li>
            <li>
                <a href="#">編集者を登録する
</a>
            </li>
        </ul>

    </nav>
    <div class="col-md-10" style="margin-left:17%;">
      <!--ヘッダーのバー-->
    <nav class="navbar navbar-expand-sm bg-white " >
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav4" aria-controls="navbarNav4" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">管理者画面</a>
        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                <li class="nav-item active">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                
                                <a class="dropdown-item" href="{{ route('admin.logout') }}"
                                   onclick="event.preventDefault();
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
    <main class="py-4">
      @yield('content')
    </main>
    </div>

    </div>
    <footer class="d-flex align-items-center justify-content-center" style="background-color: #FFFFFF; height: 70px;">
            <span style="color: #7F7F7F;">COPYRIGHT@KOTA ESAKI</span>
    </footer>
    </div>
</body>