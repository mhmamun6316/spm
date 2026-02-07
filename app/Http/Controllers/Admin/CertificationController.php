<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCertificationRequest;
use App\Http\Requests\UpdateCertificationRequest;
use App\Models\Certification;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CertificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:certifications.view')->only(['index']);
        $this->middleware('permission:certifications.create')->only(['create', 'store']);
        $this->middleware('permission:certifications.edit')->only(['edit', 'update', 'toggleStatus']);
        $this->middleware('permission:certifications.delete')->only(['destroy']);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $certifications = Certification::query()->latest();

            return DataTables::of($certifications)
                ->addIndexColumn()
                ->addColumn('image', function ($certification) {
                    return '<img src="' . asset('storage/' . $certification->image) . '" class="table-img" style="width: 100px; height: auto; border-radius: 4px;">';
                })
                ->addColumn('status', function ($certification) {
                    $checked = $certification->is_active ? 'checked' : '';
                    return '<label class="toggle-switch">
                            <input type="checkbox" ' . $checked . ' onchange="toggleStatus(' . $certification->id . ', this)">
                            <span class="slider"></span>
                            </label>';
                })
                ->addColumn('actions', function ($certification) {
                    $actions = '';
                    if (auth()->user()->can('certifications.edit')) {
                        $actions .= '<a href="' . route('admin.certifications.edit', $certification->id) . '" class="btn btn-sm btn-warning me-1"><i class="bi bi-pencil"></i></a>';
                    }
                    if (auth()->user()->can('certifications.delete')) {
                        $actions .= '<button onclick="deleteCertification(' . $certification->id . ')" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>';
                    }
                    return $actions;
                })
                ->rawColumns(['image', 'status', 'actions'])
                ->make(true);
        }

        return view('admin.certifications.index');
    }

    public function create()
    {
        return view('admin.certifications.create');
    }

    public function store(StoreCertificationRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('certifications', 'public');
        }

        Certification::create($data);

        return redirect()->route('admin.certifications.index')->with('success', 'Certification created successfully.');
    }

    public function edit(Certification $certification)
    {
        return view('admin.certifications.edit', compact('certification'));
    }

    public function update(UpdateCertificationRequest $request, Certification $certification)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($certification->image) {
                deleteStorageFile($certification->image);
            }
            $data['image'] = $request->file('image')->store('certifications', 'public');
        } else {
            unset($data['image']);
        }

        $certification->update($data);

        return redirect()->route('admin.certifications.index')->with('success', 'Certification updated successfully.');
    }

    public function destroy(Certification $certification)
    {
        if ($certification->image) {
            deleteStorageFile($certification->image);
        }
        $certification->delete();

        return response()->json(['success' => true, 'message' => 'Certification deleted successfully.']);
    }

    public function toggleStatus(Certification $certification)
    {
        $certification->is_active = !$certification->is_active;
        $certification->save();

        return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
    }
}
