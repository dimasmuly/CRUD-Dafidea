<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'content' => 'required|string',
        ]);

        $comment = Comment::create($validated);
        Log::debug('Comment created with ID: ' . $comment->id . ' for post ID: ' . $comment->post_id);
        return response()->json(['message' => 'Comment created successfully', 'data' => $comment], 201);
    }

    public function update(Request $request, Comment $comment)
    {
        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        $comment->update($validated);
        Log::debug('Comment updated with ID: ' . $comment->id);
        return response()->json(['message' => 'Comment updated successfully', 'data' => $comment]);
    }

    public function destroy(Comment $comment)
    {
        Log::debug('Deleting comment with ID: ' . $comment->id);
        $comment->delete();
        return response()->json(['message' => 'Comment deleted successfully'], 200);
    }

    public function index($post_id)
    {
        $comments = Comment::where('post_id', $post_id)->get();
        return response()->json($comments);
    }
}
