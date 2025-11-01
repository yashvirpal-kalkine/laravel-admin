<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Calculator;
use App\Http\Requests\CalculatorRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use App\Services\ImageUploadService;

class CalculatorController extends Controller
{
    protected $imageService;

    public function __construct(ImageUploadService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Calculator::with('author');

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('status', fn($item) => status_badge($item->status))
                //->addColumn('author', fn($item) => $item->author->name ?? '-')
                ->addColumn('actions', function ($item) {
                    $edit = route('admin.calculators.edit', $item->id);
                    $delete = route('admin.calculators.destroy', $item->id);
                    return '
                        <a href="' . $edit . '" class="btn btn-warning btn-sm"><i class="bi bi-pencil text-white"></i></a>
                        <form action="' . $delete . '" method="POST" style="display:inline;" onsubmit="return confirm(\'Delete this item?\')">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button class="btn btn-danger btn-sm"><i class="bi bi-trash text-white"></i></button>
                        </form>
                    ';
                })
                ->rawColumns(['status', 'actions'])
                ->make(true);
        }

        return view('admin.calculators.index');
    }

    public function create()
    {
        $calculator = new Calculator();
        return view('admin.calculators.form', compact('calculator'));
    }

    public function store(CalculatorRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();

            if (empty($data['slug'])) {
                $data['slug'] = Str::slug($data['title']);
            }

            if ($request->hasFile('banner')) {
                $banner = $this->imageService->upload($request->file('banner'), 'banner');
                $data['banner'] = $banner['name'];
            }

            if ($request->hasFile('image')) {
                $image = $this->imageService->upload($request->file('image'), 'calculator');
                $data['image'] = $image['name'];
            }

            if ($request->hasFile('seo_image')) {
                $seo = $this->imageService->upload($request->file('seo_image'), 'seo');
                $data['seo_image'] = $seo['name'];
            }

            // JSON encode FAQs
            $data['faqs'] = $request->input('faqs', []);

            $data['author_id'] = auth()->id();
            Calculator::create($data);

            DB::commit();
            return redirect()->route('admin.calculators.index')->with('success', ' Calculator created successfully');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function edit(Calculator $calculator)
    {
        // dd($calculator);
        return view('admin.calculators.form', compact('calculator'));
    }

    public function update(CalculatorRequest $request, Calculator $calculator)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();

            if (empty($data['slug'])) {
                $data['slug'] = Str::slug($data['title']);
            }

            if ($request->hasFile('banner')) {
                $this->imageService->delete($calculator->banner, 'banner');
                $banner = $this->imageService->upload($request->file('banner'), 'banner');
                $data['banner'] = $banner['name'];
            }

            if ($request->hasFile('image')) {
                $this->imageService->delete($calculator->image, 'calculator');
                $image = $this->imageService->upload($request->file('image'), 'calculator');
                $data['image'] = $image['name'];
            }

            if ($request->hasFile('seo_image')) {
                $this->imageService->delete($calculator->seo_image, 'seo');
                $seo = $this->imageService->upload($request->file('seo_image'), 'seo');
                $data['seo_image'] = $seo['name'];
            }

            $data['faqs'] = $request->input('faqs', []);


            $calculator->update($data);

            DB::commit();
            return redirect()->route('admin.calculators.index')->with('success', ' Calculator updated successfully');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function destroy(Calculator $calculator)
    {
        DB::beginTransaction();
        try {
            if ($calculator->banner) {
                $this->imageService->delete($calculator->banner, 'banner');
            }
            if ($calculator->image) {
                $this->imageService->delete($calculator->image, 'calculator');
            }
            if ($calculator->seo_image) {
                $this->imageService->delete($calculator->seo_image, 'seo');
            }

            $calculator->delete();

            DB::commit();
            return redirect()->route('admin.calculators.index')->with('success', ' Calculator deleted successfully');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
