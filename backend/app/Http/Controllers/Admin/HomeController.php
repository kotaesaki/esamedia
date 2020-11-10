<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;



class HomeController extends Controller
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
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {   
        $user = new User;
        $user1 = User::find(Auth::user()->id);
        $user_status = $user1->user_status;

        $posts = Post::orderBy('post_modified', 'desc')->get();

        return view('admin.list',['user_status' => $user_status,
                                  'posts' => $posts,                     
                                ]);

    }
    public function showHome(){
        return redirect('admin/home');
    }

}
