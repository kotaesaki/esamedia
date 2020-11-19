<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Term;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;


class PageController extends Controller
{
        public function showPage(Request $request, $post_id)
        {

                $posts = POST::where('post_id', $request->post_id)->get();
                $posts_new = POST::orderBy('post_date', 'desc')->take(10)->get();

                $post_id = POST::select('post_id')->where('post_id', $request->post_id)->first();
                $terms_parent = TERM::where('taxonomy', 'category')
                        ->where('parent', 0)
                        ->get();
                $terms_child = TERM::where('taxonomy', 'category')
                        ->where('parent', '>=', 1)
                        ->get();
                $terms_tag = TERM::where('taxonomy', 'tag')->get();
                $posts_tag = TERM::whereHas('posts', function ($query) use ($post_id) {
                        $query->whereIn('posts.post_id', $post_id);
                })
                        ->where('taxonomy', 'tag')
                        ->get();
                $comments = Comment::where('comment_post_id', $post_id->post_id)
                        ->select('comment_author', 'comment_author_url', 'comment_content', 'created_at')
                        ->get();
                $counter = 1;
                return view('page', [
                        'posts' => $posts,
                        'posts_new' => $posts_new,
                        'post_id' => $post_id,
                        'terms_parent' => $terms_parent,
                        'terms_child' => $terms_child,
                        'terms_tag' => $terms_tag,
                        'posts_tag' => $posts_tag,
                        'comments' => $comments,
                        'counter' => $counter
                ]);
        }
        public function send(Request $request, $post_id)
        {
                $request->validate([
                        'author' => 'required|string|max:100',
                        'email' => 'required|string|email|max:200',
                        'message' => 'required|string|'
                ]);
                DB::beginTransaction();
                try {
                        if (is_null($request->url)) {
                                Comment::create([
                                        'comment_post_id' => $request->post_id,
                                        'comment_author' => $request->author,
                                        'comment_author_email' => $request->email,
                                        'comment_author_url' => 0,
                                        'comment_content' => $request->message,
                                        'comment_author_ip' => request()->ip(),
                                ]);
                        } else {
                                Comment::create([
                                        'comment_post_id' => $request->post_id,
                                        'comment_author' => $request->author,
                                        'comment_author_email' => $request->email,
                                        'comment_author_url' => $request->url,
                                        'comment_content' => $request->message,
                                        'comment_author_ip' => request()->ip(),
                                ]);
                        }
                        DB::commit();
                } catch (\Exception $e) {
                        DB::rollBack();
                        dd('rollback');
                }
                $post_id = POST::select('post_id')->where('post_id', $request->post_id)->first();

                return redirect()->route('show_page', ['post_id' => $post_id]);
        }
}
