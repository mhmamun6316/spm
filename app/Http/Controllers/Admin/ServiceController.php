<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:services.view')->only(['index']);
        $this->middleware('permission:services.create')->only(['create', 'store']);
        $this->middleware('permission:services.edit')->only(['edit', 'update', 'toggleStatus']);
        $this->middleware('permission:services.delete')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $services = Service::query()->latest();

            return DataTables::of($services)
                ->addIndexColumn()
                ->addColumn('short_description', function ($service) {
                    return Str::limit($service->short_description, 50);
                })
                ->addColumn('status', function ($service) {
                    $checked = $service->is_active ? 'checked' : '';
                    return '<label class="toggle-switch">
                            <input type="checkbox" ' . $checked . ' onchange="toggleStatus(' . $service->id . ', this)">
                            <span class="slider"></span>
                            </label>';
                })
                ->addColumn('actions', function ($service) {
                    $actions = '';
                    $actions .= '<a href="' . route('admin.services.edit', $service->id) . '" class="btn btn-sm btn-warning me-1"><i class="bi bi-pencil"></i></a>';
                    $actions .= '<button onclick="deleteService(' . $service->id . ')" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>';
                    return $actions;
                })
                ->rawColumns(['status', 'actions'])
                ->make(true);
        }

        return view('admin.services.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']);
        
        // Ensure unique slug
        $count = Service::where('slug', $data['slug'])->count();
        if ($count > 0) {
            $data['slug'] .= '-' . ($count + 1);
        }

        Service::create($data);

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']);

        // Ensure unique slug excluding current
        $count = Service::where('slug', $data['slug'])
            ->where('id', '!=', $service->id)
            ->count();
            
        if ($count > 0) {
            $data['slug'] .= '-' . ($count + 1);
        }

        $service->update($data);

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return response()->json(['success' => true, 'message' => 'Service deleted successfully.']);
    }

    public function toggleStatus(Service $service)
    {
        $service->is_active = !$service->is_active;
        $service->save();

        return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
    }
}
