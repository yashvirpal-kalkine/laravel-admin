<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogTag;
use App\Http\Requests\BlogTagRequest;
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
                ->addColumn('status', function ($tag) {
                    return status_badge($tag->status);
                })
                ->addColumn('author', function ($tag) {
                    return $tag->author?->name ?? '-';
                })
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
        return view('admin.blog-tags.form');
    }

    public function store(BlogTagRequest $request)
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
            $images = $this->imageService->upload($request->file('banner'), 'banner');
            $data['banner'] = $images['name'];
        }

        $blogtag->update($data);

        return redirect()->route('admin.blog-tags.index')->with('success', 'Tag updated successfully');
    }

    public function destroy(BlogTag $blogtag)
    {
        if (!empty($blogtag->banner)) {
            $this->imageService->delete($blogtag->banner, 'banner');
        }
        $blogtag->delete();
        return redirect()->route('admin.blog-tags.index')->with('success', 'Tag deleted successfully');
    }
}
