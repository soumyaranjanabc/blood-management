@extends('layouts.app')
@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white fw-bold">
        <i class="bi bi-droplet-half text-danger"></i> Blood Availability
    </div>
    <div class="card-body">
        <div class="row g-4">
            @foreach($inventory as $item)
            <div class="col-md-3 col-6">
                <div class="border rounded p-3 text-center shadow-sm">
                    <div class="blood-badge mb-2">{{ $item->blood_group }}</div>
                    <div class="fs-4 fw-bold {{ $item->units_available < 10 ? 'text-danger' : 'text-success' }}">
                        {{ $item->units_available }}
                    </div>
                    <div class="text-muted small">units available</div>
                    @if($item->units_available < 10)
                        <span class="badge bg-danger mt-1">Low Stock</span>
                    @else
                        <span class="badge bg-success mt-1">Available</span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
