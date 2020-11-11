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



Auth::routes();
Route::group(['prefix' => 'admin'], function() {
    Route::get('/', 'App\Http\Controllers\Admin\HomeController@showHome')->name('admin.showHome');
    Route::get('home', 'App\Http\Controllers\Admin\HomeController@index')->name('admin.home');
    Route::get('login', 'App\Http\Controllers\Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'App\Http\Controllers\Admin\LoginController@login')->name('admin.login');
    Route::post('home', 'App\Http\Controllers\Admin\LoginController@logout')->name('admin.logout');

    Route::get('home/publish', 'App\Http\Controllers\PostController@getPublish')->name('post_getPublish');
    Route::get('home/private', 'App\Http\Controllers\PostController@getPrivate')->name('post_getPrivate');

    Route::get('home/new', 'App\Http\Controllers\FormController@show')->name('show_form');

    Route::get('register', 'App\Http\Controllers\Auth\RegisterController@showRegisterForm')->name('admin.register');
});


Route::post('/pages', 'App\Http\Controllers\FormController@newPost')->name('new_post');

