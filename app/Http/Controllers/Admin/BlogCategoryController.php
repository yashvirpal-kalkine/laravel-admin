<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Http\Requests\BlogCategoryRequest;
use Illuminate\Support\Str;

use Yajra\DataTables\Facades\DataTables;

class BlogCategoryController extends Controller
{
    public function index(Request $request)
    {
        // If AJAX → return JSON for DataTables
        if ($request->ajax()) {
            $query = BlogCategory::with('author'); // assuming 'author' relation exists

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('status', function ($category) {
                    return status_badge($category->status);
                })
                ->addColumn('author', function ($category) {
                    return $category->author->name ?? '-';
                })
                ->addColumn('actions', function ($category) {
                    $edit = route('admin.blog-categories.edit', $category->id);
                    $delete = route('admin.blog-categories.destroy', $category->id);

                    return '
                        <a href="' . $edit . '" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil text-white"></i>
                        </a>
                        <form action="' . $delete . '" method="POST" style="display:inline;" onsubmit="return confirm(\'Delete this category?\')">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button class="btn btn-danger btn-sm">
                                <i class="bi bi-trash text-white"></i>
                            </button>
                        </form>
                    ';
                })
                ->rawColumns(['status', 'actions']) // allow HTML
                ->make(true);
        }

        return view('admin.blog-categories.index');
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
