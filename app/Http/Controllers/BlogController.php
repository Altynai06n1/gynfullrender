<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::latest()->get();
        return view('blog.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = BlogPost::where('slug', $slug)->firstOrFail();
        return view('blog.show', compact('post'));
    }

    public function create()
    {
        return view('blog.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string|max:100',
        ]);

        BlogPost::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . uniqid(),
            'content' => $request->content,
            'category' => $request->category,
        ]);

        return redirect()->route('blog.index')
            ->with('success', __('messages.blog.created'));
    }

    public function edit($id)
    {
        $post = BlogPost::findOrFail($id);
        return view('blog.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string|max:100',
        ]);

        $post = BlogPost::findOrFail($id);
        $post->update($request->only(['title', 'content', 'category']));

        return redirect()->route('blog.index')
            ->with('success', __('messages.blog.updated'));
    }

    public function destroy($id)
    {
        $post = BlogPost::findOrFail($id);
        $post->delete();

        return redirect()->route('blog.index')
            ->with('success', __('messages.blog.deleted'));
    }
}
