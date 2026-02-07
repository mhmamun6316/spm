@extends('layouts.app')

@section('title', 'User Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">User Management</h2>
    @can('users.create')
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Add New
    </a>
    @endcan
</div>

<div class="card">
    <div class="card-body">
        <table id="usersTable" class="table table-striped table-hover w-100">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Profile Photo</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Approval Status</th>
                    <th>Status</th>
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
        var table = $('#usersTable').DataTable({
            processing: true,
            serverSide: true,
            scrollX: false,
            autoWidth: true,
            ajax: "{{ route('admin.users.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'profile_photo', name: 'profile_photo', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'approval_status', name: 'approval_status', orderable: false, searchable: false },
                { data: 'status', name: 'status', orderable: false, searchable: false },
                { data: 'created_at', name: 'created_at' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
            order: [[7, 'desc']]
        });
    });

    function toggleStatus(userId, checkbox) {
        $.ajax({
            url: '/admin/users/' + userId + '/toggle-status',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                toastr.success(response.message);
            },
            error: function(xhr) {
                checkbox.checked = !checkbox.checked;
                toastr.error('Error updating status');
            }
        });
    }

    <x-sweet-alert
        name="deleteUser"
        url="admin/users"
        method="DELETE"
        title="Are you sure?"
        text="You won't be able to revert this!"
        icon="warning"
        confirmButtonText="Yes, delete it!"
        tableId="usersTable"
    />

    <x-sweet-alert
        name="approveUser"
        url="admin/users"
        suffix="/approve"
        method="POST"
        title="Are you sure?"
        text="Approve this user?"
        icon="info"
        confirmButtonText="Yes, Approve"
        confirmButtonColor="#28a745"
        tableId="usersTable"
    />

    <x-sweet-alert
        name="rejectUser"
        url="admin/users"
        suffix="/reject"
        method="POST"
        title="Are you sure?"
        text="Reject this user?"
        icon="warning"
        confirmButtonText="Yes, Reject"
        confirmButtonColor="#dc3545"
        tableId="usersTable"
    />
</script>
@endpush

