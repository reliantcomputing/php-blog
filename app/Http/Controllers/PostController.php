<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }

    public function index()
    {
        $posts = Post::orderBy('updated_at', 'desc')->get();
        return view('posts.index', ['posts' => $posts]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:55',
            'body' => 'required|max:500'
        ]);

        $is_saved = $request->user()->posts()->create([
            'title' => $request->title,
            'body' => $request->body
        ]);

        if (!$is_saved) {
            return back()->with('info', 'Something went wrong while saving post, please try again');
        }

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

        if (!$post->ownedBy(auth()->user())) {
            return redirect()->route('posts')->with('error', "You can only update posts you created.");
        }

        $is_updated = $post->update([
            'title' => $request->title,
            'body' => $request->body
        ]);

        if (!$is_updated) {
            return back()->with('info', 'Something went wrong while saving post, please try again');
        }

        return redirect()->route('posts')->with('success', 'Post updated successfully!');
    }

    public function delete(Post $post)
    {
        if (!$post->ownedBy(auth()->user())) {
            return redirect()->route('posts')->with('error', "You can only delete posts you created.");
        }
        $is_deleted = $post->delete();

        if (!$is_deleted) {
            return back()->with('info', 'Something went wrong while saving post, please try again');
        }
        return redirect()->route('posts')->with('success', "Post deleted successfully!");
    }
}
