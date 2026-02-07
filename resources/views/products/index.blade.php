@extends('layouts.app')

@section('title', __('common.products'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">{{ __('common.products') }}</h2>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>{{ __('common.add_new') }}
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table id="productsTable" class="table table-striped table-hover w-100">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('common.image') }}</th>
                    <th>{{ __('common.name') }}</th>
                    <th>{{ __('common.category') }}</th>
                    <th>{{ __('common.price') }}</th>
                    <th>{{ __('common.quantity') }}</th>
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
        var table = $('#productsTable').DataTable({
            processing: true,
            serverSide: true,
            scrollX: false,
            autoWidth: true,
            ajax: "{{ route('admin.products.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'image', name: 'image', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                { data: 'category', name: 'category' },
                { data: 'price', name: 'price' },
                { data: 'quantity', name: 'quantity' },
                { data: 'status', name: 'status', orderable: false, searchable: false },
                { data: 'created_at', name: 'created_at' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
            order: [[2, 'asc']]
        });
    });

    function toggleStatus(productId, element) {
        var status = element.checked;
        $.ajax({
            url: '/products/' + productId + '/toggle-status',
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

    function deleteProduct(productId) {
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
                    url: '/products/' + productId,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#productsTable').DataTable().ajax.reload();
                        Swal.fire('{{ __('common.deleted') }}', '{{ __('common.product_deleted') }}', 'success');
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
