<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogCategoryRequest;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use App\Services\ImageUploadService;

class BlogCategoryController extends Controller
{
    protected $imageService;

    public function __construct(ImageUploadService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = BlogCategory::with('author');

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('parent', fn($cat) => $cat->parent?->title ?? '-')
                ->addColumn('status', fn($cat) => status_badge($cat->status))
               // ->addColumn('author', fn($cat) => $cat->author->name ?? '-')
                ->addColumn('actions', function ($category) {
                    $edit = route('admin.blog-categories.edit', $category->id);
                    $delete = route('admin.blog-categories.destroy', $category->id);

                    return '
                        <a href="' . $edit . '" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil text-white"></i>
                        </a>
                        <form action="' . $delete . '" method="POST" style="display:inline;" 
                              onsubmit="return confirm(\'Delete this category?\')">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button class="btn btn-danger btn-sm">
                                <i class="bi bi-trash text-white"></i>
                            </button>
                        </form>
                    ';
                })
                ->rawColumns(['status', 'actions'])
                ->make(true);
        }

        return view('admin.blog-categories.index');
    }

    public function create()
    {
        $parents = BlogCategory::where('status', 1)
            ->orderBy('title')
            ->get();

        return view('admin.blog-categories.form', compact('parents'));
    }

    public function store(BlogCategoryRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();

            // Auto slug
            if (empty($data['slug'])) {
                $data['slug'] = BlogCategory::generateSlug($data['title']);
            }

            // Upload Banner
            if ($request->hasFile('banner')) {
                $images = $this->imageService->upload($request->file('banner'), 'banner');
                $data['banner'] = $images['name'];
            }

            // Upload Main Image
            if ($request->hasFile('image')) {
                $images = $this->imageService->upload($request->file('image'), 'blogcategory');
                $data['image'] = $images['name'];
            }

            // Upload SEO Image
            if ($request->hasFile('seo_image')) {
                $images = $this->imageService->upload($request->file('seo_image'), 'seo');
                $data['seo_image'] = $images['name'];
            }

            $data['author_id'] = auth()->id();

            BlogCategory::create($data);

            DB::commit();
            return redirect()->route('admin.blog-categories.index')
                ->with('success', 'Category created successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

        public function edit(BlogCategory $blog_category)
        {
            // Load children for recursion to work
            $blog_category->load('children');

            // Exclude current category + all descendants
            $excludeIds = $blog_category->getDescendantIds();
            $excludeIds[] = $blog_category->id;

            $parents = BlogCategory::where('status', 1)
                ->whereNotIn('id', $excludeIds)
                ->orderBy('title')
                ->get();
            $blogcategory=    $blog_category;

            return view('admin.blog-categories.form', compact('blogcategory', 'parents'));
        }

    public function update(BlogCategoryRequest $request, BlogCategory $blog_category)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();

            if (empty($data['slug'])) {
                $data['slug'] = BlogCategory::generateSlug($data['title']);
            }

            // Banner Update
            if ($request->hasFile('banner')) {
                $this->imageService->delete($blog_category->banner, 'banner');
                $images = $this->imageService->upload($request->file('banner'), 'banner');
                $data['banner'] = $images['name'];
            }

            // Main Image
            if ($request->hasFile('image')) {
                $this->imageService->delete($blog_category->image, 'blogcategory');
                $images = $this->imageService->upload($request->file('image'), 'blogcategory');
                $data['image'] = $images['name'];
            }

            // SEO Image
            if ($request->hasFile('seo_image')) {
                $this->imageService->delete($blog_category->seo_image, 'seo');
                $images = $this->imageService->upload($request->file('seo_image'), 'seo');
                $data['seo_image'] = $images['name'];
            }

            $blog_category->update($data);

            DB::commit();
            return redirect()->route('admin.blog-categories.index')
                ->with('success', 'Category updated successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function destroy(BlogCategory $blogcategory)
    {
        DB::beginTransaction();

        try {
            $this->imageService->delete($blogcategory->banner, 'banner');
            $this->imageService->delete($blogcategory->image, 'category');
            $this->imageService->delete($blogcategory->seo_image, 'seo');

            $blogcategory->delete();

            DB::commit();
            return redirect()->route('admin.blog-categories.index')
                ->with('success', 'Category deleted successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
