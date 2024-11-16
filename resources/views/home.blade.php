<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>

    .product-card img {
        height: 100%;
        object-fit:fill;
        width: 100%;
    }


    .card {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .card-body {
        flex-grow: 1;
    }
</style>


</head>

<body style="background-color:beige;">

    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <div class="container">
            <a class="navbar-brand" href="{{ URL::to('/') }}">E-commerce</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('categories.index') }}">Category</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



    <div class="container mt-4">
        <h2 class="text-center mb-4">Featured Products</h2>

        <div class="row">

            <div class="col-lg-8">
                <div class="text-center mb-4">

                    <div class="row">
                        <div class="col-md-6">
                            <input type="range" class="form-range" id="price-min-slider" min="0" max="2000"
                                step="1" value="0">
                            <p id="price-min-display" class="text-center mt-2">Min Price: $0</p>
                        </div>
                        <div class="col-md-6">
                            <input type="range" class="form-range" id="price-max-slider" min="0" max="2000"
                                step="1" value="2000">
                            <p id="price-max-display" class="text-center mt-2">Max Price: $2000</p>
                        </div>
                    </div>
                    <p id="price-range-display" class="text-center mt-2">Price Range: $0 - $2000</p>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="text-center pt-2">
                    <select id="sort-products" class="form-select w-auto mx-auto">
                        <option value="name-asc">Sort by Name (A to Z)</option>
                        <option value="name-desc">Sort by Name (Z to A)</option>
                        <option value="small-name-asc">Sort by Name (a to z)</option>
                        <option value="small-name-desc">Sort by Name (z to a)</option>
                        <option value="price-asc">Sort by Price (Low to High)</option>
                        <option value="price-desc">Sort by Price (High to Low)</option>
                    </select>
                </div>
            </div>

        </div>



        @if ($products->isEmpty())
            <div class="alert alert-info text-center" role="alert">
                No products available at the moment.
            </div>
        @else
            <div class="row row-cols-1 row-cols-md-3 g-4" id="products-list">
                @foreach ($products as $product)
                    <div class="col product-card" data-name="{{ $product->name }}" data-price="{{ $product->price }}">
                        <div class="card h-100">
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top "
                                alt="{{ $product->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <hr>
                                <p class="card-text">Category:
                                    {{ $product->category ? $product->category->name : 'None' }}
                                </p>
                                <p class="card-text"> <i> ${{ number_format($product->price, 2) }} </i> </p>

                            </div>
                            <div class="card-footer text-center">
                                <a href="{{ URL::to('/') }}" class="btn btn-primary">View Product</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        <hr>


        @if ($categories->isEmpty())
            <div class="alert alert-info text-center" role="alert">
                No categories available at the moment.
            </div>
        @else
            <h2 class="text-center mt-5 mb-4">Categories</h2>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach ($categories as $category)
                    <div class="col">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $category->name }}</h5>
                                <p class="card-text">{{ $category->products->count() }} products</p>
                            </div>
                            <div class="card-footer text-center">
                                <a href="{{ URL::to('/') }}" class="btn btn-primary">View Category</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        @endif
    </div>


    <!-- Footer -->
    <footer class="bg-secondary text-white py-4 mt-5">
        <div class="container text-center">
            <p class="mb-0">&copy; 2024 E-commerce. All Rights Reserved.</p>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>


    <script>
        //sorting

        function sortProducts(criteria) {
            const productsList = document.getElementById('products-list');
            const products = Array.from(productsList.getElementsByClassName('product-card')); // Get all product cards


            products.sort(function(a, b) {
                const nameA = a.getAttribute('data-name').toLowerCase();
                const nameB = b.getAttribute('data-name').toLowerCase();
                const priceA = parseFloat(a.getAttribute('data-price'));
                const priceB = parseFloat(b.getAttribute('data-price'));

                switch (criteria) {
                    case 'name-asc':
                        return nameA < nameB ? -1 : 1;
                    case 'name-desc':
                        return nameA > nameB ? -1 : 1;
                    case 'price-asc':
                        return priceA - priceB;
                    case 'price-desc':
                        return priceB - priceA;
                    case 'small-name-asc':
                        return nameA < nameB ? -1 : 1;
                    case 'small-name-desc':
                        return nameA > nameB ? -1 : 1;
                    default:
                        return 0;
                }
            });


            productsList.innerHTML = '';
            products.forEach(function(product) {
                productsList.appendChild(product);
            });
        }

        document.getElementById('sort-products').addEventListener('change', function() {
            const sortValue = this.value;
            sortProducts(sortValue);
        });

        //slider

        const minSlider = document.getElementById('price-min-slider');
        const maxSlider = document.getElementById('price-max-slider');
        const minDisplay = document.getElementById('price-min-display');
        const maxDisplay = document.getElementById('price-max-display');
        const rangeDisplay = document.getElementById('price-range-display');


        minSlider.addEventListener('input', function() {

            if (parseInt(minSlider.value) > parseInt(maxSlider.value)) {
                minSlider.value = maxSlider.value;
            }


            minDisplay.textContent = `Min Price: $${minSlider.value}`;
            rangeDisplay.textContent = `Price Range: $${minSlider.value} - $${maxSlider.value}`;
            filterProductsByPrice(minSlider.value, maxSlider.value);
        });

        maxSlider.addEventListener('input', function() {

            if (parseInt(maxSlider.value) < parseInt(minSlider.value)) {
                maxSlider.value = minSlider.value;
            }

            maxDisplay.textContent = `Max Price: $${maxSlider.value}`;
            rangeDisplay.textContent = `Price Range: $${minSlider.value} - $${maxSlider.value}`;
            filterProductsByPrice(minSlider.value, maxSlider.value);
        });

        function filterProductsByPrice(minPrice, maxPrice) {
            const products = document.querySelectorAll('.product-card');
            products.forEach(function(product) {
                const price = parseFloat(product.getAttribute('data-price'));

                if (price >= minPrice && price <= maxPrice) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        }
        filterProductsByPrice(minSlider.value, maxSlider.value);
    </script>

</body>

</html>
