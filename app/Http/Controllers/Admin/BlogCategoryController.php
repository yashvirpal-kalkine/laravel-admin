<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Http\Requests\BlogCategoryRequest;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogCategory::query();

        if ($search = $request->input('search')) {
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%");
        }

        $categories = $query->orderBy('id', 'desc')->paginate(10);
        $categories->appends($request->all());

        return view('admin.blog-categories.index', compact('categories', 'search'));
    }

    public function create()
    {
        return view('admin.blog-categories.form');
    }

    public function store(BlogCategoryRequest $request)
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        if ($request->hasFile('banner')) {
            $data['banner'] = $request->file('banner')->store('blog-categories/banners', 'public');
        }

        $data['author_id'] = auth()->id();

        BlogCategory::create($data);

        return redirect()->route('admin.blog-categories.index')->with('success', 'Category created successfully');
    }

    public function edit(BlogCategory $blogcategory)
    {
        return view('admin.blog-categories.form', compact('blogcategory'));
    }

    public function update(BlogCategoryRequest $request, BlogCategory $blogcategory)
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        if ($request->hasFile('banner')) {
            $data['banner'] = $request->file('banner')->store('blog-categories/banners', 'public');
        }

        $blogcategory->update($data);

        return redirect()->route('admin.blog-categories.index')->with('success', 'Category updated successfully');
    }

    public function destroy(BlogCategory $blogcategory)
    {
        $blogcategory->delete();
        return redirect()->route('admin.blog-categories.index')->with('success', 'Category deleted successfully');
    }
}
