<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogTag;
use App\Http\Requests\BlogTagRequest;
use Illuminate\Support\Str;

use Yajra\DataTables\Facades\DataTables;

class BlogTagController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogTag::query();

        if ($search = $request->input('search')) {
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('slug', 'like', "%{$search}%");
        }

        $tags = $query->orderBy('id', 'desc')->paginate(10);
        $tags->appends($request->all());

        return view('admin.blog-tags.index', compact('tags', 'search'));
    }

    public function create()
    {
        return view('admin.blog-tags.form');
    }

    public function store(BlogTagRequest $request)
    {
        $data = $request->validated();
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        if ($request->hasFile('banner')) {
            $data['banner'] = $request->file('banner')->store('blog-tags/banners', 'public');
        }

        $data['author_id'] = auth()->id();

        BlogTag::create($data);

        return redirect()->route('admin.blog-tags.index')->with('success', 'Tag created successfully');
    }

    public function edit(BlogTag $blogtag)
    {
        return view('admin.blog-tags.form', compact('blogtag'));
    }

    public function update(BlogTagRequest $request, BlogTag $blogtag)
    {
        $data = $request->validated();
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        if ($request->hasFile('banner')) {
            $data['banner'] = $request->file('banner')->store('blog-tags/banners', 'public');
        }

        $blogtag->update($data);

        return redirect()->route('admin.blog-tags.index')->with('success', 'Tag updated successfully');
    }

    public function destroy(BlogTag $blogtag)
    {
        $blogtag->delete();
        return redirect()->route('admin.blog-tags.index')->with('success', 'Tag deleted successfully');
    }
}
