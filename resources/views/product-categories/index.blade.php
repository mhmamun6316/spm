@extends('layouts.app')

@section('title', __('common.product_categories'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">{{ __('common.product_categories') }}</h2>
    <a href="{{ route('admin.product-categories.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>{{ __('common.add_new') }}
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table id="categoriesTable" class="table table-striped table-hover w-100">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('common.name') }}</th>
                    <th>{{ __('common.description') }}</th>
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
        var table = $('#categoriesTable').DataTable({
            processing: true,
            serverSide: true,
            scrollX: false,
            autoWidth: true,
            ajax: "{{ route('admin.product-categories.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                { data: 'description', name: 'description' },
                { data: 'status', name: 'status', orderable: false, searchable: false },
                { data: 'created_at', name: 'created_at' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
            order: [[1, 'asc']]
        });
    });

    function toggleStatus(categoryId, element) {
        var status = element.checked;
        $.ajax({
            url: '/product-categories/' + categoryId + '/toggle-status',
            method: 'POST',
            data: {
                status: status,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                toastr.success(response.message || '{{ __('common.status_updated') }}');
            },
            error: function(xhr) {
                element.checked = !status;
                toastr.error('{{ __('common.error') }}');
            }
        });
    }

    function deleteCategory(categoryId) {
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
                    url: '/product-categories/' + categoryId,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#categoriesTable').DataTable().ajax.reload();
                        Swal.fire('{{ __('common.deleted') }}', '{{ __('common.category_deleted') }}', 'success');
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
