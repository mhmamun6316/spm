<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSatisfiedClientRequest;
use App\Http\Requests\UpdateSatisfiedClientRequest;
use App\Models\SatisfiedClient;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SatisfiedClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:satisfied_clients.view')->only(['index']);
        $this->middleware('permission:satisfied_clients.create')->only(['create', 'store']);
        $this->middleware('permission:satisfied_clients.edit')->only(['edit', 'update', 'toggleStatus']);
        $this->middleware('permission:satisfied_clients.delete')->only(['destroy']);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $clients = SatisfiedClient::query()->latest();

            return DataTables::of($clients)
                ->addIndexColumn()
                ->addColumn('image', function ($client) {
                    return '<img src="' . asset('storage/' . $client->image) . '" class="table-img" style="width: 100px; height: auto; border-radius: 4px;">';
                })
                ->addColumn('status', function ($client) {
                    $checked = $client->is_active ? 'checked' : '';
                    return '<label class="toggle-switch">
                            <input type="checkbox" ' . $checked . ' onchange="toggleStatus(' . $client->id . ', this)">
                            <span class="slider"></span>
                            </label>';
                })
                ->addColumn('actions', function ($client) {
                    $actions = '';
                    if (auth()->user()->can('satisfied_clients.edit')) {
                        $actions .= '<a href="' . route('admin.satisfied-clients.edit', $client->id) . '" class="btn btn-sm btn-warning me-1"><i class="bi bi-pencil"></i></a>';
                    }
                    if (auth()->user()->can('satisfied_clients.delete')) {
                        $actions .= '<button onclick="deleteClient(' . $client->id . ')" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>';
                    }
                    return $actions;
                })
                ->rawColumns(['image', 'status', 'actions'])
                ->make(true);
        }

        return view('admin.satisfied-clients.index');
    }

    public function create()
    {
        return view('admin.satisfied-clients.create');
    }

    public function store(StoreSatisfiedClientRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('satisfied-clients', 'public');
        }

        SatisfiedClient::create($data);

        return redirect()->route('admin.satisfied-clients.index')->with('success', 'Satisfied Client created successfully.');
    }

    public function edit(SatisfiedClient $satisfiedClient)
    {
        return view('admin.satisfied-clients.edit', compact('satisfiedClient'));
    }

    public function update(UpdateSatisfiedClientRequest $request, SatisfiedClient $satisfiedClient)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($satisfiedClient->image) {
                deleteStorageFile($satisfiedClient->image);
            }
            $data['image'] = $request->file('image')->store('satisfied-clients', 'public');
        } else {
            unset($data['image']);
        }

        $satisfiedClient->update($data);

        return redirect()->route('admin.satisfied-clients.index')->with('success', 'Satisfied Client updated successfully.');
    }

    public function destroy(SatisfiedClient $satisfiedClient)
    {
        if ($satisfiedClient->image) {
            deleteStorageFile($satisfiedClient->image);
        }
        $satisfiedClient->delete();

        return response()->json(['success' => true, 'message' => 'Satisfied Client deleted successfully.']);
    }

    public function toggleStatus(SatisfiedClient $satisfiedClient)
    {
        $satisfiedClient->is_active = !$satisfiedClient->is_active;
        $satisfiedClient->save();

        return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
    }
}
