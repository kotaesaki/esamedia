<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'App\Http\Controllers\TopController@index')->name('index');

Route::get('/pages/{post_id?}', 'App\Http\Controllers\PageController@showPage')->name('show_page');
Route::get('/search', 'App\Http\Controllers\SearchController@index')->name('search');
Route::get('/category/{term_slug}', 'App\Http\Controllers\SearchController@searchCategory')->name('search_category');
Route::get('/tag/{term_slug}', 'App\Http\Controllers\SearchController@searchTag')->name('search_tag');

Route::post('/pages/{post_id}/comment', 'App\Http\Controllers\CommentController@send')->name('send_comment');



Auth::routes();

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'App\Http\Controllers\Admin\HomeController@showHome')->name('admin.showHome');
    Route::get('home', 'App\Http\Controllers\Admin\HomeController@index')->name('admin.home');
    Route::get('login', 'App\Http\Controllers\Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'App\Http\Controllers\Admin\LoginController@login')->name('admin.login');
    Route::post('home', 'App\Http\Controllers\Admin\LoginController@logout')->name('admin.logout');

    Route::get('home/publish', 'App\Http\Controllers\PostController@getPublish')->name('post_getPublish');
    Route::get('home/private', 'App\Http\Controllers\PostController@getPrivate')->name('post_getPrivate');

    Route::get('home/new', 'App\Http\Controllers\FormController@show')->name('show_form');
    Route::get('home/{post_id}/edit', 'App\Http\Controllers\FormController@edit')->name('edit_form');
    Route::post('home/new/complete', 'App\Http\Controllers\FormController@newPost')->name('new_post');
    Route::post('home/edit/complete', 'App\Http\Controllers\FormController@editPost')->name('edit_post');
    Route::post('home/delete/{post_id}', 'App\Http\Controllers\FormController@delete')->name('delete_post');

    Route::get('home/category', 'App\Http\Controllers\CategoryController@index')->name('get_category');
    Route::post('home/category/create', 'App\Http\Controllers\CategoryController@create')->name('create_category');
    Route::post('home/category/delete', 'App\Http\Controllers\CategoryController@delete')->name('delete_category');
    Route::get('home/category/{term_id}/edit', 'App\Http\Controllers\CategoryController@edit')->name('edit_category');
    Route::post('home/category/update', 'App\Http\Controllers\CategoryController@update')->name('update_category');

    Route::get('home/tag', 'App\Http\Controllers\TagController@index')->name('get_tag');
    Route::post('home/tag/create', 'App\Http\Controllers\TagController@create')->name('create_tag');
    Route::post('home/tag/delete', 'App\Http\Controllers\TagController@delete')->name('delete_tag');
    Route::get('home/tag/{term_id}/edit', 'App\Http\Controllers\TagController@edit')->name('edit_tag');
    Route::post('home/tag/update', 'App\Http\Controllers\TagController@update')->name('update_tag');

    Route::get('home/register', 'App\Http\Controllers\Admin\RegisterController@showRegisterForm')->name('admin.register');
    Route::post('home/register/complete', 'App\Http\Controllers\Admin\RegisterController@create')->name('create_register');

    Route::get('home/users', 'App\Http\Controllers\UserAdminController@index')->name('show_users');
    Route::post('home/users/delete', 'App\Http\Controllers\UserAdminController@delete')->name('delete_user');
    Route::get('home/users/confirm', 'App\Http\Controllers\UserAdminController@confirm')->name('confirm_user');
});
