@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>My Mugs</h2>
        <a href="{{ route('merchant.mugs.create') }}" class="btn btn-primary">Add New Mug</a>
    </div>

    <div class="row">
        @foreach($mugs as $mug)
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="{{ asset('storage/' . $mug->image) }}" class="card-img-top" alt="{{ $mug->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $mug->name }}</h5>
                    <p class="card-text">${{ $mug->price }}</p>
                    <p class="card-text">Stock: {{ $mug->stock }}</p>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('merchant.mugs.edit', $mug) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('merchant.mugs.destroy', $mug) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection 