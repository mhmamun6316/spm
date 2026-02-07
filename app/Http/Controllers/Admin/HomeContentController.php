<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHomeContentRequest;
use App\Http\Requests\UpdateHomeContentRequest;
use App\Models\HomeContent;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class HomeContentController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:home_contents.view')->only(['index']);
        $this->middleware('permission:home_contents.create')->only(['create', 'store']);
        $this->middleware('permission:home_contents.edit')->only(['edit', 'update', 'toggleStatus']);
        $this->middleware('permission:home_contents.delete')->only(['destroy']);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $contents = HomeContent::query()->orderBy('sort_order', 'asc');

            return DataTables::of($contents)
                ->addIndexColumn()
                ->addColumn('image', function ($content) {
                    if ($content->image) {
                        return '<img src="' . asset('storage/' . $content->image) . '" alt="Image" style="height: 50px; width: auto;" class="rounded">';
                    }
                    return '<span class="text-muted">No Image</span>';
                })
                ->addColumn('type', function ($content) {
                    if ($content->type === 'text_image') {
                        return '<span class="badge bg-primary">Text & Image</span>';
                    }
                    return '<span class="badge bg-secondary">Text Only</span>';
                })
                ->addColumn('text_position', function ($content) {
                    $badges = [
                        'left' => '<span class="badge bg-info">Left</span>',
                        'center' => '<span class="badge bg-warning">Center</span>',
                        'right' => '<span class="badge bg-secondary">Right</span>',
                    ];
                    return $badges[$content->text_position] ?? '';
                })
                ->addColumn('status', function ($content) {
                    $checked = $content->is_active ? 'checked' : '';
                    return '<label class="toggle-switch">
                            <input type="checkbox" ' . $checked . ' onchange="toggleStatus(' . $content->id . ', this)">
                            <span class="slider"></span>
                            </label>';
                })
                ->addColumn('actions', function ($content) {
                    $actions = '';
                    if (auth()->user()->can('home_contents.edit')) {
                        $actions .= '<a href="' . route('admin.home-contents.edit', $content->id) . '" class="btn btn-sm btn-warning me-1"><i class="bi bi-pencil"></i></a>';
                    }
                    if (auth()->user()->can('home_contents.delete')) {
                        $actions .= '<button onclick="deleteContent(' . $content->id . ')" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>';
                    }
                    return $actions;
                })
                ->addColumn('description', function ($content) {
                    return \Illuminate\Support\Str::limit(strip_tags($content->description), 100);
                })
                ->rawColumns(['image', 'type', 'text_position', 'status', 'actions'])
                ->make(true);
        }

        return view('admin.home-contents.index');
    }

    public function create()
    {
        return view('admin.home-contents.create');
    }

    public function store(StoreHomeContentRequest $request)
    {
        $data = $request->validated();
        
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('home-contents', 'public');
        }

        // If sort_order is provided, check if it already exists
        if (isset($data['sort_order']) && $data['sort_order'] !== null) {
            $sortOrder = $data['sort_order'];
            
            // Check if this sort_order already exists
            $exists = HomeContent::where('sort_order', '=', $sortOrder)->exists();
            
            // If it exists, increment all records with sort_order >= this value
            if ($exists) {
                HomeContent::where('sort_order', '>=', $sortOrder)->increment('sort_order');
            }
        } else {
            // If no sort_order provided, assign the next available number
            $data['sort_order'] = (HomeContent::max('sort_order') ?? 0) + 1;
        }
        
        HomeContent::create($data);

        return redirect()->route('admin.home-contents.index')->with('success', 'Home Content created successfully.');
    }

    public function edit(HomeContent $homeContent)
    {
        return view('admin.home-contents.edit', compact('homeContent'));
    }

    public function update(UpdateHomeContentRequest $request, HomeContent $homeContent)
    {
        $data = $request->validated();
        
        if ($request->hasFile('image')) {
            if ($homeContent->image) {
                deleteStorageFile($homeContent->image);
            }
            $data['image'] = $request->file('image')->store('home-contents', 'public');
        } else {
             // Keep existing image unless explicitly removed
             unset($data['image']);
        }

        // If type changed to 'text' and we want to clean up
        if ($data['type'] === 'text' && $homeContent->image) {
             deleteStorageFile($homeContent->image);
             $data['image'] = null;
             $data['image_position'] = null;
        }

        // If sort_order is being changed, check if the new sort_order already exists
        if (isset($data['sort_order']) && $data['sort_order'] !== $homeContent->sort_order) {
            $newSortOrder = $data['sort_order'];
            
            // Check if this sort_order already exists (excluding current record)
            $exists = HomeContent::where('id', '!=', $homeContent->id)
                ->where('sort_order', '=', $newSortOrder)
                ->exists();
            
            // If it exists, increment all records with sort_order >= this value (excluding current record)
            if ($exists) {
                HomeContent::where('id', '!=', $homeContent->id)
                    ->where('sort_order', '>=', $newSortOrder)
                    ->increment('sort_order');
            }
        }
        
        $homeContent->update($data);

        return redirect()->route('admin.home-contents.index')->with('success', 'Home Content updated successfully.');
    }

    public function destroy(HomeContent $homeContent)
    {
        if ($homeContent->image) {
            deleteStorageFile($homeContent->image);
        }
        $homeContent->delete();

        return response()->json(['success' => true, 'message' => 'Home Content deleted successfully.']);
    }

    public function toggleStatus(HomeContent $homeContent)
    {
        $homeContent->is_active = !$homeContent->is_active;
        $homeContent->save();

        return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
    }
}
