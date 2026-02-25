<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user'])  // Load user hindari error N+1
                    ->where('is_published', true)
                    ->latest('published_at')  // Urut published_at biar konsisten
                    ->paginate(6);

        return view('pages.blog.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)
            ->where('is_published', true)
            ->with(['comments' => function ($query) {
                $query->where('is_approved', true)->latest();
            }])
            ->firstOrFail();

        return view('pages.blog.show', compact('post'));
    }

    public function storeComment(Request $request, $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'content' => 'required|string',
        ]);

        $comment = $post->comments()->create([
            'name' => $request->name,
            'email' => $request->email,
            'content' => $request->content,
            'is_approved' => false,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Comment submitted for approval!',
            'comment' => [
                'id' => $comment->id,
                'name' => $comment->name,
                'content' => $comment->content,
                'created_at' => $comment->created_at->toISOString(),
            ],
            'comment_count' => $post->comments()->count(),
        ]);
    }
}
