<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Term;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
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
        $terms = TERM::where('taxonomy', 'category')
            ->select('term_id', 'term_name', 'term_description', 'term_slug')
            ->get();
        $category_id = TERM::where('taxonomy', 'category')->select('term_id');

        return view('admin.category', ['terms' => $terms]);
    }

    public function create(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:100',
            'slug' => 'required|alpha_dash|max:100',
            'parent' => 'required|string|',
            'description' => 'required|string|',
        ]);


        if ($request->parent == 'なし') {
            $parent = 0;
        } else {
            $parent = $request->parent;
        }

        DB::beginTransaction();
        try {

            TERM::create([
                'term_name' => $request->name,
                'term_slug' => $request->slug,
                'term_description' => $request->description,
                'taxonomy' => 'category',
                'parent' => $parent,
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
        return redirect('/admin/home/category');
    }

    public function delete(Request $request)
    {
        $term = TERM::find($request->id);
        $term->delete();
        return redirect('admin/home/category');
    }

    public function edit($term_id)
    {
        $term = TERM::find($term_id);

        $terms_category = TERM::where('taxonomy', 'category')
            ->where('term_id', '<>', $term_id)
            ->get();

        $term_parent = TERM::where('term_id', $term->parent)->first();
        return view('admin.editcategory', [
            'term' => $term,
            'terms_category' => $terms_category,
            'term_parent' => $term_parent
        ]);
    }

    public function update(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:100',
            'slug' => 'required|alpha_dash|max:100',
            'parent' => 'required|string|',
            'description' => 'required|string|',
        ]);
        if ($request->parent == 'なし') {
            $parent = 0;
        } else {
            $parent = $request->parent;
        }
        $terms = TERM::find($request->id);

        DB::beginTransaction();
        try {
            $terms->term_name = $request->name;
            $terms->term_slug = $request->slug;
            $terms->parent = $parent;
            $terms->term_description = $request->description;
            $terms->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }

        return redirect('admin/home/category');
    }
}
