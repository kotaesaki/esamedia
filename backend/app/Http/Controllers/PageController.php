<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Term;


class PageController extends Controller
{
        public function showPage(Request $request, $post_id)
        {

                $posts = POST::where('post_id', $request->post_id)->get();
                $posts_new = POST::orderBy('post_date', 'desc')->take(10)->get();

                $post_id = POST::select('post_id')->where('post_id', $request->post_id)->get();

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

                return view('page', [
                        'posts' => $posts,
                        'posts_new' => $posts_new,
                        'post_id' => $post_id,
                        'terms_parent' => $terms_parent,
                        'terms_child' => $terms_child,
                        'terms_tag' => $terms_tag,
                        'posts_tag' => $posts_tag
                ]);
        }
}
