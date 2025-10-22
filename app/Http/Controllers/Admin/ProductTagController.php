<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductTagRequest;
use App\Models\ProductTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Yajra\DataTables\Facades\DataTables;

class ProductTagController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = ProductTag::query()->orderByDesc('id');

            return DataTables::of($query)
                ->addIndexColumn() // Serial number
                ->addColumn('status', function ($tag) {
                    return status_badge($tag->status); // use your helper
                })
                ->addColumn('actions', function ($tag) {
                    $edit = '<a href="' . route('admin.product-tags.edit', $tag->id) . '" class="btn btn-sm btn-primary me-1" title="Edit">
                            <i class="bi bi-pencil-fill"></i>
                         </a>';
                    $delete = '<form method="POST" action="' . route('admin.product-tags.destroy', $tag->id) . '" style="display:inline;">
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

        return view('admin.ecommerce.tags.index');
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
