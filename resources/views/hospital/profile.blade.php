@extends('layouts.app')
@section('content')
<div class="card shadow-sm" style="max-width:600px;margin:auto;">
    <div class="card-header bg-white fw-bold">
        <i class="bi bi-hospital-fill text-danger"></i> Hospital Profile
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('hospital.profile.update') }}">
            @csrf
            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label fw-bold">Hospital Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $hospital->name ?? $user->name) }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">License Number</label>
                    <input type="text" name="license_number" class="form-control" value="{{ old('license_number', $hospital->license_number ?? '') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $hospital->phone ?? $user->phone) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">City</label>
                    <input type="text" name="city" class="form-control" value="{{ old('city', $hospital->city ?? '') }}" required>
                </div>
                <div class="col-12">
                    <label class="form-label fw-bold">Address</label>
                    <textarea name="address" class="form-control" rows="2" required>{{ old('address', $hospital->address ?? '') }}</textarea>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-danger px-4">Save Profile</button>
            </div>
        </form>
    </div>
</div>
@endsection
