<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Post;
use App\Tag;
use App\Picture;
use Session;
use Image;
use Purifier;
use Storage;

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
            'user_id' => 'required|integer',
            'imageUpload' => 'sometimes|image'

        ));

        //store in the database
            $post = new Post;

            $post->title = $request->title;
            $post->slug = $request->slug;
            $post->post_content = Purifier::clean($request->post_content);
            $post->user_id = $request->user_id;
            if ($request->hasFile('imageUpload')) {
                $image = $request->file('imageUpload');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $location = public_path('img/' . $filename);
                Image::make($image)->resize(400, 300)->save($location);
                
                $post->save();

                $picture = new Picture;
                $picture->directory = $filename;
            
                $post->picture()->save($picture);
            }else{
                $post->save();
            }

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
        
        $post->increment('views');

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
        
            $this->validate($request, array(
                'title' => 'required|max:100',
                'slug' => "required|alpha_dash|min:5|max:200|unique:posts,slug,$id",
                'post_content' => 'required',
                'imageUpload' => 'sometimes|image'
            ));
        

        $post = Post::find($id);

        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->post_content = Purifier::clean($request->post_content);

        if ($request->hasFile('imageUpload')) {
                //add new photo
                $image = $request->file('imageUpload');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $location = public_path('img/' . $filename);
                Image::make($image)->resize(400, 300)->save($location);
                
                $post->save();
                $picture = Picture::find($post->picture->id);

                $oldFilename = $picture->directory;

                //update database
                $picture->directory = $filename;
                
                //delete old photo
                Storage::delete($oldFilename);

                $post->picture()->save($picture);
            }else{
                $post->save();
            }

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

        $picture = $post->picture->directory;
        Storage::delete($picture);

        $post->picture()->delete();
        $post->comments()->delete();

        $post->delete();

        Session::flash('succes', 'The post was deleted!');
        return redirect()->route('posts.index');

    }
}
