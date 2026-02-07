<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductCategoryController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $categories = ProductCategory::select('id', 'name', 'description', 'status', 'created_at');

            return DataTables::of($categories)
                ->addIndexColumn()
                ->addColumn('status', function ($category) {
                    $checked = $category->status === 'active' ? 'checked' : '';
                    return '<label class="toggle-switch">
                            <input type="checkbox" ' . $checked . ' onchange="toggleStatus(' . $category->id . ', this)">
                            <span class="slider"></span>
                            </label>';
                })
                ->editColumn('created_at', function ($category) {
                    return $category->created_at->format('M d, Y');
                })
                ->addColumn('actions', function ($category) {
                    $actions = '<a href="' . route('admin.product-categories.show', $category->id) . '" class="btn btn-sm btn-info me-1" title="' . __('common.view') . '">
                            <i class="bi bi-eye"></i></a>';

                    $actions .= '<a href="' . route('admin.product-categories.edit', $category->id) . '" class="btn btn-sm btn-warning me-1" title="' . __('common.edit') . '">
                            <i class="bi bi-pencil"></i></a>';

                    $actions .= '<button onclick="deleteCategory(' . $category->id . ')" class="btn btn-sm btn-danger" title="' . __('common.delete') . '">
                            <i class="bi bi-trash"></i></button>';

                    return $actions;
                })
                ->rawColumns(['status', 'actions'])
                ->filterColumn('name', function ($query, $keyword) {
                    $query->where('name', 'like', "%{$keyword}%");
                })
                ->make(true);
        }

        return view('product-categories.index');
    }

    public function create()
    {
        return view('product-categories.create');
    }

    public function store(StoreProductCategoryRequest $request)
    {
        ProductCategory::create($request->validated());

        return redirect()->route('admin.product-categories.index')->with('success', __('common.category_created'));
    }

    public function show(ProductCategory $productCategory)
    {
        $productCategory->load('products');
        return view('product-categories.show', compact('productCategory'));
    }

    public function edit(ProductCategory $productCategory)
    {
        return view('product-categories.edit', compact('productCategory'));
    }

    public function update(UpdateProductCategoryRequest $request, ProductCategory $productCategory)
    {
        $productCategory->update($request->validated());

        return redirect()->route('admin.product-categories.index')->with('success', __('common.category_updated'));
    }

    public function destroy(ProductCategory $productCategory)
    {
        $productCategory->delete();

        return redirect()->route('admin.product-categories.index')->with('success', __('common.category_deleted'));
    }

    public function toggleStatus(Request $request, ProductCategory $productCategory)
    {
        $productCategory->status = $request->status === 'true' ? 'active' : 'inactive';
        $productCategory->save();

        return response()->json(['success' => true, 'message' => __('common.status_updated')]);
    }
}
