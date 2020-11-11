<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;


class PageController extends Controller
{
    public function showPage(Request $request, $post_id){

        $posts = POST::where('post_id',$request->post_id)->get();
        $posts_new = POST::orderBy('post_date', 'desc')->take(10)->get();

        $post_id = POST::select('post_id')->
        where('post_id',$request->post_id)->get();

        return view('page',['posts' => $posts,
                            'posts_new' => $posts_new,
                           'post_id' => $post_id]);
    }
}
