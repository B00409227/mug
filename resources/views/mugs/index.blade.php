@extends('layouts.app')

@section('content')
<div class="container">
    {{-- Header Section --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Mug Shop</h1>
        <a href="{{ route('mugs.index') }}" class="text-decoration-none">Browse Mugs</a>
    </div>

    {{-- Search Bar Section --}}
    <div class="row mb-4">
        <div class="col-12">
            <form action="{{ route('mugs.index') }}" method="GET" class="d-flex gap-2">
                <input type="text" 
                       name="search" 
                       class="form-control"
                       placeholder="Search mugs..."
                       value="{{ request('search') }}">
                
                <select name="sort" class="form-select" style="width: 150px;">
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                    <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                </select>

                <button type="submit" class="btn btn-primary">
                    Search
                </button>
            </form>
        </div>
    </div>

    {{-- Mugs Grid --}}
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        @foreach($mugs as $mug)
            <div class="col">
                <div class="card h-100 product-card">
                    <div class="img-container">
                        <img src="{{ asset('storage/mugs/' . basename($mug->image)) }}" 
                             alt="{{ $mug->name }}" 
                             class="card-img-top">
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $mug->name }}</h5>
                        <p class="card-text text-primary fw-bold">${{ number_format($mug->price, 2) }}</p>
                        <a href="{{ route('mugs.show', $mug) }}" 
                           class="btn btn-outline-primary mt-auto">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    @if($mugs->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $mugs->appends(request()->query())->links() }}
        </div>
    @endif
</div>

<style>
.product-card {
    border: 1px solid #dee2e6;
    transition: all 0.3s ease;
    overflow: hidden;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.img-container {
    height: 250px;
    padding: 20px;
    background: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
}

.card-img-top {
    max-height: 100%;
    width: auto;
    max-width: 100%;
    object-fit: contain;
    transition: transform 0.3s ease;
}

.product-card:hover .card-img-top {
    transform: scale(1.05);
}

.card-title {
    font-size: 1.1rem;
    margin-bottom: 0.5rem;
    color: #333;
}

.card-text {
    font-size: 1.2rem;
    color: #0d6efd !important;
}

.btn-outline-primary {
    border-width: 2px;
    font-weight: 500;
}

.btn-outline-primary:hover {
    background-color: #0d6efd;
    color: white;
    transform: translateY(-2px);
}
</style>
@endsection 