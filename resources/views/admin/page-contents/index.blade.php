@extends('layouts.app')
@section('title', 'Page Contents')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Page Contents</h2>
    @can('page_contents.create')
    <a href="{{ route('admin.page-contents.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Add New
    </a>
    @endcan
</div>
<div class="card">
    <div class="card-body">
        <table id="pageContentsTable" class="table table-striped table-hover w-100">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Key</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('#pageContentsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.page-contents.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'key_badge', name: 'key' },
                { data: 'title', name: 'title' },
                { data: 'description', name: 'description' },
                { data: 'status', name: 'status', orderable: false, searchable: false },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ]
        });
    });

    function deleteContent(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/page-contents/${id}`,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Toastr.success(response.message);
                        $('#pageContentsTable').DataTable().ajax.reload();
                    },
                    error: function(xhr) {
                        Toastr.error('Error deleting content');
                    }
                });
            }
        });
    }

    function toggleStatus(id, checkbox) {
        $.ajax({
            url: `/admin/page-contents/${id}/toggle-status`,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                Toastr.success(response.message);
            },
            error: function(xhr) {
                Toastr.error('Error updating status');
                checkbox.checked = !checkbox.checked;
            }
        });
    }
</script>
@endpush
