<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:roles.view')->only(['index', 'show']);
        $this->middleware('permission:roles.create')->only(['create', 'store']);
        $this->middleware('permission:roles.edit')->only(['edit', 'update']);
        $this->middleware('permission:roles.delete')->only(['destroy']);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $roles = Role::select(['id', 'name', 'created_at']);

            return DataTables::of($roles)
                ->addIndexColumn()
                ->editColumn('created_at', function ($role) {
                    return $role->created_at->format('M d, Y');
                })
                ->addColumn('permissions', function ($role) {
                    return $role->permissions->count();
                })
                ->addColumn('actions', function ($role) {
                    $actions = '';
                    
                    if (auth()->user()->can('roles.view')) {
                        $actions .= '<a href="' . route('admin.roles.show', $role->id) . '" class="btn btn-sm btn-info me-1" title="' . __('common.view') . '">
                                <i class="bi bi-eye"></i></a>';
                    }

                    if ($role->name !== 'admin' && auth()->user()->can('roles.edit')) {
                        $actions .= '<a href="' . route('admin.roles.edit', $role->id) . '" class="btn btn-sm btn-warning me-1" title="' . __('common.edit') . '">
                                <i class="bi bi-pencil"></i></a>';
                    }

                    if ($role->name !== 'admin' && auth()->user()->can('roles.delete')) {
                        $actions .= '<button onclick="deleteRole(' . $role->id . ')" class="btn btn-sm btn-danger" title="' . __('common.delete') . '">
                                <i class="bi bi-trash"></i></button>';
                    }

                    return $actions;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('roles.index');
    }

    public function create()
    {
        $permissions = Permission::all()->groupBy(function($data) {
            return explode('.', $data->name)[0];
        });
        
        return view('roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'required|array'
        ]);

        DB::beginTransaction();
        try {
            $role = Role::create(['name' => $request->name]);
            $role->syncPermissions($request->permissions);
            
            DB::commit();
            return redirect()->route('admin.roles.index')->with('success', 'Role created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error creating role: ' . $e->getMessage());
        }
    }

    public function show(Role $role)
    {
        $rolePermissions = $role->permissions;
        $permissions = Permission::all()->groupBy(function($data) {
            return explode('.', $data->name)[0];
        });

        return view('roles.show', compact('role', 'rolePermissions', 'permissions'));
    }

    public function edit(Role $role)
    {
        if ($role->name === 'admin') {
            return back()->with('error', 'Cannot edit admin role.');
        }

        $permissions = Permission::all()->groupBy(function($data) {
            return explode('.', $data->name)[0];
        });
        $rolePermissions = $role->permissions->pluck('name')->toArray();

        return view('roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request, Role $role)
    {
        if ($role->name === 'admin') {
            return back()->with('error', 'Cannot edit admin role.');
        }

        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'required|array'
        ]);

        DB::beginTransaction();
        try {
            $role->update(['name' => $request->name]);
            $role->syncPermissions($request->permissions);
            
            DB::commit();
            return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error updating role: ' . $e->getMessage());
        }
    }

    public function destroy(Role $role)
    {
        if ($role->name === 'admin') {
            return response()->json(['message' => 'Cannot delete admin role'], 403);
        }

        $role->delete();
        return response()->json(['message' => 'Role deleted successfully']);
    }
}
