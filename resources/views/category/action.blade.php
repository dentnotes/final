<div class="btn-group">
    <!-- Display "Retrieve" button if show_deleted parameter is set -->
    <!-- <a href="#" class="btn btn-sm btn-success" title="Retrieve">
        <span class="bi bi-eye"></span>
    </a> -->

    <!-- Display "Edit" button if current route is user.index and show_deleted parameter is not set
         or if current route is user.view -->
    <a href="{{ route('category.edit', $value->id) }}" class="btn btn-sm btn-warning" title="Edit">
        <span class="bi bi-pencil"></span> <!-- Bootstrap pencil icon -->
    </a>

    <button type="button" class="btn btn-sm btn-danger" title="Delete"
            onclick="confirmDelete('{{ $value->id }}')">
        <span class="bi bi-trash"></span> <!-- Bootstrap trash icon -->
    </button>
</div>
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Create a form dynamically
                let form = document.createElement('form');
                form.action = '/categories/'+ id + '/destroy';
                form.method = 'POST'; // Use POST method for delete to comply with RESTful conventions
                form.innerHTML = '<input type="hidden" name="_method" value="POST">' +
                    '<input type="hidden" name="_token" value="{{ csrf_token() }}">';

                document.body.appendChild(form);

                // Submit the form
                form.submit();
            }
        });
    }
</script>

