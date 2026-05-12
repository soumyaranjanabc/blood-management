@extends('layouts.app')
@section('content')
<div class="card shadow-sm" style="max-width:550px;margin:auto;">
    <div class="card-header bg-white fw-bold">
        <i class="bi bi-pencil text-danger"></i> Edit User — {{ $user->name }}
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Role</label>
                    <select name="role" class="form-select" required>
                        <option value="admin"    {{ $user->role=='admin'    ? 'selected':'' }}>Admin</option>
                        <option value="donor"    {{ $user->role=='donor'    ? 'selected':'' }}>Donor</option>
                        <option value="hospital" {{ $user->role=='hospital' ? 'selected':'' }}>Hospital</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Blood Group</label>
                    <select name="blood_group" class="form-select">
                        <option value="">—</option>
                        @foreach(['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $bg)
                        <option value="{{ $bg }}" {{ $user->blood_group == $bg ? 'selected':'' }}>{{ $bg }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                </div>
                <div class="col-12">
                    <label class="form-label fw-bold">Address</label>
                    <input type="text" name="address" class="form-control" value="{{ old('address', $user->address) }}">
                </div>
            </div>
            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-danger">Save Changes</button>
                <a href="{{ route('admin.users') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
