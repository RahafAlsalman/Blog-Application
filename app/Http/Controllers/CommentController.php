<?php

namespace App\Http\Controllers;

use App\Models\Comment; // Make sure to create this model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'post_id' => 'required|exists:posts,id',
            'comment' => 'required|string|max:255',
        ]);

        $comment = Comment::create($request->only('user_id', 'post_id', 'comment'));

        return response()->json([
            'user_name' => $comment->user->name, // Assuming you have a relationship set up
            'image' => $comment->user->image,
            'comment' => $comment->comment,
        ]);
    }


    public function update(Request $request, $id)
{
    $comment = Comment::findOrFail($id);

    if ($comment->user_id !== Auth::id()) {
        return response()->json(['success' => false], 403);
    }
    $comment->comment = $request->input('comment');
    
    $comment->save();
    return response()->json(['success' => true]);
}



public function destroy($id)
{
    $comment = Comment::findOrFail($id);
    if ($comment->user_id !== Auth::id()) {
        return response()->json(['success' => false], 403);
    }
    $comment->delete();
    return response()->json(['success' => true]);
}

}
