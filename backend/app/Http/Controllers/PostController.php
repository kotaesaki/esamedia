<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getPublish(Request $request)
    {
        $user = new User;
        $user1 = User::find(Auth::user()->id);
        $user_status = $user1->user_status;

        $posts = POST::where('post_status', 'publish')->orderBy('post_modified', 'desc')->get();
        return view('admin.list', [
            'user_status' => $user_status,
            'posts' => $posts
        ]);
    }
    public function getPrivate(Request $request)
    {
        $user = new User;
        $user1 = User::find(Auth::user()->id);
        $user_status = $user1->user_status;

        $posts = POST::where('post_status', 'private')->orderBy('post_modified', 'desc')->get();
        return view('admin.list', [
            'user_status' => $user_status,
            'posts' => $posts
        ]);
    }
}
