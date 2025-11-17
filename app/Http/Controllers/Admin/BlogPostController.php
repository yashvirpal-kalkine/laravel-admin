<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Http\Requests\BlogPostRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use App\Services\ImageUploadService;

class BlogPostController extends Controller
{
    protected $imageService;

    public function __construct(ImageUploadService $imageService)
    {
        $this->imageService = $imageService;
    }

    // ----------------------------------------------------------------
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $posts = BlogPost::with(['categories', 'tags', 'author'])->select('blog_posts.*');

            return DataTables::of($posts)
                ->addIndexColumn()
                ->addColumn(
                    'categories',
                    fn($post) =>
                    $post->categories->pluck('title')->map(
                        fn($c) =>
                        "<span class='badge bg-info text-dark me-1'>$c</span>"
                    )->implode(' ')
                )
                ->addColumn(
                    'tags',
                    fn($post) =>
                    $post->tags->pluck('title')->map(
                        fn($t) =>
                        "<span class='badge bg-secondary me-1'>$t</span>"
                    )->implode(' ')
                )
                ->addColumn(
                    'featured',
                    fn($post) =>
                    $post->is_featured ? "<span class='badge bg-success'>Yes</span>" : "<span class='badge bg-secondary'>No</span>"
                )
                ->addColumn('status', fn($post) => status_badge($post->status))
                ->addColumn('actions', function ($post) {
                    $editUrl = route('admin.blog-posts.edit', $post->id);
                    $deleteUrl = route('admin.blog-posts.destroy', $post->id);

                    return '
                        <a href="' . $editUrl . '" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil text-white"></i>
                        </a>
                        <form action="' . $deleteUrl . '" method="POST" class="d-inline" onsubmit="return confirm(\'Delete this post?\')">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button class="btn btn-danger btn-sm">
                                <i class="bi bi-trash text-white"></i>
                            </button>
                        </form>
                    ';
                })
                ->rawColumns(['categories', 'tags', 'featured', 'status', 'actions'])
                ->make(true);
        }

        return view('admin.blog-posts.index');
    }

    // ----------------------------------------------------------------
    public function create()
    {
        $categories = BlogCategory::where('status', 1)
            ->whereNull('parent_id') // start from root
            ->with([
                'children' => function ($query) {
                    $query->where('status', 1)
                        ->with([
                            'children' => function ($query) {
                                $query->where('status', 1)
                                    ->with('children'); // recursive depth
                            }
                        ]);
                }
            ])
            ->orderBy('title')
            ->get();
        $tags = BlogTag::active()->get();

        $blogpost = new BlogPost();
        return view('admin.blog-posts.form', compact('categories', 'tags', 'blogpost'));
    }

    // ----------------------------------------------------------------
    public function store(BlogPostRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();

            // Generate slug if not provided
            $data['slug'] = $data['slug'] ?? Str::slug($data['title']);
            $data['author_id'] = auth()->id();

            // Handle images
            if ($request->hasFile('banner')) {
                $banner = $this->imageService->upload($request->file('banner'), 'banner');
                $data['banner'] = $banner['name'];
            }

            if ($request->hasFile('image')) {
                $image = $this->imageService->upload($request->file('image'), 'blogpost');
                $data['image'] = $image['name'];
            }

            if ($request->hasFile('seo_image')) {
                $seo = $this->imageService->upload($request->file('seo_image'), 'seo');
                $data['seo_image'] = $seo['name'];
            }

            $post = BlogPost::create($data);

            // Sync relationships
            $post->categories()->sync($data['categories'] ?? []);
            $post->tags()->sync($data['tags'] ?? []);

            DB::commit();
            return redirect()->route('admin.blog-posts.index')->with('success', 'Post created successfully');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('BlogPost create failed: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return back()->with('error', 'Failed to create post. Please try again.')->withInput();
        }
    }

    // ----------------------------------------------------------------
    public function edit(BlogPost $blog_post)
    {
        $categories = BlogCategory::where('status', 1)
            ->whereNull('parent_id') // start from root
            ->with([
                'children' => function ($query) {
                    $query->where('status', 1)
                        ->with([
                            'children' => function ($query) {
                                $query->where('status', 1)
                                    ->with('children'); // recursive depth
                            }
                        ]);
                }
            ])
            ->orderBy('title')
            ->get();
        $tags = BlogTag::active()->get();
        $blogpost = $blog_post;

        return view('admin.blog-posts.form', compact('blogpost', 'categories', 'tags'));
    }

    // ----------------------------------------------------------------
    public function update(BlogPostRequest $request, BlogPost $blog_post)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            $data['slug'] = $data['slug'] ?? Str::slug($data['title']);

            // Handle images
            if ($request->hasFile('banner')) {
                $this->imageService->delete($blog_post->banner, 'banner');
                $banner = $this->imageService->upload($request->file('banner'), 'banner');
                $data['banner'] = $banner['name'];
            }

            if ($request->hasFile('image')) {
                $this->imageService->delete($blog_post->image, 'blogpost');
                $image = $this->imageService->upload($request->file('image'), 'blogpost');
                $data['image'] = $image['name'];
            }

            if ($request->hasFile('seo_image')) {
                $this->imageService->delete($blog_post->seo_image, 'seo');
                $seo = $this->imageService->upload($request->file('seo_image'), 'seo');
                $data['seo_image'] = $seo['name'];
            }

            $blog_post->update($data);

            // Sync relationships
            $blog_post->categories()->sync($data['categories'] ?? []);
            $blog_post->tags()->sync($data['tags'] ?? []);

            DB::commit();
            return redirect()->route('admin.blog-posts.index')->with('success', 'Post updated successfully');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('BlogPost update failed: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return back()->with('error', 'Failed to update post. Please try again.')->withInput();
        }
    }

    // ----------------------------------------------------------------
    public function destroy(BlogPost $blog_post)
    {
        DB::beginTransaction();

        try {
            if (!empty($blog_post->banner)) {
                $this->imageService->delete($blog_post->banner, 'banner');
            }
            if (!empty($blog_post->image)) {
                $this->imageService->delete($blog_post->image, 'blogpost');
            }
            if (!empty($blog_post->seo_image)) {
                $this->imageService->delete($blog_post->seo_image, 'seo');
            }

            $blog_post->categories()->detach();
            $blog_post->tags()->detach();
            $blog_post->delete();

            DB::commit();
            return redirect()->route('admin.blog-posts.index')->with('success', 'Post deleted successfully');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('BlogPost delete failed: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return back()->with('error', 'Failed to delete post.');
        }
    }
}
