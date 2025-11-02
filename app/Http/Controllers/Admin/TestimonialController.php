<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestimonialRequest;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Services\ImageUploadService;
use Illuminate\Support\Facades\DB;

class TestimonialController extends Controller
{
    protected $imageService;

    public function __construct(ImageUploadService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Testimonial::query();

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('photo', fn($item) => $item->photo
                    ? '<img src="' . asset('storage/testimonials/' . $item->photo) . '" width="50">'
                    : '-')
                ->addColumn('status', fn($item) => status_badge($item->status))
                ->addColumn('actions', function ($item) {
                    $edit = route('admin.testimonials.edit', $item->id);
                    $delete = route('admin.testimonials.destroy', $item->id);
                    return '
                        <a href="' . $edit . '" class="btn btn-warning btn-sm"><i class="bi bi-pencil text-white"></i></a>
                        <form action="' . $delete . '" method="POST" style="display:inline;" onsubmit="return confirm(\'Delete this testimonial?\')">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button class="btn btn-danger btn-sm"><i class="bi bi-trash text-white"></i></button>
                        </form>
                    ';
                })
                ->rawColumns(['photo', 'status', 'actions'])
                ->make(true);
        }

        return view('admin.testimonials.index');
    }

    public function create()
    {
        $testimonial = new Testimonial();
        return view('admin.testimonials.form', compact('testimonial'));
    }

    public function store(TestimonialRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();

            if ($request->hasFile('image')) {
                $photo = $this->imageService->upload($request->file('image'), 'testimonial');
                $data['image'] = $photo['name'];
            }

            Testimonial::create($data);
            DB::commit();
            return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial created successfully.');

        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.form', compact('testimonial'));
    }

    public function update(TestimonialRequest $request, Testimonial $testimonial)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();

            if ($request->hasFile('image')) {
                $this->imageService->delete($testimonial->image, 'testimonial');
                $photo = $this->imageService->upload($request->file('image'), 'testimonial');
                $data['image'] = $photo['name'];
            }

            $testimonial->update($data);
            DB::commit();
            return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated successfully.');

        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function destroy(Testimonial $testimonial)
    {
        DB::beginTransaction();
        try {
            $this->imageService->delete($testimonial->image, 'testimonial');
            $testimonial->delete();
            DB::commit();
            return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
