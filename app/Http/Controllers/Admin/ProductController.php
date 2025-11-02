<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductTag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Services\ImageUploadService;

class ProductController extends Controller
{
    protected $imageService;

    public function __construct(ImageUploadService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Display a listing of products
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Product::with(['categories', 'tags', 'author'])->latest();

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('categories', fn($p) => $p->categories->pluck('title')->implode(', '))
                ->addColumn('tags', fn($p) => $p->tags->pluck('title')->implode(', '))
                ->addColumn('price', fn($p) => currencyformat($p->regular_price))
                ->addColumn('status', fn($p) => status_badge($p->status))
                ->addColumn('actions', function ($p) {
                    $edit = '<a href="' . route('admin.products.edit', $p->id) . '" class="btn btn-sm btn-primary me-1" title="Edit">
                                <i class="bi bi-pencil-fill"></i>
                             </a>';
                    $delete = '<form method="POST" action="' . route('admin.products.destroy', $p->id) . '" style="display:inline;">
                                ' . csrf_field() . method_field('DELETE') . '
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')" title="Delete">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                              </form>';
                    return $edit . $delete;
                })
                ->rawColumns(['status', 'actions'])
                ->make(true);
        }

        return view('admin.ecommerce.products.index');
    }

    /**
     * Show the form for creating a new product
     */
    public function create()
    {
        $categories = ProductCategory::where('status', 1)
            ->whereNull('parent_id')
            ->with('children')
            ->get();

        $tags = ProductTag::where('status', 1)->pluck('title', 'id');

        return view('admin.ecommerce.products.form', [
            'product' => null,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    /**
     * Store a newly created product in storage
     */
    public function store(ProductRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
            $data['author_id'] = Auth::id();

            // Upload images
            if ($request->hasFile('banner')) {
                $banner = $this->imageService->upload($request->file('banner'), 'banner');
                $data['banner'] = $banner['name'];
            }

            if ($request->hasFile('image')) {
                $image = $this->imageService->upload($request->file('image'), 'product');
                $data['image'] = $image['name'];
            }

            if ($request->hasFile('seo_image')) {
                $seo = $this->imageService->upload($request->file('seo_image'), 'seo');
                $data['seo_image'] = $seo['name'];
            }

            // Create product
            $product = Product::create($data);

            // Sync categories and tags
            $product->categories()->sync($request->product_category_ids ?? []);
            $product->tags()->sync($request->product_tag_ids ?? []);

            // Gallery upload
            if ($request->hasFile('gallery')) {
                foreach ($request->file('gallery') as $index => $file) {
                    $uploaded = $this->imageService->upload($file, 'product_gallery');
                    $product->galleries()->create([
                        'image' => $uploaded['name'],
                        'alt' => $request->input('gallery_alt.' . $index, ''),
                        'sort_order' => $index,
                        'is_default' => $index === 0,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Product store failed: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);

            return back()->withInput()->with('error', 'Something went wrong while creating the product.');
        }
    }

    /**
     * Show the form for editing the specified product
     */
    public function edit(Product $product)
    {
        $product->load(['galleries', 'categories', 'tags']);

        $categories = ProductCategory::where('status', 1)
            ->whereNull('parent_id')
            ->with('children')
            ->get();

        $tags = ProductTag::where('status', 1)->pluck('title', 'id');

        return view('admin.ecommerce.products.form', compact('product', 'categories', 'tags'));
    }

    /**
     * Update the specified product in storage
     */
    public function update(ProductRequest $request, Product $product)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            $data['slug'] = $data['slug'] ?: Str::slug($data['title']);

            // Remove selected gallery images
            if ($request->filled('remove_gallery')) {
                foreach ($request->remove_gallery as $imageId) {
                    $image = $product->galleries()->find($imageId);
                    if ($image) {
                        $this->imageService->delete($image->image, 'product_gallery');
                        $image->delete();
                    }
                }
            }

            // Upload & replace individual images
            if ($request->hasFile('banner')) {
                $this->imageService->delete($product->banner ?? null, 'banner');
                $banner = $this->imageService->upload($request->file('banner'), 'banner');
                $data['banner'] = $banner['name'];
            }

            if ($request->hasFile('image')) {
                $this->imageService->delete($product->image ?? null, 'product');
                $image = $this->imageService->upload($request->file('image'), 'product');
                $data['image'] = $image['name'];
            }

            if ($request->hasFile('seo_image')) {
                $this->imageService->delete($product->seo_image ?? null, 'seo');
                $seo = $this->imageService->upload($request->file('seo_image'), 'seo');
                $data['seo_image'] = $seo['name'];
            }

            // Update main product data
            $product->update($data);

            // Sync relationships
            $product->categories()->sync($request->product_category_ids ?? []);
            $product->tags()->sync($request->product_tag_ids ?? []);

            // Handle new gallery uploads
            if ($request->hasFile('gallery')) {
                foreach ($request->file('gallery') as $index => $file) {
                    $uploaded = $this->imageService->upload($file, 'product_gallery');
                    $product->galleries()->create([
                        'image' => $uploaded['name'],
                        'alt' => $request->input('gallery_alt.' . $index, ''),
                        'sort_order' => $index,
                        'is_default' => $index === 0,
                    ]);
                }
            }

            // Update default gallery image if chosen
            if ($request->filled('default_gallery')) {
                $product->galleries()->update(['is_default' => false]);
                $product->galleries()->where('id', $request->default_gallery)->update(['is_default' => true]);
            }

            DB::commit();

            return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Product update failed: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);

            return back()->withInput()->with('error', 'Something went wrong while updating the product.');
        }
    }

    /**
     * Remove the specified product from storage
     */
    public function destroy(Product $product)
    {
        try {
            foreach ($product->galleries as $img) {
                $this->imageService->delete($img->image, 'product_gallery');
            }

            $this->imageService->delete($product->banner ?? null, 'banner');
            $this->imageService->delete($product->image ?? null, 'product');
            $this->imageService->delete($product->seo_image ?? null, 'seo');

            $product->delete();

            return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('Product delete failed: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);

            return redirect()->back()->with('error', 'Unable to delete product.');
        }
    }
}
