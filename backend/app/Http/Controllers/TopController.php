<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class TopController extends Controller
{
    public function index(){
        $posts = Post::where('post_status', 'publish')->orderBy('post_modified', 'desc')->simplePaginate(10);
        $posts_new = POST::where('post_status', 'publish')->orderBy('post_date', 'desc')->take(10)->get();
        return view('top',['posts' => $posts,'posts_new' => $posts_new ]);
    }
}