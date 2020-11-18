@extends('layouts.app')

@section('content')
<div class="col-md-8 bg-white page">
    <div class="page-page">
        @foreach($posts_tag as $post_tag)
        <a href="{{route('search_tag',['term_slug'=> $post_tag->term_slug])}}"
            class="btn-flat-dashed-border2">{{ $post_tag->term_name}}</a>
        @endforeach
        @foreach($posts as $post)
        <h2 class="page-title">{{ $post->post_title }}</h2>

        <p class="page-date">投稿日：{{ $post->post_date }}</p>
        <div class="img-box">
            <img class="page-img" src="{{ Storage::url($post->file_path) }}" alt="">
        </div>
        <div class="page-content">{!! $post->mark_body !!}</div>
        @endforeach
    </div>


</div>

@endsection