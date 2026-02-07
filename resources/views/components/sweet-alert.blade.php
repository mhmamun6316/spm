@props([
    'name',
    'url',
    'suffix' => '',
    'method' => 'DELETE',
    'title' => 'Are you sure?',
    'text' => "You won't be able to revert this!",
    'icon' => 'warning',
    'confirmButtonText' => 'Yes, delete it!',
    'confirmButtonColor' => '#d33',
    'successTitle' => 'Success',
    'successMessage' => '',
    'tableId' => null
])

    function {{ $name }}(id) {
        Swal.fire({
            title: '{{ $title }}',
            text: "{{ $text }}",
            icon: '{{ $icon }}',
            showCancelButton: true,
            confirmButtonColor: '{{ $confirmButtonColor }}',
            cancelButtonColor: '#3085d6',
            confirmButtonText: '{{ $confirmButtonText }}'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/{{ trim($url, '/') }}/' + id + '{{ $suffix }}',
                    method: '{{ $method }}',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        @if($tableId)
                            $('#{{ $tableId }}').DataTable().ajax.reload();
                        @else
                            location.reload();
                        @endif

                        Swal.fire(
                            '{{ $successTitle }}',
                            response.message || '{{ $successMessage }}',
                            'success'
                        );
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Error',
                            xhr.responseJSON?.message || 'Action failed',
                            'error'
                        );
                    }
                });
            }
        });
    }

