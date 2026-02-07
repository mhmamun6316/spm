@extends('layouts.app')

@section('title', 'Role Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Role Management</h2>
    @can('roles.create')
    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Add New
    </a>
    @endcan
</div>

<div class="card">
    <div class="card-body">
        <table id="rolesTable" class="table table-striped table-hover w-100">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Permissions</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- DataTables will populate this -->
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#rolesTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.roles.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                { data: 'permissions', name: 'permissions', searchable: false },
                { data: 'created_at', name: 'created_at' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
            order: [[3, 'desc']]
        });
    });

    <x-sweet-alert
        name="deleteRole"
        url="admin/roles"
        tableId="rolesTable"
    />
</script>
@endpush
