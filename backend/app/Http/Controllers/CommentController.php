<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function send(Request $request, $post_id)
    {
        $request->validate([
            'author' => 'required|string|max:100',
            'email' => 'required|string|max:200',
            'message' => 'required|string|'
        ]);
        DB::beginTransaction();
        try {

            Comment::create([
                'comment_post_id' => $request->post_id,
                'comment_author' => $request->author,
                'comment_author_email' => $request->email,
                'comment_author_url' => $request->url,
                'comment_content' => $request->message,
                'comment_author_ip' => request()->ip(),
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
        $post_id = POST::select('post_id')->where('post_id', $request->post_id)->first();

        return redirect()->route('show_page', ['post_id' => $post_id]);
    }
}
