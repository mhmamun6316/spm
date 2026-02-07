@extends('layouts.app')

@section('title', __('common.role_management'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">{{ __('common.role_management') }}</h2>
    @can('roles.create')
    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>{{ __('common.add_new') }}
    </a>
    @endcan
</div>

<div class="card">
    <div class="card-body">
        <table id="rolesTable" class="table table-striped table-hover w-100">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('common.name') }}</th>
                    <th>{{ __('common.permissions') }}</th>
                    <th>{{ __('common.created_at') }}</th>
                    <th>{{ __('common.actions') }}</th>
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

    function deleteRole(roleId) {
        Swal.fire({
            title: '{{ __('common.are_you_sure') }}',
            text: "{{ __('common.delete_warning') }}",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: '{{ __('common.yes_delete') }}'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/roles/' + roleId,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#rolesTable').DataTable().ajax.reload();
                        Swal.fire('{{ __('common.deleted') }}', response.message, 'success');
                    },
                    error: function(xhr) {
                        Swal.fire('{{ __('common.error') }}', xhr.responseJSON.message || '{{ __('common.delete_failed') }}', 'error');
                    }
                });
            }
        });
    }
</script>
@endpush
