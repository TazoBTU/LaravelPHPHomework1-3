<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('tags')->get();
        return view('post/all-posts')->with('posts', $posts);
    }

    public function show(Post $post)
    {
        return view('post/show-post')->with('post', $post);
    }

    public function create()
    {
        $tags = Tag::all();
        return view('post/create-post')->with('tags', $tags);
    }

    public function save(Request $request)
    {
        $post = new Post($request->all());
        $post->user_id = Auth::id();
        $post->save();
        $post->tags()->attach($request->tags);
        return redirect()->route('posts.all');
    }

    public function edit(Post $post)
    {
        $tags = Tag::all();
        return view('post/edit-post', compact('post', 'tags'));
    }

    public function update(Request $request, Post $post)
    {
        $post->update($request->all());
        $post->user_id = Auth::id();
        $post->tags()->detach($post->tags->pluck('id'));
        $post->tags()->attach($request->tags);
        return redirect()->route('posts.all');
    }

    public function delete(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.all');
    }

}
