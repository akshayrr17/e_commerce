@extends('master')

@section('content')
    <div class="container" style="margin-top: 30px;">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-12">
                                <h2>Edit Category</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- <form action="{{ route('categories.update', $category->id) }}" method="POST"> --}}
                        <form id="category-form" data-url="{{ route('categories.update', $category->id) }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Category Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ old('name', $category->name) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="parent_id">Parent Category</label>
                                <select name="parent_id" id="parent_id" class="form-control">
                                    <option value="">None</option>

                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}"
                                            {{ $cat->id == $category->parent_id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary mt-1">Update Category</button>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {

            $('#category-form').validate({

                rules: {
                    name: {
                        required: true,
                    }
                },
                messages: {
                    name: {
                        required: "Please enter a category name",
                    }
                },

            });

            $('#category-form').on('submit', function(event) {
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
                            window.location.href = "{{ route('categories.index') }}";

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
