@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Admin Dashboard</h1>
    
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text display-4">{{ $totalUsers }}</p>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Manage Users</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Total Merchants</h5>
                    <p class="card-text display-4">{{ $totalMerchants }}</p>
                    <a href="{{ route('admin.merchants.index') }}" class="btn btn-primary">Manage Merchants</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Total Mugs</h5>
                    <p class="card-text display-4">{{ $totalMugs }}</p>
                    <a href="{{ route('admin.mugs.index') }}" class="btn btn-primary">Manage Mugs</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 