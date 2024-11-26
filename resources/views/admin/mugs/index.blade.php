@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Manage Mugs</h2>
        <a href="{{ route('admin.mugs.create') }}" class="btn btn-primary">Add New Mug</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Merchant</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mugs as $mug)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/mugs/' . basename($mug->image)) }}" 
                                         alt="{{ $mug->name }}" 
                                         style="width: 50px; height: 50px; object-fit: cover;">
                                </td>
                                <td>{{ $mug->name }}</td>
                                <td>${{ number_format($mug->price, 2) }}</td>
                                <td>{{ $mug->stock }}</td>
                                <td>{{ $mug->user->name }}</td>
                                <td>
                                    <a href="{{ route('admin.mugs.edit', $mug) }}" 
                                       class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('admin.mugs.destroy', $mug) }}" 
                                          method="POST" 
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-danger" 
                                                onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    Showing {{ $mugs->firstItem() }} to {{ $mugs->lastItem() }} of {{ $mugs->total() }} results
                </div>
                <nav>
                    <ul class="pagination mb-0">
                        {{-- Previous Page Link --}}
                        @if ($mugs->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">&laquo;</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $mugs->previousPageUrl() }}" rel="prev">&laquo;</a>
                            </li>
                        @endif

                        {{-- Next Page Link --}}
                        @if ($mugs->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $mugs->nextPageUrl() }}" rel="next">&raquo;</a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">&raquo;</span>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<style>
.pagination {
    margin: 0;
    padding: 0;
}
.page-link {
    padding: 0.5rem 0.75rem;
    margin: 0 0.25rem;
    border-radius: 4px;
}
</style>
@endsection 