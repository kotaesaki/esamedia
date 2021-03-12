<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Term;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class FormController extends Controller
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

    public function show()
    {

        $terms_parent = TERM::where('taxonomy', 'category')
            ->where('parent', 0)
            ->get();
        $terms_child = TERM::where('taxonomy', 'category')
            ->where('parent', '>=', 1)
            ->get();
        $terms_tag = TERM::where('taxonomy', 'tag')->get();

        return view('admin.new', [
            'terms_parent' => $terms_parent,
            'terms_child' => $terms_child,
            'terms_tag' => $terms_tag
        ]);
    }

    public function newPost(Request $request)
    {
        $request->validate([
            'image' => 'required|file|image|mimes:png,jpeg|max:1024',
            'post_title' => 'required|string|max:200',
            'post_content' => 'required|string|',
            'post_excerpt' => 'required|string|max:200'
        ]);

        try {
            $upload_image = $request->file('image');
            if ($upload_image) {
                $disk = Storage::disk('s3')->putFile('/loglog', $upload_image,'public');
                $path = Storage::disk('s3')->url($disk);
                if ($path) {
                    DB::beginTransaction();
                    try {
                        if ($request->has('publish')) {
                            POST::create([
                                'post_author' => Auth::user()->id,
                                'post_title' => $request->post_title,
                                'post_content' => $request->post_content,
                                'post_status' => 'publish',
                                'post_date' => Carbon::now(),
                                'post_modified' => Carbon::now(),
                                'post_excerpt' => $request->post_excerpt,
                                "file_name" => $upload_image->getClientOriginalName(),
                                "file_path" => $path,
                            ]);
                        } elseif ($request->has('private')) {
                            POST::create([
                                'post_author' => Auth::user()->id,
                                'post_title' => $request->post_title,
                                'post_content' => $request->post_content,
                                'post_status' => 'private',
                                'post_date' => Carbon::now(),
                                'post_modified' => Carbon::now(),
                                'post_excerpt' => $request->post_excerpt,
                                'file_name' => $upload_image->getClientOriginalName(),
                                'file_path' => $path,
                            ]);
                            dd($request->post_excerpt);
                        }
                        DB::commit();
                    } catch (\Exception $e) {
                        DB::rollback();
                    }
                }
            }
        } catch (\Exception $e) {
            return redirect('/admin/home/new');
        }
        $post_id = POST::max('post_id');
        $posts = POST::where('post_id', $post_id)->get();
        if (is_array($request->category)) {
            $post1 = POST::find($post_id);
            $post1->terms()->detach();
            $post1->terms()->attach($request->category);
            $post1->terms()->attach($request->tags);
        }

        return view('admin.complete', ['posts' => $posts]);
    }

    public function edit(Request $request, $post_id)
    {
        $terms_parent = TERM::where('taxonomy', 'category')
            ->where('parent', 0)
            ->get();
        $terms_child = TERM::where('taxonomy', 'category')
            ->where('parent', '>=', 1)
            ->get();
        $terms_tag = TERM::where('taxonomy', 'tag')->get();
        $posts = POST::where('post_id', $post_id)->get();

        return view('admin.edit', [
            'posts' => $posts,
            'terms_parent' => $terms_parent,
            'terms_child' => $terms_child,
            'terms_tag' => $terms_tag
        ]);
    }

    public function editPost(Request $request)
    {
        $posts = POST::find($request->post_id);
        $request->validate([
            'image' => 'file|image|mimes:png,jpeg|max:1024',
            'post_title' => 'required|string|',
            'post_content' => 'required|string|',
            'post_excerpt' => 'required|string|max:200'
        ]);

        try {
            DB::beginTransaction();

            $upload_image = $request->file('image');
            if ($upload_image) {
                $disk = Storage::disk('s3')->putFile('/loglog', $upload_image,'public');
                $path = Storage::disk('s3')->url($disk);
                if ($path) {
                    try {
                        $posts->file_name = $upload_image->getClientOriginalName();
                        $posts->file_path = $path;
                        $posts->save();
                    } catch (\Exception $e) {
                    }
                }
            }
            try {
                $posts->post_title = $request->post_title;
                $posts->post_content = $request->post_content;
                $posts->post_modified = Carbon::now();
                $posts->post_excerpt = $request->post_excerpt;
                if ($request->has('publish')) {
                    $posts->post_status = 'publish';
                } elseif ($request->has('private')) {
                    $posts->post_status = 'private';
                }
                $posts->save();

                if (is_array($request->category)) {
                    $posts->terms()->detach();
                    $posts->terms()->attach($request->category);
                    $posts->terms()->attach($request->tags);
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
            }
        } catch (\Exception $e) {
            return redirect('/admin/home/edit');
        }
        return view('admin.complete');
    }

    public function delete($post_id)
    {
        $post = POST::find($post_id);
        $post->delete();
        return redirect('admin/home');
    }
}
