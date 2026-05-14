@extends('layouts.app')
@section('content')

<div class="page-header">
    <h4>Donor Dashboard</h4>
    <p>Welcome, {{ auth()->user()->name }}! Track your donations and blood availability.</p>
</div>

@if(!$donor)
<div class="alert alert-warning mb-4">
    <i class="bi bi-exclamation-triangle-fill me-2"></i>
    Complete your <a href="{{ route('donor.profile') }}" class="fw-bold text-warning">donor profile</a> before recording donations.
</div>
@endif

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="stat-card card-red">
            <div class="stat-icon">🩸</div>
            <div class="stat-value">{{ $user->blood_group ?? '?' }}</div>
            <div class="stat-label">My Blood Group</div>
            <i class="bi bi-droplet-fill stat-bg-icon"></i>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card card-blue">
            <div class="stat-icon"><i class="bi bi-droplet-fill"></i></div>
            <div class="stat-value">{{ $myDonations->count() }}</div>
            <div class="stat-label">Total Donations</div>
            <i class="bi bi-droplet-fill stat-bg-icon"></i>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card card-green">
            <div class="stat-icon"><i class="bi bi-calendar-check-fill"></i></div>
            <div class="stat-value" style="font-size:1.2rem;">
                {{ $donor && $donor->last_donation_date ? $donor->last_donation_date->format('d M Y') : 'Never' }}
            </div>
            <div class="stat-label">Last Donation</div>
            <i class="bi bi-calendar-fill stat-bg-icon"></i>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-7">
        <div class="section-card">
            <div class="section-header">
                <div class="section-title"><i class="bi bi-droplet-fill"></i> My Recent Donations</div>
                <a href="{{ route('donor.donations.create') }}" class="btn btn-blood btn-sm">+ Record Donation</a>
            </div>
            <table class="table">
                <thead>
                    <tr><th>Blood Group</th><th>Units</th><th>Date</th><th>Status</th></tr>
                </thead>
                <tbody>
                    @forelse($myDonations as $d)
                    <tr>
                        <td><div class="blood-badge" style="width:32px;height:32px;font-size:0.65rem;">{{ $d->blood_group }}</div></td>
                        <td>{{ $d->units_donated }} unit(s)</td>
                        <td>{{ $d->donation_date->format('d M Y') }}</td>
                        <td>
                            <span class="status-badge badge-{{ $d->status === 'verified' ? 'approved' : $d->status }}">
                                {{ ucfirst($d->status) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center text-muted py-4">
                        No donations yet. <a href="{{ route('donor.donations.create') }}">Record one now</a>
                    </td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-md-5">
        <div class="section-card">
            <div class="section-header">
                <div class="section-title"><i class="bi bi-droplet-half"></i> Blood Availability</div>
            </div>
            <div class="p-3">
                @foreach($inventory as $item)
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="d-flex align-items-center gap-2">
                        <div class="blood-badge" style="width:32px;height:32px;font-size:0.65rem;">{{ $item->blood_group }}</div>
                        <span class="fw-600 small">{{ $item->blood_group }}</span>
                    </div>
                    <div class="text-end">
                        <span class="fw-700 {{ $item->units_available < 10 ? 'text-danger' : 'text-success' }}">
                            {{ $item->units_available }} units
                        </span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
