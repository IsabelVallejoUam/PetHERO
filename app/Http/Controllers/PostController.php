<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;

use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('owner_id',Auth::id())->simplePaginate(6);
        return view('forum.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = new Post();
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->privacy = $request->input('privacy');
        $post->owner_id = Auth::id();
        $post->save();
        return redirect(route('forum.index'))->with('_success', 'Post creado exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $answers = Comment::where('post_id',$post->id)->get();
        return view('post.show',compact(['post','answers']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('post.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->privacy = $request->input('privacy');
        $post->save();
        return redirect(route('post.show', $post->id))->with('_success', 'Post editado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->owner->id == Auth::id()){
            $post->delete();
            return redirect(route('forum.index'))->with('_success', 'Post eliminado exitosamente!');
        } else {
            return back()->with('failure','_No se ha podido borrar el post');
        }
    }
}
