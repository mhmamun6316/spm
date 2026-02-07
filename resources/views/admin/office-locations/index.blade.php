@extends('layouts.app')

@section('title', 'Footer Offices')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Footer Office Locations</h2>
    <a href="{{ route('admin.office-locations.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-2"></i>Add New Office
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-striped" id="locationsTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Office Name</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<x-sweet-alert />
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        var table = $('#locationsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.office-locations.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'name', name: 'name'},
                {data: 'address', name: 'address'},
                {data: 'email', name: 'email'},
                {data: 'is_active', name: 'is_active'},
                {data: 'actions', name: 'actions', orderable: false, searchable: false},
            ]
        });

        // Toggle Status
        $(document).on('change', '.toggle-status', function() {
            var id = $(this).data('id');
            var url = "{{ url('admin/office-locations') }}/" + id + "/toggle-status";
            
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    toastr.success(response.success);
                    table.ajax.reload(null, false);
                },
                error: function(xhr) {
                    toastr.error('Something went wrong.');
                }
            });
        });

        // Delete Location
        window.deleteLocation = function(id) {
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
                        url: "{{ url('admin/office-locations') }}/" + id,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                response.success,
                                'success'
                            );
                            table.ajax.reload(null, false);
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Error!',
                                'Something went wrong.',
                                'error'
                            );
                        }
                    });
                }
            })
        }
    });
</script>
@endpush
