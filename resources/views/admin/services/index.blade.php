@extends('layouts.app')

@section('title', 'Services')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Services</h2>
    <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Add New Service
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table id="servicesTable" class="table table-striped table-hover w-100">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Short Description</th>
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
        $('#servicesTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.services.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'title', name: 'title' },
                { data: 'short_description', name: 'short_description' },
                { data: 'status', name: 'status', orderable: false, searchable: false },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ]
        });
    });

    function toggleStatus(id, checkbox) {
        $.post("{{ url('admin/services') }}/" + id + "/toggle-status", {
            _token: "{{ csrf_token() }}"
        }, function(response) {
            if(response.success){
                toastr.success(response.message);
            } else {
                toastr.error('Something went wrong');
                checkbox.checked = !checkbox.checked;
            }
        }).fail(function() {
            toastr.error('Error occurred');
            checkbox.checked = !checkbox.checked;
        });
    }

    function deleteService(id) {
        if (confirm('Are you sure you want to delete this service?')) {
            $.ajax({
                url: "{{ url('admin/services') }}/" + id,
                type: 'DELETE',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                        $('#servicesTable').DataTable().ajax.reload();
                    } else {
                        toastr.error('Something went wrong');
                    }
                },
                error: function() {
                    toastr.error('Error occurred');
                }
            });
        }
    }
</script>
@endpush
