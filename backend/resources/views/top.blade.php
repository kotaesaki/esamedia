@extends('layouts.app')

@section('content')

<div class="col-md-8">

    <div class="slider">
        @foreach($posts_new as $post_new)
        <div><a href="{{ route('show_page',['post_id' => $post_new->post_id])}}">
                <img src="{{$post_new->file_path}}" alt="image01">
                <h2>{{ $post_new->post_title }}</h2>
            </a>
        </div>
        @endforeach
    </div>

    <div class="contents">
        @foreach($posts as $post)
        <div class="content-item d-flex justify-content-center">
            <a href="{{ route('show_page',['post_id' => $post->post_id])}}">
                <div class="box-img">
                    <img class="content-img post-image-col" src="{{ $post->file_path}}"
                        alt="Card image cap">
                    <h2 class="content-title">{{ $post->post_title }}</h2><br>
                    <p class="content-date">{{ $post->post_date }}</p>
                    <p class="content-content">{{ $post->post_excerpt }}</p>
                </div>

            </a>
        </div>
        @endforeach
    </div>
    {{ $posts->links() }}

</div>


@endsection