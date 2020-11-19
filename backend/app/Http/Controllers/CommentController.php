<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{

    public function showAdmin()
    {
        $comments = Comment::join('posts', 'posts.post_id', '=', 'comments.comment_post_id')
            ->orderBy('created_at', 'desc')
            ->select('comment_id', 'comment_author', 'comment_content', 'post_title', "post_id", 'created_at')->get();
        return view('admin.comment', ['comments' => $comments]);
    }
    public function delete(Request $request)
    {
        $comment = Comment::find($request->id);
        $comment->delete();
        return redirect('admin/home/comment');
    }
}
