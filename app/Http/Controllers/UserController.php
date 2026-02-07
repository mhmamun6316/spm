<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    use \App\Traits\ImageUploadTrait;

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
                        $actions .= '<a href="' . route('admin.users.show', $user->id) . '" class="btn btn-sm btn-info me-1" title="' . __('common.view') . '">
                                <i class="bi bi-eye"></i></a>';
                    }

                    if (auth()->user()->can('users.edit')) {
                        $actions .= '<a href="' . route('admin.users.edit', $user->id) . '" class="btn btn-sm btn-warning me-1" title="' . __('common.edit') . '">
                                <i class="bi bi-pencil"></i></a>';
                    }

                    if (auth()->user()->can('users.approve') && $user->approval_status === 'pending') {
                        $actions .= '<form action="' . route('admin.users.approve', $user->id) . '" method="POST" style="display:inline;" onsubmit="return confirm(\'' . __('common.are_you_sure') . ' ' . __('common.approve') . ' this user?\')">
                                <input type="hidden" name="_token" value="' . $csrf . '">
                                <button type="submit" class="btn btn-sm btn-success me-1" title="' . __('common.approve') . '">
                                    <i class="bi bi-check-circle"></i>
                                </button>
                            </form>
                            <form action="' . route('admin.users.reject', $user->id) . '" method="POST" style="display:inline;" onsubmit="return confirm(\'' . __('common.are_you_sure') . ' ' . __('common.reject') . ' this user?\')">
                                <input type="hidden" name="_token" value="' . $csrf . '">
                                <button type="submit" class="btn btn-sm btn-danger me-1" title="' . __('common.reject') . '">
                                    <i class="bi bi-x-circle"></i>
                                </button>
                            </form>';
                    }

                    if (auth()->user()->can('users.delete')) {
                        $actions .= '<button onclick="deleteUser(' . $user->id . ')" class="btn btn-sm btn-danger" title="' . __('common.delete') . '">
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

        return view('users.index');
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        if ($request->filled('profile_photo')) {
            $data['profile_photo'] = $this->uploadImage($request->profile_photo, 'profile-photos');
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
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $userRoles = $user->roles->pluck('id')->toArray();
        return view('users.edit', compact('user', 'roles', 'userRoles'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        if ($request->filled('profile_photo')) {
            // If it's a new base64 image (not the path string)
            if (strpos($request->profile_photo, 'base64') !== false) {
                 if ($user->profile_photo) {
                    $this->deleteImage($user->profile_photo);
                }
                $data['profile_photo'] = $this->uploadImage($request->profile_photo, 'profile-photos');
            } else {
                // If it's just the path text check if empty to delete
                 if (empty($request->profile_photo) && $user->profile_photo) {
                    $this->deleteImage($user->profile_photo);
                    $data['profile_photo'] = null;
                 } else {
                    // Do nothing, keep existing
                    unset($data['profile_photo']);
                 }
            }
        } elseif ($request->has('profile_photo') && empty($request->profile_photo)) {
             // Explicitly cleared
             if ($user->profile_photo) {
                $this->deleteImage($user->profile_photo);
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
        if ($user->profile_photo) {
            $this->deleteImage($user->profile_photo);
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    public function toggleStatus(Request $request, User $user)
    {
        $user->status = $user->status === 'active' ? 'inactive' : 'active';
        $user->save();

        return response()->json([
            'success' => true,
            'status' => $user->status,
            'message' => 'User status updated successfully.'
        ]);
    }

    public function approve(User $user)
    {
        $user->approval_status = 'approved';
        $user->save();

        return redirect()->route('admin.users.index')->with('success', __('common.user_approved'));
    }

    public function reject(User $user)
    {
        $user->approval_status = 'rejected';
        $user->save();

        return redirect()->route('admin.users.index')->with('success', __('common.user_rejected'));
    }
}
