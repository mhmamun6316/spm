<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::with('category')->select('id', 'name', 'price', 'quantity', 'product_category_id', 'image', 'status', 'created_at');

            return DataTables::of($products)
                ->addIndexColumn()
                ->addColumn('category', function ($product) {
                    return $product->category ? $product->category->name : '-';
                })
                ->addColumn('image', function ($product) {
                    if ($product->image) {
                        return '<img src="' . asset('storage/' . $product->image) . '" class="table-img" alt="Product">';
                    } else {
                        return '<div class="table-img bg-secondary d-flex align-items-center justify-content-center text-white">
                                <i class="bi bi-image"></i>
                            </div>';
                    }
                })
                ->addColumn('price', function ($product) {
                    return '$' . number_format($product->price, 2);
                })
                ->addColumn('status', function ($product) {
                    $checked = $product->status === 'active' ? 'checked' : '';
                    return '<label class="toggle-switch">
                            <input type="checkbox" ' . $checked . ' onchange="toggleStatus(' . $product->id . ', this)">
                            <span class="slider"></span>
                            </label>';
                })
                ->editColumn('created_at', function ($product) {
                    return $product->created_at->format('M d, Y');
                })
                ->addColumn('actions', function ($product) {
                    $actions = '<a href="' . route('admin.products.show', $product->id) . '" class="btn btn-sm btn-info me-1" title="' . __('common.view') . '">
                            <i class="bi bi-eye"></i></a>';

                    $actions .= '<a href="' . route('admin.products.edit', $product->id) . '" class="btn btn-sm btn-warning me-1" title="' . __('common.edit') . '">
                            <i class="bi bi-pencil"></i></a>';

                    $actions .= '<button onclick="deleteProduct(' . $product->id . ')" class="btn btn-sm btn-danger" title="' . __('common.delete') . '">
                            <i class="bi bi-trash"></i></button>';

                    return $actions;
                })
                ->rawColumns(['image', 'status', 'actions'])
                ->filterColumn('name', function ($query, $keyword) {
                    $query->where('name', 'like', "%{$keyword}%");
                })
                ->make(true);
        }

        return view('products.index');
    }

    public function create()
    {
        $categories = ProductCategory::where('status', 'active')->get();
        return view('products.create', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', __('common.product_created'));
    }

    public function show(Product $product)
    {
        $product->load('category');
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = ProductCategory::where('status', 'active')->get();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', __('common.product_updated'));
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', __('common.product_deleted'));
    }

    public function toggleStatus(Request $request, Product $product)
    {
        $product->status = $request->status === 'true' ? 'active' : 'inactive';
        $product->save();

        return response()->json(['success' => true, 'message' => __('common.status_updated')]);
    }
}
