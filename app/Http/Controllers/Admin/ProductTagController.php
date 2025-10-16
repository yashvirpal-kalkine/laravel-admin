<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductTagRequest;
use App\Models\ProductTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductTagController extends Controller
{
    public function index(Request $request)
    {
        $query = ProductTag::query();

        if ($search = $request->input('search')) {
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%");
        }

        $tags = $query->orderByDesc('id')->paginate(10);
        $tags->appends($request->all());

        return view('admin.ecommerce.tags.index', compact('tags', 'search'));
    }

    public function create()
    {
        return view('admin.ecommerce.tags.form');
    }

    public function store(ProductTagRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['author_id'] = Auth::id();

        ProductTag::create($data);

        return redirect()->route('admin.product-tags.index')->with('success', 'Product tag created successfully.');
    }

    public function edit(ProductTag $product_tag)
    {
        return view('admin.ecommerce.tags.form', ['tag' => $product_tag]);
    }

    public function update(ProductTagRequest $request, ProductTag $product_tag)
    {
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);

        $product_tag->update($data);

        return redirect()->route('admin.product-tags.index')->with('success', 'Product tag updated successfully.');
    }

    public function destroy(ProductTag $product_tag)
    {
        $product_tag->delete();
        return redirect()->route('admin.product-tags.index')->with('success', 'Product tag deleted successfully.');
    }
}
