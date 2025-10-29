<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Http\Requests\BlogPostRequest;
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
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $posts = BlogPost::with(['categories', 'tags', 'author'])->select('blog_posts.*');

            return DataTables::of($posts)
                ->addIndexColumn()
                ->addColumn('categories', function ($post) {
                    return $post->categories->pluck('title')->map(fn($c) => "<span class='badge bg-info text-dark me-1'>$c</span>")->implode(' ');
                })
                ->addColumn('tags', function ($post) {
                    return $post->tags->pluck('title')->map(fn($t) => "<span class='badge bg-secondary me-1'>$t</span>")->implode(' ');
                })
                ->addColumn('status', function ($post) {
                    return status_badge($post->status);
                })
                // ->addColumn('published_at', function ($post) {
                //     return $post->published_at ? $post->published_at->format('d M Y, h:i A') : '-';
                // })
                // ->addColumn('author', function ($post) {
                //     return $post->author?->name ?? '-';
                // })
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
                ->rawColumns(['categories', 'tags', 'status', 'actions'])
                ->make(true);
        }

        return view('admin.blog-posts.index');
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

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }
        if ($request->hasFile('banner')) {
            $images = $this->imageService->upload($request->file('banner'), 'banner');
            $data['banner'] = $images['name'];
        }
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

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }
        if ($request->hasFile('banner')) {
            $images = $this->imageService->upload($request->file('banner'), 'banner');
            $data['banner'] = $images['name'];
        }
        $blogpost->update($data);

        // Sync pivot tables
        $blogpost->categories()->sync($data['categories'] ?? []);
        $blogpost->tags()->sync($data['tags'] ?? []);

        return redirect()->route('admin.blog-posts.index')->with('success', 'Post updated successfully');
    }

    public function destroy(BlogPost $blogpost)
    {
        if (!empty($blogpost->banner)) {
            $this->imageService->delete($blogpost->banner, 'banner');
        }
        $blogpost->delete();
        return redirect()->route('admin.blog-posts.index')->with('success', 'Post deleted successfully');
    }
}
