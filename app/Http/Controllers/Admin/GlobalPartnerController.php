<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGlobalPartnerRequest;
use App\Http\Requests\UpdateGlobalPartnerRequest;
use App\Models\GlobalPartner;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class GlobalPartnerController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:global_partners.view')->only(['index']);
        $this->middleware('permission:global_partners.create')->only(['create', 'store']);
        $this->middleware('permission:global_partners.edit')->only(['edit', 'update', 'toggleStatus']);
        $this->middleware('permission:global_partners.delete')->only(['destroy']);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $partners = GlobalPartner::query()->latest();

            return DataTables::of($partners)
                ->addIndexColumn()
                ->addColumn('image', function ($partner) {
                    return '<img src="' . asset('storage/' . $partner->image) . '" class="table-img" style="width: 100px; height: auto; border-radius: 4px;">';
                })
                ->addColumn('status', function ($partner) {
                    $checked = $partner->is_active ? 'checked' : '';
                    return '<label class="toggle-switch">
                            <input type="checkbox" ' . $checked . ' onchange="toggleStatus(' . $partner->id . ', this)">
                            <span class="slider"></span>
                            </label>';
                })
                ->addColumn('actions', function ($partner) {
                    $actions = '';
                    if (auth()->user()->can('global_partners.edit')) {
                        $actions .= '<a href="' . route('admin.global-partners.edit', $partner->id) . '" class="btn btn-sm btn-warning me-1"><i class="bi bi-pencil"></i></a>';
                    }
                    if (auth()->user()->can('global_partners.delete')) {
                        $actions .= '<button onclick="deletePartner(' . $partner->id . ')" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>';
                    }
                    return $actions;
                })
                ->rawColumns(['image', 'status', 'actions'])
                ->make(true);
        }

        return view('admin.global-partners.index');
    }

    public function create()
    {
        return view('admin.global-partners.create');
    }

    public function store(StoreGlobalPartnerRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('global-partners', 'public');
        }

        GlobalPartner::create($data);

        return redirect()->route('admin.global-partners.index')->with('success', 'Global Partner created successfully.');
    }

    public function edit(GlobalPartner $globalPartner)
    {
        return view('admin.global-partners.edit', compact('globalPartner'));
    }

    public function update(UpdateGlobalPartnerRequest $request, GlobalPartner $globalPartner)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($globalPartner->image) {
                deleteStorageFile($globalPartner->image);
            }
            $data['image'] = $request->file('image')->store('global-partners', 'public');
        } else {
            unset($data['image']);
        }

        $globalPartner->update($data);

        return redirect()->route('admin.global-partners.index')->with('success', 'Global Partner updated successfully.');
    }

    public function destroy(GlobalPartner $globalPartner)
    {
        if ($globalPartner->image) {
            deleteStorageFile($globalPartner->image);
        }
        $globalPartner->delete();

        return response()->json(['success' => true, 'message' => 'Global Partner deleted successfully.']);
    }

    public function toggleStatus(GlobalPartner $globalPartner)
    {
        $globalPartner->is_active = !$globalPartner->is_active;
        $globalPartner->save();

        return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
    }
}
