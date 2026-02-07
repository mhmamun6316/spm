<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OfficeLocation;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OfficeLocationController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $locations = OfficeLocation::query()->latest('sort_order');

            return DataTables::of($locations)
                ->addIndexColumn()
                ->editColumn('is_active', function ($row) {
                    $checked = $row->is_active ? 'checked' : '';
                    return '<div class="form-check form-switch">
                                <input class="form-check-input toggle-status" type="checkbox" data-id="' . $row->id . '" ' . $checked . '>
                            </div>';
                })
                ->addColumn('actions', function ($row) {
                    $actions = '<a href="'.route('admin.office-locations.edit', $row->id).'" class="btn btn-sm btn-warning me-1"><i class="bi bi-pencil"></i></a>';
                    $actions .= '<button onclick="deleteLocation('.$row->id.')" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>';
                    return $actions;
                })
                ->rawColumns(['is_active', 'actions'])
                ->make(true);
        }

        return view('admin.office-locations.index');
    }

    public function create()
    {
        return view('admin.office-locations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'email' => 'nullable|email',
            'sort_order' => 'integer|default:0',
            'is_active' => 'boolean',
        ]);

        OfficeLocation::create($validated);

        return redirect()->route('admin.office-locations.index')->with('success', 'Office Location created successfully.');
    }

    public function edit(OfficeLocation $officeLocation)
    {
        return view('admin.office-locations.edit', compact('officeLocation'));
    }

    public function update(Request $request, OfficeLocation $officeLocation)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'email' => 'nullable|email',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);

        $officeLocation->update($validated);

        return redirect()->route('admin.office-locations.index')->with('success', 'Office Location updated successfully.');
    }

    public function destroy(OfficeLocation $officeLocation)
    {
        $officeLocation->delete();
        return response()->json(['success' => 'Office Location deleted successfully.']);
    }

    public function toggleStatus(OfficeLocation $officeLocation)
    {
        $officeLocation->update(['is_active' => !$officeLocation->is_active]);
        return response()->json(['success' => 'Status updated successfully.']);
    }
}
