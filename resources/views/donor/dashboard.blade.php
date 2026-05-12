@extends('layouts.app')
@section('content')

@if(!$donor)
<div class="alert alert-warning">
    <i class="bi bi-exclamation-triangle-fill me-2"></i>
    Please complete your <a href="{{ route('donor.profile') }}" class="alert-link">donor profile</a> to get started.
</div>
@endif

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card stat-card bg-danger text-white">
            <div class="card-body text-center">
                <div class="blood-badge mx-auto mb-2" style="width:50px;height:50px;line-height:50px;font-size:1rem;">
                    {{ $user->blood_group ?? '?' }}
                </div>
                <div class="fw-bold">My Blood Group</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card bg-primary text-white">
            <div class="card-body text-center">
                <div class="fs-2 fw-bold">{{ $myRequests->count() }}</div>
                <div class="small">My Requests</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card bg-success text-white">
            <div class="card-body text-center">
                <div class="fs-5 fw-bold">
                    {{ $donor && $donor->last_donation_date ? $donor->last_donation_date->format('d M Y') : 'Never' }}
                </div>
                <div class="small">Last Donation</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-7">
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-bold d-flex justify-content-between">
                <span><i class="bi bi-clipboard2-pulse text-danger"></i> My Recent Requests</span>
                <a href="{{ route('donor.requests.create') }}" class="btn btn-sm btn-danger">+ New Request</a>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr><th>Patient</th><th>Blood</th><th>Units</th><th>Status</th></tr>
                    </thead>
                    <tbody>
                        @forelse($myRequests as $req)
                        <tr>
                            <td>{{ $req->patient_name }}</td>
                            <td><span class="blood-badge" style="width:28px;height:28px;line-height:28px;font-size:0.6rem;">{{ $req->blood_group }}</span></td>
                            <td>{{ $req->units_required }}</td>
                            <td><span class="badge badge-{{ $req->status }}">{{ ucfirst($req->status) }}</span></td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center text-muted py-3">No requests yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-bold">
                <i class="bi bi-droplet-half text-danger"></i> Blood Availability
            </div>
            <div class="card-body p-0">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr><th>Blood Group</th><th>Available</th></tr>
                    </thead>
                    <tbody>
                        @foreach($inventory as $item)
                        <tr>
                            <td><span class="blood-badge" style="width:28px;height:28px;line-height:28px;font-size:0.6rem;">{{ $item->blood_group }}</span></td>
                            <td>
                                <span class="fw-bold {{ $item->units_available < 10 ? 'text-danger' : 'text-success' }}">
                                    {{ $item->units_available }} units
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
