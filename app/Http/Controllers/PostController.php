<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Post;
use App\Tag;
use App\Image;
use Session;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(10);

        return view('posts.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        return view('posts.create')->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate the data
        $this->validate($request, array(
            'title' => 'required|max:200',
            'slug' => 'required|alpha_dash|min:5|max:200|unique:posts,slug',
            'post_content' => 'required',
            'user_id' => 'required|integer'

        ));

        //store in the database
            $post = new Post;

            $post->title = $request->title;
            $post->slug = $request->slug;
            $post->post_content = $request->post_content;
            $post->user_id = $request->user_id;

            $post->save();

            $post->tags()->sync($request->tags, false);

            Session::flash('succes', 'The post was saved!');

        //redirect to another page
            return redirect()->route('posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        
        return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tags = Tag::all();
        $tags2 = array();
        foreach ($tags as $tag) {
            $tags2[$tag->id] = $tag->name;
        }
        $post = Post::find($id);
        return view('posts.edit')->withPost($post)->withTags($tags2);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        if ($request->slug == $post->slug) {
            $this->validate($request, array(
            'title' => 'required|max:100',
            'post_content' => 'required'
        ));
        }else {
            $this->validate($request, array(
                'title' => 'required|max:100',
                'slug' => 'required|alpha_dash|min:5|max:200|unique:posts,slug',
                'post_content' => 'required'
            ));
        }

        $post = Post::find($id);

        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->post_content = $request->post_content;

        $post->save();

        $post->tags()->sync($request->tags);

        Session::flash('succes', 'The post was modified!');

        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->tags()->detach();

        $post->delete();

        Session::flash('succes', 'The post was deleted!');
        return redirect()->route('posts.index');

    }
}
