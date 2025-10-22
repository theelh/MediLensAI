<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\PostMedia;
use App\Models\Comments;
use App\Models\Like;

class PostController extends Controller
{
    public function index()
    {
        // Show public posts for all users
        $posts = Post::with(['user', 'files', 'likes', 'comments.user'])
            ->where('visibility', 'public')
            ->latest()
            ->get();

        return view('posts.index', compact('posts'));
    }

    public function create()
{
    return view('doctor.posts.create');
}



    // -------------------
    // Stocker un nouveau post
    // -------------------

public function store(Request $req)
{
    // 1️⃣ Validation
    $validated = $req->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'media.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
    ]);

    // 2️⃣ Create the Post record
    $post = Post::create([
        'user_id' => auth()->id(), // Make sure the doctor is logged in
        'title' => $validated['title'],
        'description' => $validated['description'] ?? null,
    ]);

    // 3️⃣ Handle file uploads
    if ($req->hasFile('media')) {
        foreach ($req->file('media') as $file) {
            $path = $file->store('posts', 'public'); // storage/app/public/posts

            $post->media()->create([
                'path' => $path,
                'type' => $file->getClientOriginalExtension() === 'pdf' ? 'pdf' : 'image',
            ]);
        }
    }

    // 4️⃣ Redirect with success message
    return redirect()->back()->with('success', 'Post créé avec succès ✅');
}
    // -------------------
    // Afficher le formulaire d’édition
    // -------------------
    public function edit(Post $post)
    {
        $this->authorize('update', $post); // protection si tu utilises Policies

        return view('doctor.posts.edit', compact('post'));
    }

    // -------------------
    // Mettre à jour un post
    // -------------------
    public function update(Request $req, Post $post)
    {
        $this->authorize('update', $post);

        $req->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'media.*' => 'file|mimes:jpeg,png,jpg,pdf|max:20480',
        ]);

        $post->update([
            'title' => $req->title,
            'description' => $req->description,
        ]);

        // Si de nouveaux fichiers sont ajoutés
        if ($req->hasFile('media')) {
            foreach ($req->file('media') as $file) {
                $path = $file->store('posts', 'public');
                $type = $file->getClientOriginalExtension() === 'pdf' ? 'pdf' : 'image';

                PostMedia::create([
                    'post_id' => $post->id,
                    'path' => $path,
                    'type' => $type,
                ]);
            }
        }

        return redirect()->route('doctor.posts.index')->with('success', 'Post mis à jour avec succès.');
    }

    // -------------------
    // Supprimer un post
    // -------------------
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        // Supprimer les médias du stockage
        foreach ($post->media as $media) {
            Storage::disk('public')->delete($media->path);
        }

        // Supprimer le post (les PostMedia liés seront supprimés via cascade)
        $post->delete();

        return redirect()->route('doctor.posts.index')->with('success', 'Post supprimé avec succès.');
    }

    public function toggleLike($id)
    {
        $post = Post::findOrFail($id);
        $user = auth()->user();

        if ($post->likes()->where('user_id', $user->id)->exists()) {
            $post->likes()->where('user_id', $user->id)->delete();
            $liked = false;
        } else {
            $post->likes()->create(['user_id' => $user->id]);
            $liked = true;
        }

        return response()->json([
            'liked' => $liked,
            'count' => $post->likes()->count(),
        ]);
    }

    // Store a comment
    public function storeComment(Request $request, Post $post)
{
    $request->validate([
        'content' => 'required|string|max:1000',
    ]);

    $comment = Comments::create([
        'user_id' => auth()->id(),
        'post_id' => $post->id,
        'content' => $request->content,
    ]);

    return response()->json([
        'success' => true,
        'comment' => [
            'user' => $comment->user->name,
            'content' => $comment->content,
        ],
    ]);
}

public function loadComments(Post $post)
{
    $comments = $post->comments()->with('user')->latest()->get();

    return response()->json([
        'comments' => $comments->map(function ($c) {
            return [
                'user' => $c->user->name,
                'role' => $c->user->role ?? null,
                'content' => $c->content,
                'created_at' => $c->created_at->diffForHumans(),
            ];
        })
    ]);
}



}

