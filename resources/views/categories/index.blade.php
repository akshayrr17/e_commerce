@extends('master')

@section('content')

    <div class="container">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row mt-2">
            <div class="col-lg-12">
                <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm">
                    Add Category
                </a>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-lg-12">
                <table class="table table-hover">
                    <thead class="table-secondary">
                        <tr>
                            <th>Name</th>
                            <th>Category</th>
                            <th width="20%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->parent ? $category->parent->name : 'None' }}</td>
                                <td>
                                    <a href="{{ route('categories.edit', $category->id) }}"
                                        class="btn btn-info btn-sm edit-btn">Edit</a>
                                    <button class="btn btn-danger btn-sm delete-btn"
                                    data-url="{{ route('categories.delete', $category->id) }}">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {

            $('.delete-btn').click(function() {
                var deleteUrl = $(this).data('url');


                if (confirm('Are you sure you want to delete this category?')) {
                    $.ajax({
                        url: deleteUrl,
                        method: 'GET',
                        data: {
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            if (response.success) {
                                alert(response.message);
                                window.location.reload();
                            }
                        },
                        error: function(xhr, status, error) {
                            alert('There was an error deleting the category.');
                        }
                    });
                }
            });




        });
    </script>

@endsection
