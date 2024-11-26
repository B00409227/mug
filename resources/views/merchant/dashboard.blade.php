@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>{{ __('Merchant Dashboard') }}</span>
                        <a href="{{ route('merchant.mugs.create') }}" class="btn btn-primary btn-sm">Add New Mug</a>
                    </div>
                </div>

                <div class="card-body">
                    <h2>Welcome, {{ Auth::user()->name }}</h2>
                    <p>You are logged in as a Merchant!</p>
                    
                    <h3 class="mt-4 mb-3">My Mugs</h3>
                    <div class="row">
                        @foreach($mugs as $mug)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <img src="{{ asset('storage/mugs/' . basename($mug->image)) }}" class="card-img-top" alt="{{ $mug->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $mug->name }}</h5>
                                    <p class="card-text">${{ $mug->price }}</p>
                                    <p class="card-text">Stock: {{ $mug->stock }}</p>
                                    <div class="d-flex justify-content-between mt-auto">
                                        <a href="{{ route('merchant.mugs.edit', $mug) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('merchant.mugs.destroy', $mug) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this mug?')">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 