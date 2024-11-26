@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Manage Merchants</h2>
        <a href="{{ route('admin.merchants.create') }}" class="btn btn-primary">Add New Merchant</a>
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created At</th>
                            <th>Total Mugs</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($merchants as $merchant)
                            <tr>
                                <td>{{ $merchant->name }}</td>
                                <td>{{ $merchant->email }}</td>
                                <td>{{ $merchant->created_at->format('M d, Y') }}</td>
                                <td>{{ $merchant->mugs->count() }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.merchants.edit', $merchant) }}" 
                                           class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('admin.merchants.destroy', $merchant) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('Are you sure? This will also delete all associated mugs.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $merchants->links() }}
        </div>
    </div>
</div>
@endsection 