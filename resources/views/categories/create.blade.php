@extends('master')

@section('content')
    <div class="container" style="margin-top: 30px;">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-12">
                                <h2>Category Form</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <form id="category-form">
                            @csrf
                            <div class="form-group">
                                <label for="name">Category Name</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="parent_id">Parent Category</label>
                                <select name="parent_id" id="parent_id" class="form-control">
                                    <option value="">None</option>

                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary mt-1">Create Category</button>
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

                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: '{{ route('categories.store') }}',
                    method: 'POST',
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {

                        if (response.success) {
                            alert(response.message);
                            window.location.href = "{{ route('categories.index') }}";

                        }
                    },
                    error: function() {
                        alert(response.message);

                    }
                });
            });
        });
    </script>
@endsection
