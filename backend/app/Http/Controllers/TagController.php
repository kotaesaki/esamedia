<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Term;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
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
        $terms = TERM::where('taxonomy', 'tag')
            ->select('term_id', 'term_name', 'term_description', 'term_slug')
            ->get();
        $category_id = TERM::where('taxonomy', 'category')->select('term_id');

        return view('admin.tag', ['terms' => $terms]);
    }
    public function create(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:100',
            'slug' => 'required|alpha_dash|max:100',
            'description' => 'required|string|',
        ]);


        DB::beginTransaction();
        try {
            TERM::create([
                'term_name' => $request->name,
                'term_slug' => $request->slug,
                'term_description' => $request->description,
                'taxonomy' => 'tag',
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
        return redirect('admin/home/tag');
    }
    public function delete(Request $request)
    {
        $term = TERM::find($request->id);
        $term->delete();
        return redirect('admin/home/tag');
    }

    public function edit($term_id)
    {
        $term = TERM::find($term_id);
        return view('admin.edittag', ['term' => $term]);
    }

    public function update(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:100',
            'slug' => 'required|alpha_dash|max:100',
            'description' => 'required|string|',
        ]);

        $terms = TERM::find($request->id);

        DB::beginTransaction();
        try {
            $terms->term_name = $request->name;
            $terms->term_slug = $request->slug;
            $terms->term_description = $request->description;
            $terms->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }

        return redirect('admin/home/tag');
    }
}
