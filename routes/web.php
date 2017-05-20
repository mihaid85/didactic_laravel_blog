<?php

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

	
	Route::get('/', array('as' => 'blog.index', 'uses' => 'BlogController@getIndex'));
	Route::get('blog/{slug}', array('as' => 'blog.single', 'uses' => 'BlogController@getSingle'))->where('slug', '[\w\-]+');
	
	Route::resource('posts', 'PostController');

	Auth::routes();

	Route::resource('tags', 'TagController', ['except' => ['create']]);

	Route::resource('comments', 'CommentController', ['except' => ['create', 'store', 'show']]);
	Route::post('comments/{post_id}', ['uses' => 'CommentController@store', 'as' => 'comments.store']);

	Route::post('picture/upload', ['as' => 'picture.upload', 'uses' => 'PictureController@upload']);