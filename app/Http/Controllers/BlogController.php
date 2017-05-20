<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Image;
use App\Tag;

class BlogController extends Controller
{
	public function getIndex(){
		
    	$posts = Post::orderBy('id', 'desc')->paginate(5);
    	$rands = Post::inRandomOrder()->limit(3)->get();
    	$views = Post::orderBy('views', 'desc')->limit(3)->get();
        
    	return view('blog.index')->withPosts($posts)->withRands($rands)->withViews($views);
    }

    public function getSingle($slug){

    	$post = Post::where('slug', '=', $slug)->first();
    	$rands = Post::inRandomOrder()->limit(3)->get();
        
    	$post->increment('views');
        $views = Post::orderBy('views', 'desc')->limit(3)->get();

    	return view('blog.single')->withPost($post)->withRands($rands)->withViews($views);
    }
}
