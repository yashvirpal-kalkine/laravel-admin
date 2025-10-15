<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Http\Requests\BlogPostRequest;
use Illuminate\Support\Str;

class BlogPostController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogPost::query()->with(['author', 'categories', 'tags']);

        if ($search = $request->input('search')) {
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('slug', 'like', "%{$search}%");
        }

        $posts = $query->orderBy('id', 'desc')->paginate(10);
        $posts->appends($request->all());

        return view('admin.blog-posts.index', compact('posts', 'search'));
    }

    public function create()
    {
        $categories = BlogCategory::all();
        $tags = BlogTag::all();
        return view('admin.blog-posts.form', compact('categories', 'tags'));
    }

    public function store(BlogPostRequest $request)
    {
        $data = $request->validated();

        if (empty($data['slug']))
            $data['slug'] = Str::slug($data['title']);
        if ($request->hasFile('banner'))
            $data['banner'] = $request->file('banner')->store('blog-posts/banners', 'public');
        $data['author_id'] = auth()->id();

        $post = BlogPost::create($data);

        // Sync pivot tables
        $post->categories()->sync($data['categories'] ?? []);
        $post->tags()->sync($data['tags'] ?? []);

        return redirect()->route('admin.blog-posts.index')->with('success', 'Post created successfully');
    }

    public function edit(BlogPost $blogpost)
    {
        $categories = BlogCategory::all();
        $tags = BlogTag::all();
        return view('admin.blog-posts.form', compact('blogpost', 'categories', 'tags'));
    }

    public function update(BlogPostRequest $request, BlogPost $blogpost)
    {
        $data = $request->validated();

        if (empty($data['slug']))
            $data['slug'] = Str::slug($data['title']);
        if ($request->hasFile('banner'))
            $data['banner'] = $request->file('banner')->store('blog-posts/banners', 'public');

        $blogpost->update($data);

        // Sync pivot tables
        $blogpost->categories()->sync($data['categories'] ?? []);
        $blogpost->tags()->sync($data['tags'] ?? []);

        return redirect()->route('admin.blog-posts.index')->with('success', 'Post updated successfully');
    }

    public function destroy(BlogPost $blogpost)
    {
        $blogpost->delete();
        return redirect()->route('admin.blog-posts.index')->with('success', 'Post deleted successfully');
    }
}
