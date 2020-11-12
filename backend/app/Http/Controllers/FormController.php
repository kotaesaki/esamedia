<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class FormController extends Controller
{
    public function show()
    {
        return view('admin.new');
    }

    public function newPost(Request $request)
    {
        $request->validate([
            'image' => 'required|file|image|mimes:png,jpeg',
            'post_title' => 'required|string|',
            'post_content' =>'required|string|'
        ]);
        try{
            $upload_image = $request->file('image');
            if($upload_image) {
                //アップロードされた画像を保存する
                $path = $upload_image->store('uploads',"public");
                
                //画像の保存に成功したらDBに記録する
                if($path){
                    DB::beginTransaction();
                    try {
                        POST::create([
                            'post_author' => Auth::user()->id,
                            'post_title' => $request->post_title,
                            'post_content' => $request->post_content,
                            'post_status' => 'publish',
                            'post_date' => Carbon::now(),
                            'post_modified' => Carbon::now(),
                            "file_name" => $upload_image->getClientOriginalName(),
                            "file_path" => $path
                        ]);
                        DB::commit();

                    }catch (\Exception $e) {
                        DB::rollback();
                    }
                }
            }
        }catch(\Exception $e) {
            return redirect('/admin/home/new');
        }

        $post_id = POST::max('post_id');
        $posts = POST::where('post_id', $post_id)->get();

        return view('admin.complete',['posts' => $posts]);

    }

    public function edit(Request $request,$post_id)
    {
        $posts = POST::where('post_id', $post_id)->get();
        return view('admin.edit',['posts' => $posts]);
    }

    public function editPost(Request $request)
    {
        $posts = POST::find($request->post_id);
        $request->validate([
            'post_title' => 'required|string|',
            'post_content' =>'required|string|'
        ]);

        try{
            DB::beginTransaction();

            $upload_image = $request->file('image');
            if($upload_image){
                //アップロードされた画像を保存する
                $path = $upload_image->store('uploads',"public");
                //画像の保存に成功したらDBに記録する
                if($path){
                    try {
                        $posts->file_name = $upload_image->getClientOriginalName();
                        $posts->file_path = $path;
                        $posts->save();

                    }catch(\Exception $e){

                    }
                }
            }   
            try{
                $posts->post_title = $request->post_title;
                $posts->post_content = $request->post_content;
                $posts->post_modified = Carbon::now();
                $posts->save();
                DB::commit();
            }catch(\Exception $e){
                DB::rollback();
            }
        }catch(\Exception $e) {
                return redirect('/admin/home/edit');
        }
        return view('admin.complete');

    }
}