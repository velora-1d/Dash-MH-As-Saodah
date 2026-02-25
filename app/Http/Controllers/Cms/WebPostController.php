<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\WebPost;
use Illuminate\Http\Request;

class WebPostController extends Controller
{
    public function index()
    {
        $posts = WebPost::orderByDesc('created_at')->paginate(15);
        return view('cms.posts.index', compact('posts'));
    }

    public function create() { return view('cms.posts.create'); }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'thumbnail' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:5120',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        $data = $request->only(['title', 'content', 'excerpt', 'meta_title', 'meta_description']);
        $data['is_published'] = $request->boolean('is_published');
        $data['published_at'] = $request->boolean('is_published') ? now() : null;
        $data['author_id'] = auth()->id();

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail_url'] = $request->file('thumbnail')->store('web-posts', 'public');
        }

        WebPost::create($data);
        return redirect()->route('cms.posts.index')->with('success', 'Artikel berhasil dipublikasikan.');
    }

    public function edit(WebPost $post) { return view('cms.posts.edit', compact('post')); }

    public function update(Request $request, WebPost $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'thumbnail' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:5120',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        $data = $request->only(['title', 'content', 'excerpt', 'meta_title', 'meta_description']);
        $data['is_published'] = $request->boolean('is_published');

        if (!$post->published_at && $request->boolean('is_published')) {
            $data['published_at'] = now();
        }

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail_url'] = $request->file('thumbnail')->store('web-posts', 'public');
        }

        $post->update($data);
        return redirect()->route('cms.posts.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(WebPost $post)
    {
        $post->delete();
        return redirect()->route('cms.posts.index')->with('success', 'Artikel berhasil dihapus.');
    }
}
