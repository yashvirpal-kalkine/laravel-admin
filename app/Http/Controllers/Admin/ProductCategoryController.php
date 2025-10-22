<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCategoryRequest;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Yajra\DataTables\Facades\DataTables;
class ProductCategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = ProductCategory::query();

        if ($search = $request->input('search')) {
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('slug', 'like', "%{$search}%");
        }

        $categories = $query->with('parent', 'author')->orderByDesc('id')->paginate(10);
        $categories->appends($request->all());

        return view('admin.ecommerce.categories.index', compact('categories', 'search'));
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
            $data['banner'] = $request->file('banner')->store('product_categories', 'public');
        }

        ProductCategory::create($data);

        return redirect()->route('admin.ecommerce.categories.index')->with('success', 'Product category created successfully.');
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
            $data['banner'] = $request->file('banner')->store('product_categories', 'public');
        }

        $product_category->update($data);

        return redirect()->route('admin.ecommerce.categories.index')->with('success', 'Product category updated successfully.');
    }

    public function destroy(ProductCategory $product_category)
    {
        $product_category->delete();
        return redirect()->route('admin.ecommerce.categories.index')->with('success', 'Product category deleted successfully.');
    }
}
