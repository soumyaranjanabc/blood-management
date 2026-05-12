@extends('layouts.app')
@section('content')
<div class="text-center py-5">
    <div style="font-size:5rem;">🔍</div>
    <h1 class="display-4 fw-bold text-danger">404</h1>
    <h4 class="text-muted">Page Not Found</h4>
    <p class="text-muted">The page you are looking for doesn't exist.</p>
    <a href="{{ url('/home') }}" class="btn btn-danger mt-3">
        <i class="bi bi-house-fill me-1"></i> Go to Dashboard
    </a>
</div>
@endsection
