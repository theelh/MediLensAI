<?php
// app/Http/Controllers/AdminController.php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\File;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Models\Comments;

class AdminController extends Controller
{
    public function index() {
        $stats = [
            'users' => User::count(),
            'files' => File::count(),
            'posts' => Post::count(),
        ];

   $systemHealth = [
        'storage' => [
            'total' => disk_total_space(storage_path()),
            'free' => disk_free_space(storage_path()),
            'used' => disk_total_space(storage_path()) - disk_free_space(storage_path()),
        ],
        'memory' => [
            'usage' => memory_get_usage(true),
            'peak' => memory_get_peak_usage(true),
        ],
        'php' => [
            'version' => PHP_VERSION,
        ],
    ];
        return view('admin.dashboard', compact('stats', 'systemHealth'));
    }

    public function comtdestroy($id): RedirectResponse
    {
        $comment = Comments::findOrFail($id);
        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }
    public function comtpostdestroy($id): RedirectResponse
    {
        $comment = Post::findOrFail($id);
        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }

    public function systemHealth() {
        $health = [
            'storage' => [
                'total' => disk_total_space(storage_path()),
                'free' => disk_free_space(storage_path()),
            ],
            'memory' => [
                'usage' => memory_get_usage(true),
                'peak' => memory_get_peak_usage(true),
            ],
            'database' => [
                'size' => \DB::selectOne('SELECT SUM(data_length + index_length) as size FROM information_schema.TABLES WHERE table_schema = ?', [config('database.connections.mysql.database')])->size ?? 0,
            ],
            'php' => [
                'version' => PHP_VERSION,
                'max_execution_time' => ini_get('max_execution_time'),
                'memory_limit' => ini_get('memory_limit'),
            ],
            'laravel' => [
                'version' => app()->version(),
                'env' => app()->environment(),
            ]
        ];
        return view('admin.system.health', compact('health'));
    }


    public function userIndex() {
        $users = User::paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user) {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'is_admin' => 'sometimes|boolean',
        ]);
        if($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        $user->update($data);
        return redirect()->route('users.index')->with('success','User updated');
    }

    public function destroy(User $user) {
        $user->delete();
        return back()->with('success','User deleted');
    }

    public function fileIndex() {
        $files = File::with('user')->paginate(20);
        return view('admin.files.index', compact('files'));
    }

    public function show(File $file) {
        $file->load(['user', 'comments.user', 'insights']);
        return view('admin.files.show', compact('file'));
    }

    public function fileDestroy(File $file) {
        $file->delete();
        return back()->with('success','File deleted');
    }

    public function postIndex() {
        $posts = Post::with('user')->paginate(20);
        return view('admin.posts.index', compact('posts'));
    }

    public function postShow(Post $post) {
        $post->load('files','media','comments','likes');
        return view('admin.posts.show', compact('post'));
    }

    public function postDestroy(Post $post) {
        $post->delete();
        return back()->with('success','Post deleted');
    }

}