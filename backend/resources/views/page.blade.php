@extends('layouts.app')

@section('content')
<div class="col-md-8 bg-white page">
<div class="page-page">
    @foreach($posts as $post)
    <h2 class="page-title">{{ $post->post_title }}</h2>
    
    <p class="page-date">投稿日：{{ $post->post_date }}</p>
    <div class="img-box">
    <img class="page-img" src="{{ Storage::url($post->file_path) }}" alt="">
    </div>
    <div class="page-content">{{ $post->post_content }}</div>
    @endforeach
</div>

</div>

@endsection