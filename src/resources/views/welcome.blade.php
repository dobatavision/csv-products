<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CSV Products</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Bootstrap CSS -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /*! tailwindcss v4.0.7 | MIT License | https://tailwindcss.com */
                @layer theme {
                    /* Tailwind CSS styles */
                }
            </style>
        @endif
    </head>
    <body class="bg-light text-dark p-6 lg:p-8">
        <header class="w-100 lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
            <h1 class="text-center">Root Panel</h1>
            <nav class="navbar navbar-light bg-light justify-content-center">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="https://img.icons8.com/ios-filled/50/000000/home.png" width="30" height="30" class="d-inline-block align-top" alt="Home">
                    Home
                </a>
            </nav>
        </header>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="mb-1 font-medium">Users</h1>
                        </div>
                        <div class="card-body">
                            <ul class="list-group mb-4 lg:mb-6">
                                @foreach ($users as $user)
                                    <li class="list-group-item d-flex justify-content-between align-items-center {{ isset($userId) && $user->id == $userId ? 'bg-success text-white' : '' }}">
                                        <div>
                                            <h2 class="font-semibold">{{ $user->name }}</h2>
                                            <p>{{ $user->email }}</p>
                                        </div>
                                        <a href="{{ route('user.products', $user->id) }}" class="btn btn-primary">List</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    @isset($products)
                        <div class="card">
                            <div class="card-header">
                                <h1 class="mb-1 font-medium">Product List</h1>
                            </div>
                            <div class="card-body">
                                <ul class="list-group mb-4 lg:mb-6" style="font-size: 0.9rem;">
                                    @foreach ($products as $product)
                                        <li class="list-group-item d-flex justify-content-between align-items-center {{ $loop->even ? 'bg-white text-black' : 'bg-light text-black' }}" style="height: 70px;">
                                            <div class="d-flex flex-column justify-content-center mt-2">
                                                <h3 class="font-semibold text-black">{{ $product->name }}</h3>
                                                <p class="text-black">{{ $product->description }}</p>
                                            </div>
                                            <p class="text-black mb-0" style="font-size: 1.1rem; font-weight: bold;">${{ $product->price }}</p>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="mt-4">
                                    {{ $products->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        </div>
                    @endisset
                </div>
            </div>
        </div>

        <!-- Bootstrap JS and dependencies -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>
