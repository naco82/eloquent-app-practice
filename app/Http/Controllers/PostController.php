<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:200',
            'content' => 'required',
        ]);
        Post::create([
            'user_id' => auth()->id() ?? 1, // 仮のユーザーIDを設定（実際には認証ユーザーのIDを使用することが望ましい）
            'title' => $validated['title'],
            'content' => $validated['content'],
            'published_at' => now(),
        ]);
        return redirect()->route('posts.index');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'published_at' => $request->input('published_at'),
        ]);
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('posts.index');
    }
}
