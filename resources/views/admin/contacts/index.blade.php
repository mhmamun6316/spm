@extends('layouts.app')

@section('title', 'Contacts')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Contact Messages</h2>
</div>

<div class="card">
    <div class="card-body">
        <table id="contactsTable" class="table table-striped table-hover w-100">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Company</th>
                    <th>Status</th>
                    <th>Date</th>
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
        $('#contactsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.contacts.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'phone', name: 'phone' },
                { data: 'company_name', name: 'company_name' },
                { data: 'is_read', name: 'is_read', orderable: false, searchable: false },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            order: [[6, 'desc']]
        });
    });

    function deleteContact(id) {
        if (confirm('Are you sure you want to delete this contact?')) {
            $.ajax({
                url: "{{ url('admin/contacts') }}/" + id,
                type: 'DELETE',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    $('#contactsTable').DataTable().ajax.reload();
                    alert('Contact deleted successfully');
                },
                error: function() {
                    alert('Error deleting contact');
                }
            });
        }
    }
</script>
@endpush

