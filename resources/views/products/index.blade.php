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
                <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm">
                    Add Product
                </a>
            </div>
        </div>

        <!-- Products Table -->
        <div class="row mt-2">
            <div class="col-lg-12">

                <table class="table table-hover">
                    <thead class="table-secondary">
                        <tr>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th width="20%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category ? $product->category->name : 'None' }}</td>
                                <td>${{ number_format($product->price, 2) }}</td>
                                <td>
                                    @if ($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                            width="100">
                                    @else
                                        <span>No Image</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('products.edit', $product->id) }}"
                                        class="btn btn-info btn-sm">Edit</a>
                                    <button class="btn btn-danger btn-sm delete-btn"
                                        data-url="{{ route('products.delete', $product->id) }}">Delete</button>
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

                console.log(deleteUrl)

                if (confirm('Are you sure you want to delete this product?')) {
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
                        error: function() {
                            alert('There was an error deleting the product.');
                        }
                    });
                }
            });
        });
    </script>
@endsection
