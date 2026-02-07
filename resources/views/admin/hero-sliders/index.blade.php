@extends('layouts.app')

@section('title', 'Hero Sliders')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Hero Sliders</h2>
    @can('hero_sliders.create')
    <a href="{{ route('admin.hero-sliders.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Add New
    </a>
    @endcan
</div>

<div class="card">
    <div class="card-body">
        <table id="heroSlidersTable" class="table table-striped table-hover w-100">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Subtitle</th>
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
        $('#heroSlidersTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.hero-sliders.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'image', name: 'image', orderable: false, searchable: false },
                { data: 'title', name: 'title' },
                { data: 'subtitle', name: 'subtitle' },
                { data: 'sort_order', name: 'sort_order' },
                { data: 'status', name: 'status', orderable: false, searchable: false },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ]
        });
    });

    function toggleStatus(id, checkbox) {
        $.post("{{ url('admin/hero-sliders') }}/" + id + "/toggle-status", {
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
        name="deleteSlider"
        url="admin/hero-sliders"
        tableId="heroSlidersTable"
    />
</script>
@endpush
