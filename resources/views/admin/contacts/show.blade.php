@extends('layouts.app')

@section('title', 'Contact Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Contact Details</h2>
    <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-2"></i>Back to List
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <h5 class="text-muted mb-3">Contact Information</h5>
                <table class="table table-borderless">
                    <tr>
                        <th width="150">Name:</th>
                        <td>{{ $contact->name }}</td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></td>
                    </tr>
                    <tr>
                        <th>Phone:</th>
                        <td><a href="tel:{{ $contact->phone }}">{{ $contact->phone }}</a></td>
                    </tr>
                    <tr>
                        <th>Company:</th>
                        <td>{{ $contact->company_name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Status:</th>
                        <td>
                            @if($contact->is_read)
                                <span class="badge bg-success">Read</span>
                            @else
                                <span class="badge bg-warning">Unread</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Date:</th>
                        <td>{{ $contact->created_at->format('F d, Y h:i A') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        @if($contact->message)
        <div class="mb-4">
            <h5 class="text-muted mb-3">Message</h5>
            <div class="p-3 bg-light rounded">
                <p class="mb-0">{{ $contact->message }}</p>
            </div>
        </div>
        @endif

        <div class="mt-4">
            <form action="{{ route('admin.contacts.toggle-read', $contact->id) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-sm btn-{{ $contact->is_read ? 'warning' : 'success' }}">
                    Mark as {{ $contact->is_read ? 'Unread' : 'Read' }}
                </button>
            </form>
            <button class="btn btn-sm btn-danger" onclick="deleteContact({{ $contact->id }})">
                <i class="bi bi-trash me-1"></i>Delete
            </button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function deleteContact(id) {
        if (confirm('Are you sure you want to delete this contact?')) {
            $.ajax({
                url: "{{ url('admin/contacts') }}/" + id,
                type: 'DELETE',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    window.location.href = "{{ route('admin.contacts.index') }}";
                },
                error: function() {
                    alert('Error deleting contact');
                }
            });
        }
    }
</script>
@endpush

