<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogTag;
use App\Http\Requests\BlogTagRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use App\Services\ImageUploadService;

class BlogTagController extends Controller
{
    protected $imageService;

    public function __construct(ImageUploadService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $tags = BlogTag::with('author')->select('blog_tags.*');

            return DataTables::of($tags)
                ->addIndexColumn()
                ->addColumn('status', fn($tag) => status_badge($tag->status))
                //->addColumn('author', fn($tag) => $tag->author?->name ?? '-')
                ->addColumn('actions', function ($tag) {
                    $editUrl = route('admin.blog-tags.edit', $tag->id);
                    $deleteUrl = route('admin.blog-tags.destroy', $tag->id);

                    return '
                        <a href="' . $editUrl . '" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil text-white"></i>
                        </a>
                        <form action="' . $deleteUrl . '" method="POST" class="d-inline" onsubmit="return confirm(\'Delete this tag?\')">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button class="btn btn-danger btn-sm"><i class="bi bi-trash text-white"></i></button>
                        </form>
                    ';
                })
                ->rawColumns(['status', 'actions'])
                ->make(true);
        }

        return view('admin.blog-tags.index');
    }

    public function create()
    {
        $blogtag = new BlogTag();
        return view('admin.blog-tags.form', compact('blogtag'));
    }

    public function store(BlogTagRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();

            // Generate slug if not provided
            if (empty($data['slug'])) {
                $data['slug'] = Str::slug($data['title']);
            }

            // Handle image upload
            if ($request->hasFile('banner')) {
                $images = $this->imageService->upload($request->file('banner'), 'banner');
                $data['banner'] = $images['name'];
            }
            $data['author_id'] = auth()->id();
            BlogTag::create($data);
            DB::commit();
            return redirect()->route('admin.blog-tags.index')->with('success', 'Tag created successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            //Log::error('BlogTag Store Error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect()->back()->withInput()->with('error', 'Failed to create tag. Please try again.');
        }
    }

    public function edit(BlogTag $blog_tag)
    {
        $blogtag = $blog_tag;
        return view('admin.blog-tags.form', compact('blogtag'));
    }

    public function update(BlogTagRequest $request, BlogTag $blog_tag)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();

            if (empty($data['slug'])) {
                $data['slug'] = Str::slug($data['title']);
            }

            if ($request->hasFile('banner')) {
                // Delete old banner
                if (!empty($blogtag->banner)) {
                    $this->imageService->delete($blog_tag->banner, 'banner');
                }
                // Upload new banner
                $images = $this->imageService->upload($request->file('banner'), 'banner');
                $data['banner'] = $images['name'];
            }

            $blog_tag->update($data);

            DB::commit();

            return redirect()->route('admin.blog-tags.index')->with('success', 'Tag updated successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            // Log::error('BlogTag Update Error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect()->back()->withInput()->with('error', 'Failed to update tag. Please try again.');
        }
    }

    public function destroy(BlogTag $blog_tag)
    {
        DB::beginTransaction();

        try {
            if (!empty($blog_tag->banner)) {
                $this->imageService->delete($blog_tag->banner, 'banner');
            }

            $blog_tag->delete();

            DB::commit();
            return redirect()->route('admin.blog-tags.index')->with('success', 'Tag deleted successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            // Log::error('BlogTag Delete Error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect()->route('admin.blog-tags.index')->with('error', 'Failed to delete tag. Please try again.');
        }
    }
}
