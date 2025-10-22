<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductTag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Product::with(['categories', 'tags', 'author'])->latest();

            return DataTables::of($query)
                ->addIndexColumn() // Serial number
                ->addColumn('categories', function ($product) {
                    return $product->categories->pluck('title')->implode(', ');
                })
                ->addColumn('tags', function ($product) {
                    return $product->tags->pluck('title')->implode(', ');
                })
                ->addColumn('price', function ($product) {
                    return number_format($product->price, 2); // Format price
                })
                ->addColumn('status', function ($product) {
                    return status_badge($product->status); // Your helper
                })
                ->addColumn('actions', function ($product) {
                    $edit = '<a href="' . route('admin.products.edit', $product->id) . '" class="btn btn-sm btn-primary me-1" title="Edit">
                            <i class="bi bi-pencil-fill"></i>
                         </a>';
                    $delete = '<form method="POST" action="' . route('admin.products.destroy', $product->id) . '" style="display:inline;">
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
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['author_id'] = Auth::id();

        $product = Product::create($data);

        $product->categories()->sync($request->product_category_ids ?? []);
        $product->tags()->sync($request->product_tag_ids ?? []);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $categories = ProductCategory::pluck('title', 'id');
        $tags = ProductTag::pluck('title', 'id');
        return view('admin.ecommerce.products.form', compact('product', 'categories', 'tags'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);

        $product->update($data);
        $product->categories()->sync($request->product_category_ids ?? []);
        $product->tags()->sync($request->product_tag_ids ?? []);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
