<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHeroSliderRequest;
use App\Http\Requests\UpdateHeroSliderRequest;
use App\Models\HeroSlider;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class HeroSliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:hero_sliders.view')->only(['index']);
        $this->middleware('permission:hero_sliders.create')->only(['create', 'store']);
        $this->middleware('permission:hero_sliders.edit')->only(['edit', 'update', 'toggleStatus']);
        $this->middleware('permission:hero_sliders.delete')->only(['destroy']);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $sliders = HeroSlider::query()->orderBy('sort_order', 'asc');

            return DataTables::of($sliders)
                ->addIndexColumn()
                ->addColumn('image', function ($slider) {
                    return '<img src="' . asset('storage/' . $slider->image) . '" class="table-img" style="width: 100px; height: auto; border-radius: 4px;">';
                })
                ->addColumn('status', function ($slider) {
                    $checked = $slider->is_active ? 'checked' : '';
                    return '<label class="toggle-switch">
                            <input type="checkbox" ' . $checked . ' onchange="toggleStatus(' . $slider->id . ', this)">
                            <span class="slider"></span>
                            </label>';
                })
                ->addColumn('actions', function ($slider) {
                    $actions = '';
                    if (auth()->user()->can('hero_sliders.edit')) {
                        $actions .= '<a href="' . route('admin.hero-sliders.edit', $slider->id) . '" class="btn btn-sm btn-warning me-1"><i class="bi bi-pencil"></i></a>';
                    }
                    if (auth()->user()->can('hero_sliders.delete')) {
                        $actions .= '<button onclick="deleteSlider(' . $slider->id . ')" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>';
                    }
                    return $actions;
                })
                ->rawColumns(['image', 'status', 'actions'])
                ->make(true);
        }

        return view('admin.hero-sliders.index');
    }

    public function create()
    {
        return view('admin.hero-sliders.create');
    }

    public function store(StoreHeroSliderRequest $request)
    {
        $data = $request->validated();

        if ($request->filled('image') && strpos($request->image, 'base64') !== false) {
            $data['image'] = uploadBase64Image($request->image, 'public', 'hero-sliders');
        }

        // If sort_order is provided, check if it already exists
        if (isset($data['sort_order']) && $data['sort_order'] !== null) {
            $sortOrder = $data['sort_order'];
            
            // Check if this sort_order already exists
            $exists = HeroSlider::where('sort_order', '=', $sortOrder)->exists();
            
            // If it exists, increment all records with sort_order >= this value
            if ($exists) {
                HeroSlider::where('sort_order', '>=', $sortOrder)->increment('sort_order');
            }
        } else {
            // If no sort_order provided, assign the next available number
            $data['sort_order'] = (HeroSlider::max('sort_order') ?? 0) + 1;
        }

        HeroSlider::create($data);

        return redirect()->route('admin.hero-sliders.index')->with('success', 'Hero Slider created successfully.');
    }

    public function edit(HeroSlider $heroSlider)
    {
        return view('admin.hero-sliders.edit', compact('heroSlider'));
    }

    public function update(UpdateHeroSliderRequest $request, HeroSlider $heroSlider)
    {
        $data = $request->validated();

        if ($request->filled('image')) {
            if (strpos($request->image, 'base64') !== false) {
                // Delete old image
                if ($heroSlider->image) {
                    deleteStorageFile($heroSlider->image);
                }
                $data['image'] = uploadBase64Image($request->image, 'public', 'hero-sliders');
            } else {
                unset($data['image']);
            }
        } elseif ($request->has('image') && empty($request->image)) {
            if ($heroSlider->image) {
                deleteStorageFile($heroSlider->image);
            }
            $data['image'] = null;
        }

        // If sort_order is being changed, check if the new sort_order already exists
        if (isset($data['sort_order']) && $data['sort_order'] !== $heroSlider->sort_order) {
            $newSortOrder = $data['sort_order'];
            
            // Check if this sort_order already exists (excluding current record)
            $exists = HeroSlider::where('id', '!=', $heroSlider->id)
                ->where('sort_order', '=', $newSortOrder)
                ->exists();
            
            // If it exists, increment all records with sort_order >= this value (excluding current record)
            if ($exists) {
                HeroSlider::where('id', '!=', $heroSlider->id)
                    ->where('sort_order', '>=', $newSortOrder)
                    ->increment('sort_order');
            }
        }

        $heroSlider->update($data);

        return redirect()->route('admin.hero-sliders.index')->with('success', 'Hero Slider updated successfully.');
    }

    public function destroy(HeroSlider $heroSlider)
    {
        if ($heroSlider->image) {
            deleteStorageFile($heroSlider->image);
        }
        $heroSlider->delete();

        return response()->json(['success' => true, 'message' => 'Hero Slider deleted successfully.']);
    }

    public function toggleStatus(HeroSlider $heroSlider)
    {
        $heroSlider->is_active = !$heroSlider->is_active;
        $heroSlider->save();

        return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
    }
}
