<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function index()
    {
        Log::debug('Fetching all posts');
        $posts = Post::with('comments')->get();
        return response()->json(['message' => 'Posts retrieved successfully', 'data' => $posts]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'tanggal_post' => 'required|date',
        ]);

        $post = Post::create($validated);
        Log::debug('Post created with ID: ' . $post->id);
        return response()->json(['message' => 'Post created successfully', 'data' => $post], 201);
    }

    public function show(Post $post)
    {
        Log::debug('Fetching post with ID: ' . $post->id);
        return response()->json(['message' => 'Post retrieved successfully', 'data' => $post->load('comments')]);
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'judul' => 'string|max:255',
            'konten' => 'string',
            'tanggal_post' => 'date',
        ]);

        $post->update($validated);
        Log::debug('Post updated with ID: ' . $post->id);
        return response()->json(['message' => 'Post updated successfully', 'data' => $post]);
    }

    public function destroy(Post $post)
    {
        Log::debug('Deleting post with ID: ' . $post->id);
        $post->delete();
        return response()->json(['message' => 'Post deleted successfully'], 200);
    }
}
