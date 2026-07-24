<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->get();
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string', // raw HTML
            'image_path' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
        ]);

        $blog = Blog::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'content' => $validated['content'],
            'image_path' => $validated['image_path'] ?? null,
        ]);

        $blog->seoMeta()->create([
            'meta_title' => $validated['meta_title'] ?? $blog->title,
            'meta_description' => $validated['meta_description'] ?? Str::limit(strip_tags((string)$blog->content), 160),
            'meta_keywords' => $validated['meta_keywords'] ?? null,
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog created.');
    }

    public function edit(Blog $blog)
    {
        $blog->load('seoMeta');
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'image_path' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
        ]);

        $blog->update([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']), // normally you wouldn't change slug, but for simplicity
            'content' => $validated['content'],
            'image_path' => $validated['image_path'] ?? null,
        ]);

        $blog->seoMeta()->updateOrCreate(
            ['seoable_id' => $blog->id, 'seoable_type' => Blog::class],
            [
                'meta_title' => $validated['meta_title'] ?? $blog->title,
                'meta_description' => $validated['meta_description'] ?? Str::limit(strip_tags((string)$blog->content), 160),
                'meta_keywords' => $validated['meta_keywords'] ?? null,
            ]
        );

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated.');
    }

    public function destroy(Blog $blog)
    {
        $blog->seoMeta()->delete();
        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted.');
    }
}
