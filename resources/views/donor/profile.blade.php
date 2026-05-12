@extends('layouts.app')
@section('content')
<div class="card shadow-sm" style="max-width:650px;margin:auto;">
    <div class="card-header bg-white fw-bold">
        <i class="bi bi-person-fill text-danger"></i> My Donor Profile
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('donor.profile.update') }}">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Full Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $donor->name ?? $user->name) }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Blood Group</label>
                    <select name="blood_group" class="form-select" required>
                        @foreach(['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $bg)
                        <option value="{{ $bg }}" {{ ($donor->blood_group ?? $user->blood_group) == $bg ? 'selected':'' }}>{{ $bg }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Age</label>
                    <input type="number" name="age" class="form-control" value="{{ old('age', $donor->age ?? '') }}" min="18" max="65" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Gender</label>
                    <select name="gender" class="form-select" required>
                        <option value="male"   {{ ($donor->gender ?? '') == 'male'   ? 'selected':'' }}>Male</option>
                        <option value="female" {{ ($donor->gender ?? '') == 'female' ? 'selected':'' }}>Female</option>
                        <option value="other"  {{ ($donor->gender ?? '') == 'other'  ? 'selected':'' }}>Other</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $donor->phone ?? $user->phone) }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">City</label>
                    <input type="text" name="city" class="form-control" value="{{ old('city', $donor->city ?? '') }}" required>
                </div>
                <div class="col-12">
                    <label class="form-label fw-bold">Address</label>
                    <textarea name="address" class="form-control" rows="2" required>{{ old('address', $donor->address ?? '') }}</textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Last Donation Date</label>
                    <input type="date" name="last_donation_date" class="form-control"
                           value="{{ old('last_donation_date', $donor && $donor->last_donation_date ? $donor->last_donation_date->format('Y-m-d') : '') }}">
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-danger px-4">Save Profile</button>
            </div>
        </form>
    </div>
</div>
@endsection
