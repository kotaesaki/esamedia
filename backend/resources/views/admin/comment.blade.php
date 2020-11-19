@extends('admin.common')

@section('content')
<div class="container ">
    <div class="row justify-content-center">
        <div class="col-md-12 col-md-offset-2 bg-white category-form">
            <div class="table-responsive category-table">
                <h2>コメント</h2>
                　　<table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th>名前</th>
                            <th>コメント</th>
                            <th>返信元</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>名前</th>
                            <th>コメント</th>
                            <th>返信元</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($comments as $comment)
                        <tr>
                            <td class="comment-name">{{$comment->comment_author}}</td>
                            <td>
                                <span class="comment-date">{{$comment->created_at}}</span>に投稿<br>
                                <span>{{$comment->comment_content}}</span>
                            </td>
                            <td><a href="{{route('show_page',['post_id'=>$comment->post_id])}}"
                                    target="__blank">{{$comment->post_title}}</a>
                            </td>
                            <td>
                                <a id="navbarDropdown" class="align-middle" style="position: relative;color:#339bf7"
                                    href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false" v-pre>
                                    •••</a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <form action="{{ route('delete_comment')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$comment->comment_id}}">
                                        <input type="submit" name="delete" class="dropdown-item" value="削除"
                                            onclick='return confirm("このコメントを削除しますか？");'>
                                    </form>
                                </div>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    　　
                </table>
            </div>
        </div>
    </div>

    @endsection