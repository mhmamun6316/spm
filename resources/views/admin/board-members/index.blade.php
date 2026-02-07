@extends('layouts.app')

@section('title', 'Board of Directors')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Board of Directors</h2>
    <a href="{{ route('admin.board-members.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Add New
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table id="boardMembersTable" class="table table-striped table-hover w-100">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Position</th>
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
        $('#boardMembersTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.board-members.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'image', name: 'image', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                { data: 'position', name: 'position' },
                { data: 'status', name: 'status', orderable: false, searchable: false },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ]
        });
    });

    function toggleStatus(id, checkbox) {
        $.post("{{ url('admin/board-members') }}/" + id + "/toggle-status", {
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
        name="deleteMember"
        url="admin/board-members"
        tableId="boardMembersTable"
    />
</script>
@endpush
