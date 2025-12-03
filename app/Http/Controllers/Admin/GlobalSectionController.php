<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GlobalSectionRequest;
use App\Models\GlobalSection;
use App\Models\Page;
use App\Services\ImageUploadService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class GlobalSectionController extends Controller
{
    protected $imageService;

    public function __construct(ImageUploadService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(GlobalSection::with('page'))
                ->addIndexColumn()
                ->addColumn('status', fn($row) => status_badge($row->status))
                ->addColumn('actions', function ($row) {
                    $edit = route('admin.global-sections.edit', $row->id);
                    $delete = route('admin.global-sections.destroy', $row->id);

                    return '
                <a href="' . $edit . '" class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil text-white"></i>
                </a>
                <form action="' . $delete . '" method="POST" 
                      style="display:inline;" onsubmit="return confirm(\'Delete this?\')">
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


        return view('admin.global_sections.index');
    }

    public function create()
    {
        $section = new GlobalSection();
        $pages = Page::active()->orderBy('title')->get();

        return view('admin.global_sections.form', compact('section', 'pages'));
    }

    public function store(GlobalSectionRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();

            if ($request->hasFile('image')) {
                $images = $this->imageService->upload($request->file('image'), 'global-sections');
                $data['image'] = $images['name'];
            }

            GlobalSection::create($data);

            DB::commit();

            return redirect()->route('admin.global-sections.index')->with('success', 'Global section created successfully.');

        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function edit(GlobalSection $global_section)
    {
        $pages = Page::active()->orderBy('title')->get();

        return view('admin.global_sections.form', [
            'section' => $global_section,
            'pages' => $pages
        ]);
    }

    public function update(GlobalSectionRequest $request, GlobalSection $global_section)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();

            if ($request->hasFile('image')) {
                $this->imageService->delete($global_section->image, 'global-sections');
                $images = $this->imageService->upload($request->file('image'), 'global-sections');
                $data['image'] = $images['name'];
            }

            $global_section->update($data);

            DB::commit();

            return redirect()->route('admin.global-sections.index')->with('success', 'Global section updated successfully.');

        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function destroy(GlobalSection $global_section)
    {
        DB::beginTransaction();

        try {
            if (!empty($global_section->image)) {
                $this->imageService->delete($global_section->image, 'global-sections');
            }

            $global_section->delete();

            DB::commit();

            return redirect()->route('admin.global-sections.index')->with('success', 'Global section deleted successfully.');

        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
