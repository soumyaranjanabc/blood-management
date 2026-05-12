@extends('layouts.app')
@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white fw-bold">
        <i class="bi bi-droplet-half text-danger"></i> Blood Inventory Management
    </div>
    <div class="card-body">
        <div class="row g-4">
            @foreach($inventory as $item)
            <div class="col-md-3 col-6">
                <div class="border rounded p-3 text-center shadow-sm">
                    <div class="blood-badge mb-2">{{ $item->blood_group }}</div>
                    <div class="fs-4 fw-bold text-danger">{{ $item->units_available }}</div>
                    <div class="text-muted small mb-1">Available Units</div>
                    <div class="text-muted small">Reserved: {{ $item->units_reserved }}</div>
                    <div class="progress my-2" style="height:6px;">
                        @php $pct = min(100, ($item->units_available / max(1, $item->units_available + $item->units_reserved)) * 100); @endphp
                        <div class="progress-bar bg-danger" style="width:{{ $pct }}%"></div>
                    </div>
                    <a href="{{ route('admin.inventory.edit', $item) }}" class="btn btn-sm btn-outline-danger mt-1">
                        <i class="bi bi-pencil"></i> Update
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
