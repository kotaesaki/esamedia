<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Term;


class TopController extends Controller
{
    public function index()
    {
        $posts = Post::where('post_status', 'publish')->orderBy('post_modified', 'desc')->simplePaginate(10);
        $posts_new = POST::where('post_status', 'publish')->orderBy('post_date', 'desc')->take(10)->get();

        $terms_parent = TERM::where('taxonomy', 'category')
            ->where('parent', 0)
            ->get();
        $terms_child = TERM::where('taxonomy', 'category')
            ->where('parent', '>=', 1)
            ->get();

        $terms_tag = TERM::where('taxonomy', 'tag')->get();
        return view('top', [
            'posts' => $posts,
            'posts_new' => $posts_new,
            'terms_parent' => $terms_parent,
            'terms_child' => $terms_child,
            'terms_tag' => $terms_tag
        ]);
    }
}
