<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BoardMember;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;

class BoardMemberController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $members = BoardMember::query()->orderBy('sort_order', 'asc');

            return DataTables::of($members)
                ->addIndexColumn()
                ->addColumn('image', function ($member) {
                    if ($member->image) {
                        return '<img src="' . asset('storage/' . $member->image) . '" class="table-img" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">';
                    }
                    return '<span class="badge bg-secondary">No Image</span>';
                })
                ->addColumn('status', function ($member) {
                    $checked = $member->is_active ? 'checked' : '';
                    return '<div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" ' . $checked . ' onchange="toggleStatus(' . $member->id . ', this)">
                            </div>';
                })
                ->addColumn('actions', function ($member) {
                    $actions = '<a href="' . route('admin.board-members.edit', $member->id) . '" class="btn btn-sm btn-primary me-1"><i class="fas fa-edit"></i></a>';
                    $actions .= '<button onclick="deleteMember(' . $member->id . ')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>';
                    return $actions;
                })
                ->rawColumns(['image', 'status', 'actions'])
                ->make(true);
        }

        return view('admin.board-members.index');
    }

    public function create()
    {
        return view('admin.board-members.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $data = $request->except('image');
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('board-members', 'public');
        }

        BoardMember::create($data);

        return redirect()->route('admin.board-members.index')->with('success', 'Board Member created successfully.');
    }

    public function edit(BoardMember $boardMember)
    {
        return view('admin.board-members.edit', compact('boardMember'));
    }

    public function update(Request $request, BoardMember $boardMember)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $data = $request->except('image');
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            if ($boardMember->image) {
                Storage::disk('public')->delete($boardMember->image);
            }
            $data['image'] = $request->file('image')->store('board-members', 'public');
        }

        $boardMember->update($data);

        return redirect()->route('admin.board-members.index')->with('success', 'Board Member updated successfully.');
    }

    public function destroy(BoardMember $boardMember)
    {
        if ($boardMember->image) {
            Storage::disk('public')->delete($boardMember->image);
        }
        $boardMember->delete();

        return response()->json(['success' => true, 'message' => 'Board Member deleted successfully.']);
    }

    public function toggleStatus(BoardMember $boardMember)
    {
        $boardMember->is_active = !$boardMember->is_active;
        $boardMember->save();

        return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
    }
}
