@extends('layouts.app')
@section('content')
<div class="card shadow-sm" style="max-width:580px;margin:auto;">
    <div class="card-header bg-white fw-bold">
        <i class="bi bi-droplet-fill text-danger"></i> Record My Blood Donation
    </div>
    <div class="card-body">

        {{-- Donor Info Banner --}}
        <div class="alert alert-light border d-flex align-items-center gap-3 mb-4">
            <div class="blood-badge">{{ $donor->blood_group }}</div>
            <div>
                <div class="fw-bold">{{ $donor->name }}</div>
                <div class="text-muted small">{{ $donor->city }} &bull; {{ ucfirst($donor->gender) }}, {{ $donor->age }} yrs</div>
                <div class="text-muted small">
                    Last donation:
                    <b>{{ $donor->last_donation_date ? $donor->last_donation_date->format('d M Y') : 'Never' }}</b>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('donor.donations.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-bold">Blood Group</label>
                <input type="text" class="form-control bg-light"
                       value="{{ $donor->blood_group }}" disabled>
                <div class="form-text">Your blood group is taken from your profile.</div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Units Donated</label>
                <select name="units_donated" class="form-select" required>
                    @for($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ old('units_donated', 1) == $i ? 'selected' : '' }}>
                        {{ $i }} unit{{ $i > 1 ? 's' : '' }}
                    </option>
                    @endfor
                </select>
                <div class="form-text">1 unit = approximately 450ml of blood.</div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Donation Date</label>
                <input type="date" name="donation_date"
                       class="form-control @error('donation_date') is-invalid @enderror"
                       value="{{ old('donation_date', date('Y-m-d')) }}"
                       max="{{ date('Y-m-d') }}" required>
                @error('donation_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">
                    Notes <span class="text-muted fw-normal">(optional)</span>
                </label>
                <textarea name="notes" class="form-control" rows="3"
                          placeholder="e.g. Donated at City Blood Bank, Camp at XYZ College...">{{ old('notes') }}</textarea>
            </div>

            {{-- Info box --}}
            <div class="alert alert-info small">
                <i class="bi bi-info-circle-fill me-1"></i>
                Your donation will be <b>verified by Admin</b> before it's added to the blood inventory.
                This usually takes a short time.
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-danger px-4">
                    <i class="bi bi-droplet-fill me-1"></i> Submit Donation Record
                </button>
                <a href="{{ route('donor.donations') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
