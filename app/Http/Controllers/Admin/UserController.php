<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:users.view')->only(['index', 'show']);
        $this->middleware('permission:users.create')->only(['create', 'store']);
        $this->middleware('permission:users.edit')->only(['edit', 'update', 'toggleStatus']);
        $this->middleware('permission:users.delete')->only(['destroy']);
        $this->middleware('permission:users.approve')->only(['approve', 'reject']);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::select('id', 'name', 'email', 'status', 'approval_status', 'profile_photo', 'created_at');

            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('profile_photo', function ($user) {
                    if ($user->profile_photo) {
                        return '<img src="' . asset('storage/' . $user->profile_photo) . '" class="table-img" alt="Profile">';
                    } else {
                        return '<div class="table-img bg-primary d-flex align-items-center justify-content-center text-white">' . strtoupper(substr($user->name, 0, 1)) . '</div>';
                    }
                })
                ->addColumn('approval_status', function ($user) {
                    $badgeClass = match($user->approval_status) {
                        'approved' => 'bg-success',
                        'pending' => 'bg-warning',
                        'rejected' => 'bg-danger',
                        default => 'bg-secondary'
                    };
                    return '<span class="badge ' . $badgeClass . '">' . ucfirst($user->approval_status) . '</span>';
                })
                ->addColumn('status', function ($user) {
                    $checked = $user->status === 'active' ? 'checked' : '';
                    return '<label class="toggle-switch">
                            <input type="checkbox" ' . $checked . ' onchange="toggleStatus(' . $user->id . ', this)">
                            <span class="slider"></span>
                            </label>';
                })
                ->editColumn('created_at', function ($user) {
                    return $user->created_at->format('M d, Y');
                })
                ->addColumn('actions', function ($user) {
                    $csrf = csrf_token();
                    $actions = '';

                    if (auth()->user()->can('users.view')) {
                        $actions .= '<a href="' . route('admin.users.show', $user->id) . '" class="btn btn-sm btn-info me-1" title="View">
                                <i class="bi bi-eye"></i></a>';
                    }

                    if (auth()->user()->can('users.edit')) {
                        $actions .= '<a href="' . route('admin.users.edit', $user->id) . '" class="btn btn-sm btn-warning me-1" title="Edit">
                                <i class="bi bi-pencil"></i></a>';
                    }

                    if (auth()->user()->can('users.approve') && $user->approval_status === 'pending') {
                        $actions .= '<button onclick="approveUser(' . $user->id . ')" class="btn btn-sm btn-success me-1" title="Approve">
                                <i class="bi bi-check-circle"></i>
                            </button>
                            <button onclick="rejectUser(' . $user->id . ')" class="btn btn-sm btn-danger me-1" title="Reject">
                                <i class="bi bi-x-circle"></i>
                            </button>';
                    }

                    if (auth()->user()->can('users.delete')) {
                        $actions .= '<button onclick="deleteUser(' . $user->id . ')" class="btn btn-sm btn-danger" title="Delete">
                                <i class="bi bi-trash"></i></button>';
                    }

                    return $actions;
                })
                ->rawColumns(['profile_photo', 'approval_status', 'status', 'actions'])
                ->filterColumn('name', function ($query, $keyword) {
                    $query->where('name', 'like', "%{$keyword}%");
                })
                ->filterColumn('email', function ($query, $keyword) {
                    $query->where('email', 'like', "%{$keyword}%");
                })
                ->make(true);
        }

        return view('admin.users.index');
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        if ($request->hasFile('profile_photo')) {
            try {
                $allowedMimes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                $data['profile_photo'] = helperFileUploader($request->file('profile_photo'), $allowedMimes, 'profile-photos');
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['profile_photo' => $e->getMessage()]);
            }
        }

        $user = User::create($data);

        if ($request->has('roles')) {
            $roles = Role::whereIn('id', $request->roles)->get();
            $user->assignRole($roles);
        }

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $userRoles = $user->roles->pluck('id')->toArray();
        return view('admin.users.edit', compact('user', 'roles', 'userRoles'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        if ($request->hasFile('profile_photo')) {
            try {
                if ($user->profile_photo) {
                    deleteStorageFile($user->profile_photo);
                }
                $allowedMimes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                $data['profile_photo'] = helperFileUploader($request->file('profile_photo'), $allowedMimes, 'profile-photos');
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['profile_photo' => $e->getMessage()]);
            }
        } elseif ($request->has('remove_photo') && $request->remove_photo) {
            // Remove existing photo
            if ($user->profile_photo) {
                deleteStorageFile($user->profile_photo);
            }
            $data['profile_photo'] = null;
        }

        $user->update($data);

        if ($request->has('roles')) {
            $roles = Role::whereIn('id', $request->roles)->get();
            $user->syncRoles($roles);
        } else {
            $user->syncRoles([]); // Remove all roles if none selected
        }

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        try {
            if ($user->profile_photo) {
                deleteStorageFile($user->profile_photo);
            }

            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'User deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete user.'
            ], 500);
        }
    }

    public function toggleStatus(Request $request, User $user)
    {
        try {
            $user->status = $user->status === 'active' ? 'inactive' : 'active';
            $user->save();

            return response()->json([
                'success' => true,
                'status' => $user->status,
                'message' => 'User status updated successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update user status.'
            ], 500);
        }
    }

    public function approve(User $user)
    {
        try {
            $user->approval_status = 'approved';
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'User approved successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to approve user.'
            ], 500);
        }
    }

    public function reject(User $user)
    {
        try {
            $user->approval_status = 'rejected';
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'User rejected successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to reject user.'
            ], 500);
        }
    }
}
