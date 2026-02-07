@extends('layouts.app')

@section('title', 'Home Contents')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Home Contents</h2>
    @can('home_contents.create')
    <a href="{{ route('admin.home-contents.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Add New
    </a>
    @endcan
</div>

<div class="card">
    <div class="card-body">
        <table id="homeContentsTable" class="table table-striped table-hover w-100">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Type</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Position</th>
                    <th>Sort Order</th>
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
        $('#homeContentsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.home-contents.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'image', name: 'image', orderable: false, searchable: false },
                { data: 'type', name: 'type', orderable: false, searchable: false },
                { data: 'title', name: 'title' },
                { data: 'description', name: 'description', orderable: false, render: function(data) {
                    return '<div style="max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">' + data + '</div>';
                }},
                { data: 'text_position', name: 'text_position', orderable: false, searchable: false },
                { data: 'sort_order', name: 'sort_order' },
                { data: 'status', name: 'status', orderable: false, searchable: false },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ]
        });
    });

    function toggleStatus(id, checkbox) {
        $.post("{{ url('admin/home-contents') }}/" + id + "/toggle-status", {
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

    <x-sweet-alert
        name="deleteContent"
        url="admin/home-contents"
        tableId="homeContentsTable"
    />
</script>
@endpush
