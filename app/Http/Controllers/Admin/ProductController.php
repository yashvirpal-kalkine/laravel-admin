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

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Product::with(['categories', 'tags', 'author'])->latest();

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('categories', fn($p) => $p->categories->pluck('title')->implode(', '))
                ->addColumn('tags', fn($p) => $p->tags->pluck('title')->implode(', '))
                ->addColumn('price', fn($p) => number_format($p->regular_price, 2))
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

    public function create()
    {
        $categories = ProductCategory::pluck('title', 'id');
        $tags = ProductTag::pluck('title', 'id');

        return view('admin.ecommerce.products.form', compact('categories', 'tags'));
    }

    public function store(ProductRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
            $data['author_id'] = Auth::id();

            // Upload images BEFORE saving (so we can set in $data)
            if ($request->hasFile('banner')) {
                $banner = $this->imageService->upload($request->file('banner'), 'banner');
                $data['banner'] = $banner['name'];
            }

            if ($request->hasFile('image')) {
                $image = $this->imageService->upload($request->file('image'), 'productcategory');
                $data['image'] = $image['name'];
            }

            if ($request->hasFile('seo_image')) {
                $seo = $this->imageService->upload($request->file('seo_image'), 'seo');
                $data['seo_image'] = $seo['name'];
            }

            // Create product first (we need $product->id for gallery)
            $product = Product::create($data);

            // Sync relations
            $product->categories()->sync($request->product_category_ids ?? []);
            $product->tags()->sync($request->product_tag_ids ?? []);

            // Gallery upload (after product exists)
            if ($request->hasFile('gallery')) {
                foreach ($request->file('gallery') as $index => $file) {
                    $uploaded = $this->imageService->upload($file, 'product_gallery');
                    $product->images()->create([
                        'image' => $uploaded['name'],
                        'alt' => $request->input('gallery_alt.' . $index, ''),
                        'sort_order' => $index,
                        'is_default' => $index === 0,
                    ]);
                }
            }

            DB::commit();

            return redirect()
                ->route('admin.products.index')
                ->with('success', '✅ Product created successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Product store failed: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);

            return redirect()->back()->withInput()->with('error', '❌ Something went wrong while creating the product.');
        }
    }

    public function edit(Product $product)
    {
        $product->load(['images', 'categories', 'tags']); // eager-load relations

        $categories = ProductCategory::whereNull('parent_id')->where('status', 1)->with('children')->get();
        $tags = ProductTag::pluck('title', 'id');

        return view('admin.ecommerce.products.form', compact('product', 'categories', 'tags'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            $data['slug'] = $data['slug'] ?: Str::slug($data['title']);

            if ($request->filled('remove_gallery')) {
                foreach ($request->remove_gallery as $imageId) {
                    $image = $product->images()->find($imageId);
                    if ($image) {
                        $this->imageService->delete($image->image, 'product_gallery');
                        $image->delete();
                    }
                }
            }
            // Upload & replace images
            if ($request->hasFile('banner')) {
                $this->imageService->delete($product->banner ?? null, 'banner');
                $banner = $this->imageService->upload($request->file('banner'), 'banner');
                $data['banner'] = $banner['name'];
            }

            if ($request->hasFile('image')) {
                $this->imageService->delete($product->image ?? null, 'productcategory');
                $image = $this->imageService->upload($request->file('image'), 'productcategory');
                $data['image'] = $image['name'];
            }

            if ($request->hasFile('seo_image')) {
                $this->imageService->delete($product->seo_image ?? null, 'seo');
                $seo = $this->imageService->upload($request->file('seo_image'), 'seo');
                $data['seo_image'] = $seo['name'];
            }

            // Update product
            $product->update($data);

            // Sync relations
            $product->categories()->sync($request->product_category_ids ?? []);
            $product->tags()->sync($request->product_tag_ids ?? []);

            // Handle gallery
            if ($request->hasFile('gallery')) {
                // Optional: remove old images or handle updates here
                foreach ($request->file('gallery') as $index => $file) {
                    $uploaded = $this->imageService->upload($file, 'product_gallery');
                    $product->images()->create([
                        'image' => $uploaded['name'],
                        'alt' => $request->input('gallery_alt.' . $index, ''),
                        'sort_order' => $index,
                        'is_default' => $index === 0,
                    ]);
                }
            }

            DB::commit();

            return redirect()
                ->route('admin.products.index')->with('success', '✅ Product updated successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Product update failed: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);

            return redirect()->back()->withInput()->with('error', '❌ Something went wrong while updating the product.');
        }
    }

    public function destroy(Product $product)
    {
        try {
            // Optional: delete related gallery images
            foreach ($product->images as $img) {
                $this->imageService->delete($img->image, 'product_gallery');
            }

            $product->delete();

            return redirect()
                ->route('admin.products.index')
                ->with('success', '🗑️ Product deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('Product delete failed: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);

            return redirect()
                ->back()
                ->with('error', '❌ Unable to delete product.');
        }
    }
}
