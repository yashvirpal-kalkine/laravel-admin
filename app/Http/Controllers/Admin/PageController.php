<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Http\Requests\PageRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
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
            $query = Page::with('author');

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('status', fn($page) => status_badge($page->status))
                ->addColumn('actions', function ($page) {
                    $edit = route('admin.pages.edit', $page->id);
                    $delete = route('admin.pages.destroy', $page->id);

                    return '
                        <a href="' . $edit . '" class="btn btn-warning btn-sm"><i class="bi bi-pencil text-white"></i></a>
                        <form action="' . $delete . '" method="POST" style="display:inline;" onsubmit="return confirm(\'Delete this page?\')">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button class="btn btn-danger btn-sm"><i class="bi bi-trash text-white"></i></button>
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
        $page = new Page();
        $parents = Page::active()
            ->whereNull('parent_id')
            ->with('children')
            ->orderBy('title')
            ->get();
        return view('admin.pages.form', compact('page', 'parents'));
    }


    public function store(PageRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();

            if (empty($data['slug'])) {
                $data['slug'] = Str::slug($data['title']);
            }
            $data['template'] = $data['template'] ?? 'default';


            if ($request->hasFile('banner')) {
                $images = $this->imageService->upload($request->file('banner'), 'banner');
                $data['banner'] = $images['name'];
            }

            // if ($request->hasFile('seo_image')) {
            //     $data['seo_image'] = $request->file('seo_image')->store('pages/seo_images', 'public');
            // }

            $data['author_id'] = auth()->id();

            Page::create($data);

            DB::commit();
            return redirect()->route('admin.pages.index')->with('success', 'Page created successfully');

        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function edit(Page $page)
    {
        $excludeIds = collect($page->getDescendantIds())
            ->push($page->id)
            ->all();

        $parents = Page::active()
            ->whereNull('parent_id')
            ->whereNotIn('id', $excludeIds)
            ->with([
                'children' => function ($query) use ($excludeIds) {
                    $query->whereNotIn('id', $excludeIds)
                        ->with([
                            'children' => function ($subQuery) use ($excludeIds) {
                                $subQuery->whereNotIn('id', $excludeIds)
                                    ->with('children');
                            }
                        ]);
                }
            ])
            ->orderBy('title')
            ->get();
        return view('admin.pages.form', compact('page', 'parents'));
    }




    public function update(PageRequest $request, Page $page)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();

            if (empty($data['slug'])) {
                $data['slug'] = Str::slug($data['title']);
            }
            $data['template'] = $data['template'] ?? 'default';

            if ($request->hasFile('banner')) {
                $this->imageService->delete($page->banner, 'banner');
                $images = $this->imageService->upload($request->file('banner'), 'banner');
                $data['banner'] = $images['name'];
            }
            if ($request->hasFile('seo_image')) {
                $this->imageService->delete($page->seo_image, 'seo_image');
                $images = $this->imageService->upload($request->file('seo_image'), 'seo_image');
                $data['seo_image'] = $images['name'];
            }

            $page->update($data);

            DB::commit();
            return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully');

        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function destroy(Page $page)
    {
        DB::beginTransaction();

        try {
            if (!empty($page->banner)) {
                $this->imageService->delete($page->banner, 'banner');
            }

            $page->delete();

            DB::commit();
            return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully');

        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
