@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="row g-0">
                    <div class="col-md-6">
                        <img src="{{ asset('storage/mugs/' . basename($mug->image)) }}" 
                             class="img-fluid rounded-start h-100 w-100 object-fit-cover" 
                             alt="{{ $mug->name }}"
                             style="max-height: 400px;">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body p-4">
                            <h1 class="card-title h2 mb-3">{{ $mug->name }}</h1>
                            <p class="card-text text-muted mb-4">{{ $mug->description }}</p>
                            <p class="card-text h4 text-primary mb-4">
                                ${{ number_format($mug->price, 2) }}
                            </p>
                            
                            <form action="{{ route('cart.add', $mug) }}" method="POST" class="mb-4">
                                @csrf
                                <div class="d-flex gap-2">
                                    <input type="number" 
                                           name="quantity" 
                                           class="form-control" 
                                           value="1" 
                                           min="1" 
                                           max="10"
                                           style="width: 80px;">
                                    <button type="submit" class="btn btn-primary flex-grow-1">
                                        Add to Cart
                                    </button>
                                </div>
                            </form>

                            <a href="{{ route('mugs.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back to Mugs
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border: none;
        transition: transform 0.2s;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .btn-primary {
        padding: 10px 20px;
    }
    input[type="number"] {
        text-align: center;
        font-size: 1.1em;
    }
</style>
@endsection 