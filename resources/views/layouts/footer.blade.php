<footer class="bg-dark text-white py-5 mt-5">
    <div class="container">
        <div class="row">
            <!-- Company Info -->
            <div class="col-md-4 mb-4">
                <h5 class="mb-3">Mug Shop</h5>
                <p class="mb-3">Your one-stop shop for unique and quality mugs.</p>
                <div class="social-links">
                    <a href="#" class="text-white me-3">
                        <i class="fab fa-facebook fa-lg"></i>
                    </a>
                    <a href="#" class="text-white me-3">
                        <i class="fab fa-instagram fa-lg"></i>
                    </a>
                    <a href="#" class="text-white">
                        <i class="fab fa-twitter fa-lg"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-md-4 mb-4">
                <h5 class="mb-3">Quick Links</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ route('login') }}" class="text-white text-decoration-none">Login</a></li>
                    <li class="mb-2"><a href="{{ route('register') }}" class="text-white text-decoration-none">Register</a></li>
                    <li class="mb-2"><a href="{{ route('mugs.index') }}" class="text-white text-decoration-none">Shop</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="col-md-4 mb-4">
                <h5 class="mb-3">Contact Us</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="mailto:support@mugshop.com" class="text-white text-decoration-none">
                            <i class="fas fa-envelope me-2"></i>support@mugshop.com
                        </a>
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-phone me-2"></i>(555) 123-4567
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-map-marker-alt me-2"></i>123 Mug Street, Coffee City
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="border-top border-secondary mt-4">
        <div class="container">
            <div class="text-center pt-4">
                <small>&copy; {{ date('Y') }} Mug Shop. All rights reserved.</small>
            </div>
        </div>
    </div>
</footer> 