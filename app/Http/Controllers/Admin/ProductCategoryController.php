<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCategoryRequest;
use App\Models\ProductCategory;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Exception;

class ProductCategoryController extends Controller
{
    protected $imageService;

    public function __construct(ImageUploadService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = ProductCategory::with(['parent', 'author'])->orderByDesc('id');

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('parent', fn($category) => $category->parent?->title ?? '-')
                ->addColumn('status', fn($category) => status_badge($category->status))
                ->addColumn('actions', function ($category) {
                    $editUrl = route('admin.product-categories.edit', $category->id);
                    $deleteUrl = route('admin.product-categories.destroy', $category->id);

                    return '
                        <a href="' . $editUrl . '" class="btn btn-sm btn-primary me-1" title="Edit">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                        <form method="POST" action="' . $deleteUrl . '" style="display:inline;">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')" title="Delete">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>';
                })
                ->rawColumns(['status', 'actions'])
                ->make(true);
        }

        return view('admin.ecommerce.categories.index');
    }

    public function create()
    {
        $category = new ProductCategory();

        $parents = ProductCategory::active()
            ->whereNull('parent_id')
            ->with('children')
            ->orderBy('title')
            ->get();

        return view('admin.ecommerce.categories.form', compact('category', 'parents'));
    }

    public function store(ProductCategoryRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
            $data['author_id'] = Auth::id();

            // Banner Update
            if ($request->hasFile('banner')) {
                $this->imageService->delete($request->banner, 'banner');
                $images = $this->imageService->upload($request->file('banner'), 'banner');
                $data['banner'] = $images['name'];
            }

            // Main Image
            if ($request->hasFile('image')) {
                $this->imageService->delete($request->image, 'productcategory');
                $images = $this->imageService->upload($request->file('image'), 'productcategory');
                $data['image'] = $images['name'];
            }

            // SEO Image
            if ($request->hasFile('seo_image')) {
                $this->imageService->delete($request->seo_image, 'seo');
                $images = $this->imageService->upload($request->file('seo_image'), 'seo');
                $data['seo_image'] = $images['name'];
            }


            ProductCategory::create($data);

            DB::commit();
            return redirect()->route('admin.product-categories.index')->with('success', 'Product category created successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('ProductCategory Store Error: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Something went wrong while creating the category.');
        }
    }

    public function edit(ProductCategory $product_category)
    {
        $excludeIds = collect($product_category->getDescendantIds())
            ->push($product_category->id)
            ->all();

        $parents = ProductCategory::active()
            ->whereNull('parent_id')
            ->whereNotIn('id', $excludeIds)
            ->with([
                'children' => function ($query) use ($excludeIds) {
                    $query->whereNotIn('id', $excludeIds)
                        ->with(['children' => fn($q) => $q->whereNotIn('id', $excludeIds)->with('children')]);
                }
            ])
            ->orderBy('title')
            ->get();

        return view('admin.ecommerce.categories.form', [
            'category' => $product_category,
            'parents' => $parents,
        ]);
    }

    public function update(ProductCategoryRequest $request, ProductCategory $product_category)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            $data['slug'] = $data['slug'] ?: Str::slug($data['title']);

            // Banner Update
            if ($request->hasFile('banner')) {
                $this->imageService->delete($product_category->banner, 'banner');
                $images = $this->imageService->upload($request->file('banner'), 'banner');
                $data['banner'] = $images['name'];
            }

            // Main Image
            if ($request->hasFile('image')) {
                $this->imageService->delete($product_category->image, 'productcategory');
                $images = $this->imageService->upload($request->file('image'), 'productcategory');
                $data['image'] = $images['name'];
            }

            // SEO Image
            if ($request->hasFile('seo_image')) {
                $this->imageService->delete($product_category->seo_image, 'seo');
                $images = $this->imageService->upload($request->file('seo_image'), 'seo');
                $data['seo_image'] = $images['name'];
            }


            $product_category->update($data);

            DB::commit();
            return redirect()->route('admin.product-categories.index')->with('success', 'Product category updated successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('ProductCategory Update Error: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Something went wrong while updating the category.');
        }
    }

    public function destroy(ProductCategory $product_category)
    {
        DB::beginTransaction();

        try {
            foreach (['banner', 'image', 'seo_image'] as $field) {
                if (!empty($product_category->$field)) {
                    $this->imageService->delete($product_category->$field, $field);
                }
            }

            $product_category->delete();

            DB::commit();
            return redirect()->route('admin.product-categories.index')->with('success', 'Product category deleted successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('ProductCategory Delete Error: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong while deleting the category.');
        }
    }
}
