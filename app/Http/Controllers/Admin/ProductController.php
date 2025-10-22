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
        $query = Product::query();

        if ($search = $request->input('search')) {
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('slug', 'like', "%{$search}%");
        }

        $products = $query->with(['categories', 'tags', 'author'])->latest()->paginate(10);
        $products->appends($request->all());

        return view('admin.ecommerce.products.index', compact('products', 'search'));
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
