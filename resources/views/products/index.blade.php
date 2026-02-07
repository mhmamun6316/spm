@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Products</h2>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Add New
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table id="productsTable" class="table table-striped table-hover w-100">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
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
        var table = $('#productsTable').DataTable({
            processing: true,
            serverSide: true,
            scrollX: false,
            autoWidth: true,
            ajax: "{{ route('admin.products.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'image', name: 'image', orderable: false, searchable: false },
                { data: 'title', name: 'title' },
                { data: 'category', name: 'category' },
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
            url: '/admin/products/' + productId + '/toggle-status',
            method: 'POST',
            data: {
                status: status,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                toastr.success(response.message || 'Status updated successfully');
            },
            error: function(xhr) {
                element.checked = !status;
                toastr.error('Error updating status');
            }
        });
    }

    function deleteProduct(productId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin/products/' + productId,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#productsTable').DataTable().ajax.reload();
                        Swal.fire('Deleted!', 'Product has been deleted.', 'success');
                    },
                    error: function(xhr) {
                        Swal.fire('Error!', 'Failed to delete product.', 'error');
                    }
                });
            }
        });
    }
</script>
@endpush
