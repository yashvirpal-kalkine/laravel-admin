<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Http\Requests\PageRequest;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $query = Page::query();

        // Search by title or slug
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%");
            });
        }

        $pages = $query->orderBy('id', 'desc')->paginate(10);
        $pages->appends($request->all());

        return view('admin.pages.index', compact('pages', 'search'));
    }

    public function create()
    {
        return view('admin.pages.form');
    }

    public function store(PageRequest $request)
    {
        $data = $request->validated();

        // Auto-generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        // Handle banner upload
        if ($request->hasFile('banner')) {
            $data['banner'] = $request->file('banner')->store('pages/banners', 'public');
        }

        // Handle SEO image upload
        if ($request->hasFile('seo_image')) {
            $data['seo_image'] = $request->file('seo_image')->store('pages/seo_images', 'public');
        }

        $data['author_id'] = auth()->id(); // Assign current admin as author

        Page::create($data);

        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully');
    }

    public function edit(Page $page)
    {
        return view('admin.pages.form', compact('page'));
    }

    public function update(PageRequest $request, Page $page)
    {
        $data = $request->validated();

        // Auto-generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        if ($request->hasFile('banner')) {
            $data['banner'] = $request->file('banner')->store('pages/banners', 'public');
        }

        if ($request->hasFile('seo_image')) {
            $data['seo_image'] = $request->file('seo_image')->store('pages/seo_images', 'public');
        }

        $page->update($data);

        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully');
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully');
    }
}
