<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;


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
        $upload_image = $request->file('image');
        if($upload_image) {
			//アップロードされた画像を保存する
			$path = $upload_image->store('uploads',"public");
			//画像の保存に成功したらDBに記録する
			if($path){
				POST::create([
					"file_name" => $upload_image->getClientOriginalName(),
					"file_path" => $path
				]);
			}
        }
        return redirect("/admin/home");

    }
}
