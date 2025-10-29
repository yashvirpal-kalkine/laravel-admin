<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCategoryRequest;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Yajra\DataTables\Facades\DataTables;
use App\Services\ImageUploadService;
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
            $query = ProductCategory::with('parent', 'author')->orderByDesc('id');

            return DataTables::of($query)
                ->addIndexColumn() // Serial number
                ->addColumn('parent', function ($category) {
                    return $category->parent ? $category->parent->title : '-';
                })
                ->addColumn('status', function ($category) {
                    return status_badge($category->status); // keeps your custom badge
                })
                ->addColumn('actions', function ($category) {
                    $edit = '<a href="' . route('admin.product-categories.edit', $category->id) . '" class="btn btn-sm btn-primary me-1" title="Edit">
                            <i class="bi bi-pencil-fill"></i>
                         </a>';
                    $delete = '<form method="POST" action="' . route('admin.product-categories.destroy', $category->id) . '" style="display:inline;">
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

        return view('admin.ecommerce.categories.index');
    }


    public function create()
    {
        $parents = ProductCategory::pluck('title', 'id');
        return view('admin.ecommerce.categories.form', compact('parents'));
    }

    public function store(ProductCategoryRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['author_id'] = Auth::id();

        if ($request->hasFile('banner')) {
            $images = $this->imageService->upload($request->file('banner'), 'banner');
            $data['banner'] = $images['name'];
        }

        ProductCategory::create($data);

        return redirect()->route('admin.product-categories.index')->with('success', 'Product category created successfully.');
    }

    public function edit(ProductCategory $product_category)
    {
        $parents = ProductCategory::where('id', '!=', $product_category->id)->pluck('title', 'id');
        return view('admin.ecommerce.categories.form', ['category' => $product_category, 'parents' => $parents]);
    }

    public function update(ProductCategoryRequest $request, ProductCategory $product_category)
    {
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);

        if ($request->hasFile('banner')) {
            $images = $this->imageService->upload($request->file('banner'), 'banner');
            $data['banner'] = $images['name'];
        }

        $product_category->update($data);

        return redirect()->route('admin.product-categories.index')->with('success', 'Product category updated successfully.');
    }

    public function destroy(ProductCategory $product_category)
    {
        if (!empty($product_category->banner)) {
            $this->imageService->delete($product_category->banner, 'banner');
        }
        $product_category->delete();
        return redirect()->route('admin.product-categories.index')->with('success', 'Product category deleted successfully.');
    }
}
