<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class UserAdminController extends Controller
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

    public function index()
    {
        $users = User::all();
        return view('admin.useradmin', ['users' => $users]);
    }


    public function delete(Request $request)
    {
        $user = User::find($request->id);
        if ($request->delete == 'delete') {
            DB::beginTransaction();
            try {
                $posts = POST::select('post_id')
                    ->join('users', 'users.id', '=', 'posts.post_author')
                    ->where('post_author', $user->id)
                    ->get();
                foreach ($posts as $post) {
                    $post->delete();
                }
                $user->delete();
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
            }
        } elseif ($request->delete == 'not_delete') {
            try {
                $recent_user = $request->username;
                $posts = POST::select('post_id')
                    ->join('users', 'users.id', '=', 'posts.post_author')
                    ->where('post_author', $user->id)
                    ->get();
                foreach ($posts as $post) {
                    $post->post_author = $recent_user;
                    $post->save();
                }
                $user->delete();
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
            }
        }

        return redirect('admin/home/users');
    }

    public function confirm(Request $request)
    {
        $thisUser = User::find($request->id);

        $users = User::where('id', '<>', $thisUser->id)->select('id', 'name')->get();
        return view('admin.confirm', ['thisUser' => $thisUser, 'users' => $users]);
    }
}
