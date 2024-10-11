<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;


class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view post', ['only' => ['index']]);
        $this->middleware('permission:create post', ['only' => ['create','store']]);
        $this->middleware('permission:update post', ['only' => ['update','edit']]);
        $this->middleware('permission:delete post', ['only' => ['destroy']]);
    }

    public function index()
    {
        return view('dashboard');
    }

    public function create()
    {
        return view('post.create', );
    }

    public function edit( $postId)
    {
        $post=Post::find($postId);
        return view('post.edit', ['post' => $post] );
    }
    public function store(Request $request)
{
    
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
    ]);

    $post = new Post($request->only('title', 'content'));
    $post->user_id = auth()->id(); // Set the user_id to the authenticated user's ID
    $post->save();

    return redirect()->route('dashboard')->with('success', 'Post created successfully.');
}


public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = Post::findOrFail($id);
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();

        return redirect()->route('dashboard')->with('success', 'Post updated successfully.');
    }

public function destroy($postId)
    {
        $post = Post::find($postId);
        $post->delete();
        return redirect('dashboard')->with('status','Role Deleted Successfully');
    }


}