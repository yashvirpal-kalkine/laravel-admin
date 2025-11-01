<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductTag;
use App\Http\Requests\ProductTagRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use App\Services\ImageUploadService;

class ProductTagController extends Controller
{
    protected $imageService;

    public function __construct(ImageUploadService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $tags = ProductTag::with('author')->select('product_tags.*');

            return DataTables::of($tags)
                ->addIndexColumn()
                ->addColumn('status', fn($tag) => status_badge($tag->status))
                //->addColumn('author', fn($tag) => $tag->author?->name ?? '-')
                ->addColumn('actions', function ($tag) {
                    $editUrl = route('admin.product-tags.edit', $tag->id);
                    $deleteUrl = route('admin.product-tags.destroy', $tag->id);

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

        return view('admin.ecommerce.tags.index');
    }

    public function create()
    {
        $ProductTag = new ProductTag();
        return view('admin.ecommerce.tags.form', ['tag' => $ProductTag]);

    }

    public function store(ProductTagRequest $request)
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
            ProductTag::create($data);
            DB::commit();
            return redirect()->route('admin.product-tags.index')->with('success', 'Tag created successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            //Log::error('ProductTag Store Error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect()->back()->withInput()->with('error', 'Failed to create tag. Please try again.');
        }
    }

    public function edit(ProductTag $product_tag)
    {

        return view('admin.ecommerce.tags.form', ['tag' => $product_tag]);

    }

    public function update(ProductTagRequest $request, ProductTag $product_tag)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();

            if (empty($data['slug'])) {
                $data['slug'] = Str::slug($data['title']);
            }

            if ($request->hasFile('banner')) {
                // Delete old banner
                if (!empty($ProductTag->banner)) {
                    $this->imageService->delete($product_tag->banner, 'banner');
                }
                // Upload new banner
                $images = $this->imageService->upload($request->file('banner'), 'banner');
                $data['banner'] = $images['name'];
            }

            $product_tag->update($data);

            DB::commit();

            return redirect()->route('admin.product-tags.index')->with('success', 'Tag updated successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            // Log::error('ProductTag Update Error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect()->back()->withInput()->with('error', 'Failed to update tag. Please try again.');
        }
    }

    public function destroy(ProductTag $product_tag)
    {
        DB::beginTransaction();

        try {
            if (!empty($product_tag->banner)) {
                $this->imageService->delete($product_tag->banner, 'banner');
            }

            $product_tag->delete();

            DB::commit();
            return redirect()->route('admin.product-tags.index')->with('success', 'Tag deleted successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            // Log::error('ProductTag Delete Error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect()->route('admin.product-tags.index')->with('error', 'Failed to delete tag. Please try again.');
        }
    }
}
