<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Http\Requests\PageRequest;
use Illuminate\Support\Str;

use Yajra\DataTables\Facades\DataTables;
use App\Services\ImageUploadService;
class PageController extends Controller
{
    protected $imageService;

    public function __construct(ImageUploadService $imageService)
    {
        $this->imageService = $imageService;
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Page::query()->with('author');

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('status', function ($page) {
                    return status_badge($page->status);
                })
                // ->addColumn('published_at', function ($page) {
                //     return $page->published_at ? $page->published_at->format('Y-m-d H:i') : '-';
                // })
                ->addColumn('actions', function ($page) {
                    $edit = route('admin.pages.edit', $page->id);
                    $delete = route('admin.pages.destroy', $page->id);
                    return '
                    <a href="' . $edit . '" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil text-white"></i>
                    </a>
                    <form action="' . $delete . '" method="POST" style="display:inline;" onsubmit="return confirm(\'Delete this page?\')">
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

        return view('admin.pages.index');
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
            $images = $this->imageService->upload($request->file('banner'), 'banner');
            $data['banner'] = $images['name'];
        }

        // Handle SEO image upload
        // if ($request->hasFile('seo_image')) {
        //     $data['seo_image'] = $request->file('seo_image')->store('pages/seo_images', 'public');
        // }

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
            $images = $this->imageService->upload($request->file('banner'), 'banner');
            $data['banner'] = $images['name'];
        }

        if ($request->hasFile('seo_image')) {
            $data['seo_image'] = $request->file('seo_image')->store('pages/seo_images', 'public');
        }

        $page->update($data);

        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully');
    }

    public function destroy(Page $page)
    {
        if (!empty($page->banner)) {
            $this->imageService->delete($page->banner, 'banner');
        }
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully');
    }
}
