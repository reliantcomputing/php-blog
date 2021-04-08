<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', ['posts' => $posts]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:55',
            'body' => 'required|max:500'
        ]);

        $request->user()->posts()->create([
            'title' => $request->title,
            'body' => $request->body
        ]);

        return redirect()->route('posts')->with('success', 'Post created successfully!');
    }

    public function edit(Post $post)
    {
        if (!$post->ownedBy(auth()->user())) {
            return redirect()->route('posts')->with('error', "You can only edit posts you created.");
        }
        return view('posts.edit', ['post' => $post]);
    }

    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'title' => 'required|max:55',
            'body' => 'required|max:500'
        ]);

        if (!$post->ownedBy($request->auth()->user())) {
            return redirect()->route('posts')->with('error', "You can only edit posts you created.");
        }

        $post->update([
            'title' => $request->title,
            'body' => $request->body
        ]);

        return redirect()->route('posts')->with('success', 'Post updated successfully!');
    }

    public function delete(Post $post)
    {
        if (!$post->ownedBy(auth()->user())) {
            return redirect()->route('posts')->with('error', "You can only edit posts you created.");
        }
        $post->delete();
        return redirect()->route('posts')->with('success', "Post deleted successfully!");
    }
}
