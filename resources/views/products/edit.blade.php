@extends('master')

@section('content')
    <div class="container" style="margin-top: 30px;">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Edit Product</h2>
                    </div>
                    <div class="card-body">
                        <form id="product-form" enctype="multipart/form-data"
                            data-url="{{ route('products.update', $product->id) }}">
                            @csrf


                            <div class="form-group mt-2">
                                <label for="name">Product Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ old('name', $product->name) }}" required>
                            </div>

                            <div class="form-group mt-2">
                                <label for="price">Price</label>
                                <input type="number" name="price" id="price" class="form-control"
                                    value="{{ old('price', $product->price) }}" required>
                            </div>

                            <div class="form-group mt-2">
                                <label for="category_id">Category</label>
                                <select name="category_id" id="category_id" class="form-control" required>
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $category->id == old('category_id', $product->category_id) ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mt-2">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" required>{{ old('description', $product->description) }}</textarea>
                            </div>

                            <div class="form-group mt-2">
                                <label for="image">Image (Optional)</label>
                                <input type="file" name="image" id="image" class="form-control">
                                @if ($product->image)
                                    <div class="mt-2">
                                        <strong>Current Image:</strong> {{ basename($product->image) }}
                                    </div>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary mt-1">Update Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
        $(document).ready(function() {


            $('#product-form').validate({

                rules: {
                    name: {
                        required: true,
                    },
                    price: {
                        required: true,
                    },
                    description: {
                        required: true,
                    },
                    category_id: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: "Please enter a product name",
                    },
                    price: {
                        required: "Please enter a product price",
                    },
                    description: {
                        required: "Please enter a product description",
                    },
                    category_id: {
                        required: "Please select a category ",
                    },
                },

            });

            $('#product-form').on('submit', function(event) {
                event.preventDefault();

                var updateUrl = $(this).data('url');

                var formData = new FormData(this);


                formData.append('_method', 'POST');

                // alert(updateUrl)

                var csrfToken = $('meta[name="csrf-token"]').attr('content');


                $.ajax({
                    url: updateUrl,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            window.location.href = "{{ route('products.index') }}";

                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        // alert('An error occurred. Please try again later.');
                    }
                });
            });
        });
    </script>
@endsection
