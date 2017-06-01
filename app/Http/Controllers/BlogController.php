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
		
    	$posts = Post::orderBy('id', 'desc')->paginate(10);
    	$rands = Post::inRandomOrder()->limit(5)->get();
    	$views = Post::orderBy('views', 'desc')->limit(5)->get();
        $tags = Tag::all();
        $tags2 = array();
        foreach ($tags as $tag) {
            $tags2[$tag->id] = $tag->name;
        }
        
    	return view('blog.index')->withPosts($posts)->withRands($rands)->withViews($views)->withTags($tags2);
    }

    public function getSingle($slug){

    	$post = Post::where('slug', '=', $slug)->first();
    	$rands = Post::inRandomOrder()->limit(5)->get();
        $tags = Tag::all();
        $tags2 = array();
        foreach ($tags as $tag) {
            $tags2[$tag->id] = $tag->name;
        }
    	$post->increment('views');
        $views = Post::orderBy('views', 'desc')->limit(5)->get();

    	return view('blog.single')->withPost($post)->withRands($rands)->withViews($views)->withTags($tags2);
    }
}
