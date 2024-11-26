@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Shopping Cart</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(count($cart) > 0)
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0 @endphp
                        @foreach($cart as $id => $details)
                            @php $total += $details['price'] * $details['quantity'] @endphp
                            <tr>
                                <td>
                                    <img src="{{ asset($details['image']) }}" alt="{{ $details['name'] }}" width="50">
                                    {{ $details['name'] }}
                                </td>
                                <td>{{ $details['quantity'] }}</td>
                                <td>${{ number_format($details['price'], 2) }}</td>
                                <td>${{ number_format($details['price'] * $details['quantity'], 2) }}</td>
                                <td>
                                    <form action="{{ route('cart.remove', $id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i> Remove
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end"><strong>Total:</strong></td>
                            <td><strong>${{ number_format($total, 2) }}</strong></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>

                <div class="mt-4">
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('mugs.index') }}" class="btn btn-secondary">Continue Shopping</a>
                        <form action="{{ route('cart.checkout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success">
                                Checkout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-info">
            Your cart is empty! 
            <a href="{{ route('mugs.index') }}" class="alert-link">Continue Shopping</a>
        </div>
    @endif
</div>

<style>
    .table img {
        border-radius: 4px;
    }
    .btn-success {
        padding-left: 2rem;
        padding-right: 2rem;
    }
    .btn-danger {
        padding: 0.25rem 0.5rem;
    }
</style>
@endsection 