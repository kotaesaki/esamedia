@extends('layouts.app')

@section('content')
<div class="col-md-8 page">
    <div class="page-page bg-white">
        @foreach($posts_tag as $post_tag)
        <a href="{{route('search_tag',['term_slug'=> $post_tag->term_slug])}}"
            class="btn-flat-dashed-border2">{{ $post_tag->term_name}}</a>
        @endforeach
        @foreach($posts as $post)
        <h2 class="page-title">{{ $post->post_title }}</h2>

        <p class="page-date"><i class="fas fa-edit"></i>：{{ $post->post_date }}</p>
        @if ($post->post_date != $post->post_modified)
        <p class="page-date"><i class="fas fa-wrench"></i>：{{ $post->post_modified }}</p>
        @endif
        <div class="img-box">
            <img class="page-img" src="{{ Storage::url($post->file_path) }}" alt="">
        </div>
        <div class="page-content">{!! $post->mark_body !!}</div>
        @endforeach
    </div>
    <div class="page-comment bg-white">
        <div class="comment-timeline">
            @foreach($comments as $comment)
            <div class="timeline">
                <div>
                    <span class="timeline-num">{{$counter++}}.</span>
                    <span class="timeline-name">{{$comment->comment_author}}</span>
                </div>
                @if(!empty($comment->comment_author_url))
                <a class="timeline-url" href="{{$comment->comment_author_url}}"
                    target="__blank">{{$comment->comment_author_url}}</a>
                @endif
                <div>
                    <span class="timeline-content">{{$comment->comment_content}}</span>
                    <span class="timeline-date"><i class="fas fa-clock"></i> {{$comment->created_at}}</span>
                </div>
            </div>
            @endforeach
        </div>
        <div class="comment-form">
            <form action="{{route('send_comment',['post_id'=>$post_id->post_id])}}" method="POST">
                @csrf
                <div class="comment-text">
                    <span class="comment-b">コメントを残す</span>
                    <span class="comment-s">メールアドレスが公開されることはありません。</span>
                </div>
                <div class="name-mail">
                    <div class="form-group comment-author">
                        <label class="author" for="author">NAME <span>*</span></label>
                        <input type="text" name="author" value="">
                    </div>
                    <div class="form-group comment-mail">
                        <label class="email" for="email">MAIL <span>*</span></label>
                        <input type="text" name="email">
                    </div>
                </div>
                <div class="form-group comment-url">
                    <label class="url" for="url">Website URL</label>
                    <input type="text" name="url">
                </div>
                <div class="form-group comment-message">
                    <label class="message" for="message">MESSAGE <span>*</span></label>
                    <textarea name="message"></textarea>
                </div>
                <input type="hidden" name="post_id" value="{{$post_id->post_id}}">
                <div class="form-group comment-submit">
                    <input type="submit" name="send" value="コメントを送信">
                </div>

            </form>
        </div>
    </div>

</div>


@endsection