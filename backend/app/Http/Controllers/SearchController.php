<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class SearchController extends Controller
{
    public function index(Request $request){

        $keyword = $request->keyword;
        if ($keyword != '') {
            $posts = POST::where('post_title','like','%'.$keyword.'%')->orderBy('post_date','desc')->simplePaginate(10);
          }else {
            $posts = POST::orderBy('post_date','desc')->simplePaginate(10);
          }
        $posts_new = POST::orderBy('post_date', 'desc')->take(10)->get();

        return view('top',['posts' => $posts,'posts_new' => $posts_new ]);
    }
}
