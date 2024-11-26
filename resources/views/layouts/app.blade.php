<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Mug Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            margin: 0;
        }

        main {
            flex: 1 0 auto; /* This makes the main content area expand */
        }

        footer {
            flex-shrink: 0; /* Prevents the footer from shrinking */
            background-color: #212529;
            color: white;
            padding: 2rem 0;
            margin-top: auto; /* Pushes footer to bottom */
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                Mug Shop
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('mugs.index') }}">Browse Mugs</a>
                    </li>
                    @if(auth()->check())
                        @if(auth()->user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                            </li>
                        @elseif(auth()->user()->isMerchant())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('merchant.dashboard') }}">Merchant Dashboard</a>
                            </li>
                        @else
                            {{-- Show user navigation --}}
                        @endif
                    @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    Profile Settings
                                </a>
                                <a class="dropdown-item" href="{{ route('cart.index') }}">
                                    Cart
                                </a>
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="mb-5">
        <div class="container mt-4">
            @yield('content')
        </div>
    </main>

    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row g-4">
                <!-- Brand Section -->
                <div class="col-md-4">
                    <h5 class="mb-3">Mug Shop</h5>
                    <p class="text-muted small">Your one-stop shop for unique mugs</p>
                </div>

                <!-- Quick Links -->
                <div class="col-md-4">
                    <h5 class="mb-3">Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ url('/') }}" class="text-decoration-none text-muted">Home</a></li>
                        <li class="mb-2"><a href="{{ url('/') }}" class="text-decoration-none text-muted">Shop</a></li>
                        <li class="mb-2"><a href="{{ url('/') }}" class="text-decoration-none text-muted">Contact</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="col-md-4">
                    <h5 class="mb-3">Contact</h5>
                    <p class="text-muted small mb-1"><i class="far fa-envelope me-2"></i>support@mugshop.com</p>
                    <p class="text-muted small"><i class="fas fa-map-marker-alt me-2"></i>123 Mug Street, Coffee City</p>
                </div>
            </div>

            <!-- Copyright -->
            <div class="text-center text-muted small pt-4 mt-4 border-top border-secondary">
                &copy; {{ date('Y') }} Mug Shop. All rights reserved.
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    @if(session('checkout-success'))
    <script>
        Swal.fire({
            title: 'Order Confirmed!',
            text: "{{ session('checkout-success') }}",
            icon: 'success',
            confirmButtonText: 'Continue Shopping',
            confirmButtonColor: '#28a745'
        });
    </script>
    @endif
</body>
</html>
