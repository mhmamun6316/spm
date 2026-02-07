@extends('layouts.app')

@section('title', __('common.user_management'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">{{ __('common.user_management') }}</h2>
    @can('users.create')
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>{{ __('common.add_new') }}
    </a>
    @endcan
</div>

<div class="card">
    <div class="card-body">
        <table id="usersTable" class="table table-striped table-hover w-100">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('common.profile_photo') }}</th>
                    <th>{{ __('common.name') }}</th>
                    <th>{{ __('common.email') }}</th>
                    <th>{{ __('common.approval_status') }}</th>
                    <th>{{ __('common.status') }}</th>
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
            url: '/users/' + userId + '/toggle-status',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                toastr.success(response.message);
            },
            error: function(xhr) {
                checkbox.checked = !checkbox.checked;
                toastr.error('{{ __('common.error') }}');
            }
        });
    }

    function deleteUser(userId) {
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
                    url: '/users/' + userId,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#usersTable').DataTable().ajax.reload();
                        Swal.fire('{{ __('common.deleted') }}', '{{ __('common.user_deleted') }}', 'success');
                    },
                    error: function(xhr) {
                        Swal.fire('{{ __('common.error') }}', '{{ __('common.delete_failed') }}', 'error');
                    }
                });
            }
        });
    }
</script>
@endpush

