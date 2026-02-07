@extends('layouts.app')

@section('title', 'Global Partners')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Global Partners</h2>
    <a href="{{ route('admin.global-partners.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Add New
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table id="partnersTable" class="table table-striped table-hover w-100">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Name</th>
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
        $('#partnersTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.global-partners.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'image', name: 'image', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                { data: 'status', name: 'status', orderable: false, searchable: false },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ]
        });
    });

    function toggleStatus(id, checkbox) {
        $.post("{{ url('admin/global-partners') }}/" + id + "/toggle-status", {
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
        name="deletePartner"
        url="admin/global-partners"
        tableId="partnersTable"
    />
</script>
@endpush
