<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Term;


class SearchController extends Controller
{
  public function index(Request $request)
  {

    $keyword = $request->keyword;
    if ($keyword != '') {
      $posts = POST::where('post_title', 'like', '%' . $keyword . '%')->orderBy('post_date', 'desc')->simplePaginate(10);
    } else {
      $posts = POST::orderBy('post_date', 'desc')->simplePaginate(10);
    }
    $posts_new = POST::orderBy('post_date', 'desc')->take(10)->get();
    $terms_parent = TERM::where('taxonomy', 'category')
      ->where('parent', 0)
      ->get();
    $terms_child = TERM::where('taxonomy', 'category')
      ->where('parent', '>=', 1)
      ->get();

    $terms_tag = TERM::where('taxonomy', 'tag')->get();

    return view('top', [
      'posts' => $posts,
      'posts_new' => $posts_new,
      'terms_parent' => $terms_parent,
      'terms_child' => $terms_child,
      'terms_tag' => $terms_tag
    ]);
  }

  public function searchCategory(Request $request, $term_slug)
  {

    $posts_new = POST::orderBy('post_date', 'desc')->take(10)->get();

    $terms_parent = TERM::where('taxonomy', 'category')
      ->where('parent', 0)
      ->get();
    $terms_child = TERM::where('taxonomy', 'category')
      ->where('parent', '>=', 1)
      ->get();

    $term_slug = TERM::where('taxonomy', 'category')
      ->where('term_slug', $request->term_slug)
      ->select('term_slug')
      ->first();
    $posts = POST::whereHas('terms', function ($query) use ($term_slug) {
      $query->whereIn('term_slug', $term_slug);
    })
      ->orderBy('post_date', 'desc')->simplePaginate(10);


    $terms_tag = TERM::where('taxonomy', 'tag')->get();
    return view('top', [
      'term_slug' => $term_slug,
      'posts' => $posts,
      'posts_new' => $posts_new,
      'terms_parent' => $terms_parent,
      'terms_child' => $terms_child,
      'terms_tag' => $terms_tag
    ]);
  }

  public function searchTag(Request $request, $term_slug)
  {
    $term_slug = TERM::where('taxonomy', 'tag')
      ->where('term_slug', $request->term_slug)
      ->select('term_slug')
      ->first();
    $posts = POST::whereHas('terms', function ($query) use ($term_slug) {
      $query->whereIn('term_slug', $term_slug);
    })
      ->orderBy('post_date', 'desc')->simplePaginate(10);
    $posts_new = POST::orderBy('post_date', 'desc')->take(10)->get();

    $terms_parent = TERM::where('taxonomy', 'category')
      ->where('parent', 0)
      ->get();
    $terms_child = TERM::where('taxonomy', 'category')
      ->where('parent', '>=', 1)
      ->get();

    $terms_tag = TERM::where('taxonomy', 'tag')->get();
    return view('top', [
      'term_slug' => $term_slug,
      'posts' => $posts,
      'posts_new' => $posts_new,
      'terms_parent' => $terms_parent,
      'terms_child' => $terms_child,
      'terms_tag' => $terms_tag
    ]);
  }
}
