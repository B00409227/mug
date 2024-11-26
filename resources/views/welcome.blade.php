{{-- Extend the main application layout --}}
@extends('layouts.app')

@section('content')
    {{-- Hero Section: Main landing area with call-to-action --}}
    <section class="hero-gradient">
        <div class="container text-center py-5">
            <h1 class="display-4 fw-bold text-primary mb-3">Welcome to Mug Shop</h1>
            <p class="lead text-secondary mb-4">Find your perfect mug today!</p>
            <a href="{{ route('mugs.index') }}" class="btn btn-primary btn-lg px-5 rounded-pill shadow-sm">
                Browse Mugs <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </section>

    {{-- Collections Section: Display different mug categories --}}
    <section class="container py-5">
        <h2 class="text-center fw-bold text-primary mb-5">Our Collections</h2>
        <div class="row g-4">
            {{-- Classic Mugs Card --}}
            <div class="col-md-4">
                <div class="collection-card">
                    <div class="card-body text-center p-4">
                        <div class="icon-circle mb-4">
                            <i class="fas fa-coffee"></i>
                        </div>
                        <h3 class="h5 fw-bold mb-3">Classic Mugs</h3>
                        <p class="text-muted mb-3">Timeless designs for everyday use</p>
                        <p class="text-primary fw-bold">Starting at $9.99</p>
                    </div>
                </div>
            </div>

            {{-- Custom Mugs Card --}}
            <div class="col-md-4">
                <div class="collection-card">
                    <div class="card-body text-center p-4">
                        <div class="icon-circle mb-4">
                            <i class="fas fa-paint-brush"></i>
                        </div>
                        <h3 class="h5 fw-bold mb-3">Custom Mugs</h3>
                        <p class="text-muted mb-3">Personalized just for you</p>
                        <p class="text-primary fw-bold">Starting at $14.99</p>
                    </div>
                </div>
            </div>

            {{-- Premium Mugs Card --}}
            <div class="col-md-4">
                <div class="collection-card">
                    <div class="card-body text-center p-4">
                        <div class="icon-circle mb-4">
                            <i class="fas fa-gem"></i>
                        </div>
                        <h3 class="h5 fw-bold mb-3">Premium Mugs</h3>
                        <p class="text-muted mb-3">Luxury ceramic collection</p>
                        <p class="text-primary fw-bold">Starting at $19.99</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Features Section: Highlight store benefits --}}
    <section class="features-gradient py-5 mb-3">
        <div class="container">
            <div class="row text-center g-4">
                {{-- Free Shipping Feature --}}
                <div class="col-md-3">
                    <div class="feature-item">
                        <i class="fas fa-shipping-fast text-primary mb-3 fa-2x"></i>
                        <h4 class="h5 fw-bold">Free Shipping</h4>
                        <p class="text-muted">On orders over $50</p>
                    </div>
                </div>
                {{-- Quality Guarantee Feature --}}
                <div class="col-md-3">
                    <div class="feature-item">
                        <i class="fas fa-medal text-primary mb-3 fa-2x"></i>
                        <h4 class="h5 fw-bold">Quality Guarantee</h4>
                        <p class="text-muted">100% satisfaction guaranteed</p>
                    </div>
                </div>
                {{-- Secure Payment Feature --}}
                <div class="col-md-3">
                    <div class="feature-item">
                        <i class="fas fa-lock text-primary mb-3 fa-2x"></i>
                        <h4 class="h5 fw-bold">Secure Payment</h4>
                        <p class="text-muted">Safe & secure checkout</p>
                    </div>
                </div>
                {{-- Support Feature --}}
                <div class="col-md-3">
                    <div class="feature-item">
                        <i class="fas fa-headset text-primary mb-3 fa-2x"></i>
                        <h4 class="h5 fw-bold">24/7 Support</h4>
                        <p class="text-muted">Always here to help</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Spacing Section --}}
    <div class="container">
        <div class="py-2"></div>
    </div>

    {{-- Styles Section --}}
    <style>
        /* Background Gradients */
        .hero-gradient {
            background: linear-gradient(120deg, #f8f9fa 0%, #e9ecef 100%);
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        .features-gradient {
            background: linear-gradient(120deg, #f1f3f5 0%, #e9ecef 100%);
            border-top: 1px solid rgba(0,0,0,0.05);
        }

        /* Collection Card Styling */
        .collection-card {
            background: white;
            border-radius: 15px;
            border: none;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            height: 100%;
        }
        
        /* Hover effect for collection cards */
        .collection-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }

        /* Circular icons styling */
        .icon-circle {
            width: 60px;
            height: 60px;
            background: rgba(13, 110, 253, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }

        .icon-circle i {
            font-size: 24px;
            color: #0d6efd;
        }

        /* Feature items styling and animation */
        .feature-item {
            padding: 20px;
            transition: all 0.3s ease;
        }

        .feature-item:hover {
            transform: translateY(-3px);
        }

        /* Primary button styling */
        .btn-primary {
            background: #0d6efd;
            border: none;
            padding: 15px 30px;
            transition: all 0.3s ease;
        }

        /* Button hover effects */
        .btn-primary:hover {
            background: #0b5ed7;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(13, 110, 253, 0.2);
        }

        /* Text color utilities */
        .text-primary {
            color: #0d6efd !important;
        }

        .text-secondary {
            color: #6c757d !important;
        }

        /* Page load animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        section {
            animation: fadeIn 0.8s ease-out;
        }

        /* Spacing utilities */
        .mb-3 {
            margin-bottom: 1.5rem !important;
        }

        .py-2 {
            padding-top: 1rem !important;
            padding-bottom: 1rem !important;
        }

        /* Responsive spacing adjustments */
        @media (min-width: 768px) {
            .mb-3 {
                margin-bottom: 2rem !important;
            }
            
            .py-2 {
                padding-top: 1.5rem !important;
                padding-bottom: 1.5rem !important;
            }
        }
    </style>
@endsection
