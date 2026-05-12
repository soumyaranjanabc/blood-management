@extends('layouts.app')
@section('content')
<div class="card shadow-sm" style="max-width:650px;margin:auto;">
    <div class="card-header bg-white fw-bold">
        <i class="bi bi-pencil text-danger"></i> Edit Donor
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.donors.update', $donor) }}">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $donor->name) }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Blood Group</label>
                    <select name="blood_group" class="form-select" required>
                        @foreach(['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $bg)
                        <option value="{{ $bg }}" {{ $donor->blood_group == $bg ? 'selected' : '' }}>{{ $bg }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Age</label>
                    <input type="number" name="age" class="form-control" value="{{ old('age', $donor->age) }}" min="18" max="65" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Gender</label>
                    <select name="gender" class="form-select" required>
                        <option value="male"   {{ $donor->gender=='male'   ? 'selected':'' }}>Male</option>
                        <option value="female" {{ $donor->gender=='female' ? 'selected':'' }}>Female</option>
                        <option value="other"  {{ $donor->gender=='other'  ? 'selected':'' }}>Other</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $donor->phone) }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">City</label>
                    <input type="text" name="city" class="form-control" value="{{ old('city', $donor->city) }}" required>
                </div>
                <div class="col-md-8">
                    <label class="form-label fw-bold">Address</label>
                    <input type="text" name="address" class="form-control" value="{{ old('address', $donor->address) }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Status</label>
                    <select name="status" class="form-select">
                        <option value="active"   {{ $donor->status=='active'   ? 'selected':'' }}>Active</option>
                        <option value="inactive" {{ $donor->status=='inactive' ? 'selected':'' }}>Inactive</option>
                    </select>
                </div>
            </div>
            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-danger">Save Changes</button>
                <a href="{{ route('admin.donors') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
