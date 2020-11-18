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
                <span>記事の一覧</span>
                <a id="navbarDropdown" class="nav-link dropdown-toggle text-right float-right" href="#" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
                <div class="article-card">
                    <div class="w-80">
                        <span class="lead article-title">{{ $post->post_title }}</span>
                        <div class="article-sub">
                            @if($post->post_status == "publish")
                            <span class="small">公開中</span>
                            @else
                            <span class="small">下書き</span>
                            @endif
                            <span class="small">{{ $post->post_modified }}</span>
                            <span>By {{ $post->post_author }}</span>
                        </div>

                    </div>

                    <a id="navbarDropdown" class="text-right float-right align-middle"
                        style="position: relative; top: -37px; color:#339bf7" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        •••</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <form action="{{ route('delete_post',['post_id' => $post->post_id])}}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{$post->post_id}}">
                            <input type="submit" value="削除" class="dropdown-item"
                                onclick='return confirm("この記事を削除しますか？");'>
                        </form>
                    </div>

                    <a href="{{ route('edit_form',['post_id' => $post->post_id])}}" class="float-right align-middle"
                        style="position: relative; top: -37px; left: -6%; color:#339bf7">
                        @csrf
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