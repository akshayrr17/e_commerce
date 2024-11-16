<!-- resources/views/dashboard.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{URL::to('dashboard')}}">Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ url('dashboard')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index')}}">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('categories.index')}}">Category</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('logout')}}" class="btn btn-outline-danger nav-link"><i>Logout</i></a>

                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h4>Welcome to your Dashboard, {{ auth()->user()->name }}!</h4>
                    </div>
                    <div class="card-body">
                        <p>Here is your dashboard where you can manage your application.</p>
                        <hr>


                        <h5>User Info</h5>
                        <ul>
                            <li><strong>Email:</strong> {{ auth()->user()->email }}</li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>

</body>
</html>
