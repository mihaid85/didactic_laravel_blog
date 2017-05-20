<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comment;
use App\Post;
use App\User;
use Session;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $post_id)
    {
        $this->validate($request, array(
            'content'   => 'required|min:5|max:2000',
            'parent'    => 'required|max:5',
            'user_id'   => 'required|integer',
        ));

        $post = Post::find($post_id);

        $comment = new Comment();

        $comment->content = Purifier::clean($request->content);
        $comment->parent = $request->parent;
        $comment->post()->associate($post);
        $comment->user_id = $request->user_id;

        $comment->save();
        Session::flash('succes', 'The comment was added!');

        return redirect()->route('blog.single', [$post->slug]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::find($id);
        $rands = Post::inRandomOrder()->limit(3)->get();
        $views = Post::orderBy('views', 'desc')->limit(3)->get();

        return view('comments.edit')->withComment($comment)->withRands($rands)->withViews($views);
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
        $comment = Comment::find($id);

        $this->validate($request, array('content' => 'required|min:5|max:2000'));

        $comment->content = Purifier::clean($request->content);
        $comment->save();

        Session::flash('succes', 'The comment was edited!');

        return redirect()->route('blog.single', $comment->post->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->post()->dissociate();
        // $comment->save();
        
        $comment->delete();

        Session::flash('succes', 'The comment was deleted!');
        return redirect()->back();

    }
}
