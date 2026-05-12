@extends('layouts.app')
@section('content')
<div class="card shadow-sm" style="max-width:450px;margin:auto;">
    <div class="card-header bg-white fw-bold">
        <i class="bi bi-pencil text-danger"></i> Update Inventory — {{ $bloodInventory->blood_group }}
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.inventory.update', $bloodInventory) }}">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label fw-bold">Units Available</label>
                <input type="number" name="units_available" class="form-control"
                       value="{{ old('units_available', $bloodInventory->units_available) }}" min="0" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Units Reserved</label>
                <input type="number" name="units_reserved" class="form-control"
                       value="{{ old('units_reserved', $bloodInventory->units_reserved) }}" min="0" required>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-danger">Update</button>
                <a href="{{ route('admin.inventory') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
