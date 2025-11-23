<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Http\Requests\SliderRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Services\ImageUploadService;

class SliderController extends Controller
{
    protected $imageService;

    public function __construct(ImageUploadService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Display list (DataTable)
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Slider::query();

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('image', function ($slider) {
                    return $slider->image_url
                        ? '<img src="' . $slider->image_url . '" height="50">'
                        : '-';
                })
                ->addColumn('status', fn($s) => status_badge($s->status))
                ->addColumn('actions', function ($slider) {
                    $edit = route('admin.sliders.edit', $slider->id);
                    $delete = route('admin.sliders.destroy', $slider->id);

                    return '
                        <a href="' . $edit . '" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil text-white"></i>
                        </a>
                        <form action="' . $delete . '" 
                              method="POST" 
                              style="display:inline;" 
                              onsubmit="return confirm(\'Delete this slider?\')">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button class="btn btn-danger btn-sm">
                                <i class="bi bi-trash text-white"></i>
                            </button>
                        </form>
                    ';
                })
                ->rawColumns(['image', 'status', 'actions'])
                ->make(true);
        }

        return view('admin.sliders.index');
    }

    /**
     * Show create form
     */
    public function create()
    {
        $slider = new Slider();
        return view('admin.sliders.form', compact('slider'));
    }

    /**
     * Store new slider
     */
    public function store(SliderRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();

            // Upload image
            if ($request->hasFile('image')) {
                $file = $this->imageService->upload($request->file('image'), 'slider');
                $data['image'] = $file['name'];
            }

            Slider::create($data);

            DB::commit();
            return redirect()->route('admin.sliders.index')->with('success', 'Slider created successfully');

        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    /**
     * Edit form
     */
    public function edit(Slider $slider)
    {
        return view('admin.sliders.form', compact('slider'));
    }

    /**
     * Update slider
     */
    public function update(SliderRequest $request, Slider $slider)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();

            // If new image uploaded
            if ($request->hasFile('image')) {
                $this->imageService->delete($slider->image, 'slider');

                $file = $this->imageService->upload($request->file('image'), 'slider');
                $data['image'] = $file['name'];
            }

            $slider->update($data);

            DB::commit();
            return redirect()->route('admin.sliders.index')->with('success', 'Slider updated successfully');

        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    /**
     * Delete slider
     */
    public function destroy(Slider $slider)
    {
        DB::beginTransaction();

        try {
            if (!empty($slider->image)) {
                $this->imageService->delete($slider->image, 'slider');
            }

            $slider->delete();

            DB::commit();
            return redirect()->route('admin.sliders.index')->with('success', 'Slider deleted successfully');

        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
