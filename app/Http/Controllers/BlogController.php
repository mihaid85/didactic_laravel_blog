<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Post;
use App\Image;
use App\Tag;

class BlogController extends Controller
{
	public function getIndex(){
		
    	$posts = Post::orderBy('id', 'desc')->paginate(5);
    	return view('blog.index')->withPosts($posts);
    }

    public function getSingle($slug){

    	$post = Post::where('slug', '=', $slug)->first();
    	return view('blog.single')->withPost($post);
    }
}
