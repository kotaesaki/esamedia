@extends('admin.common')

@section('content')

<div class="container">
    
    <div class="justify-content-center">
    @if ($user_status == "admin")
      <p><b>管理者</b>でログインしています。</p>
    @else
      <p><b>編集者</b>でログインしています。</p>
    @endif
    
    <div class="card">
        <div class="card-header">
        記事の一覧
        <a id="navbarDropdown" class="nav-link dropdown-toggle text-right float-right" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        公開ステータス</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <form method="get" action="{{route('admin.home')}}">
            {{ csrf_field()}}
            <input type="hidden" name="id" value="">
            <input type="submit" value="すべて" class="dropdown-item">
        </form>
        <form method="get" action="{{route('post_getPublish')}}">
            {{ csrf_field()}}
            <input type="hidden" name="id" value="#">
            <input type="submit" value="公開中" class="dropdown-item">
        </form>
        <form method="get" action="{{route('post_getPrivate')}}">
            {{ csrf_field()}}
            <input type="hidden" name="id" value="#">
            <input type="submit" value="下書き" class="dropdown-item">
        </form>
        </div>
        </div>
        <div class="card-body">
        @foreach($posts as $post)
        <div style="padding:1rem 4rem; border-top: solid 1px #E6ECF0; border-bottom: solid 1px #E6ECF0; position:relative;">
        <div class="w-75">
        <span class="lead">{{ $post->post_title }}</span><br>
        @if($post->post_status == "publish")
        <span class="small">公開中</span>
        @else
        <span class="small">下書き</span>
        @endif
        <span class="small">{{ $post->post_modified }}</span>
        <span>By {{ $post->post_author }}</span>
        </div>
        
        <a id="navbarDropdown" class="text-right float-right align-middle" style="position: relative; top: -37px;"
        href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        •••</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <form action=""></form>
        </div>

        <a href="{{ route('edit_form',['post_id' => $post->post_id])}}"class="float-right align-middle" style="position: relative; top: -37px; left: -6%;">
        {{ csrf_field()}}
            編集
        </a>
        </div>
        @endforeach
        </div>
    </div>

    </div>
</div>
<div style="margin:5%;">{{ $posts->links() }}</div>

@endsection