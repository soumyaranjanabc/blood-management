@extends('layouts.app')
@section('content')

<div class="page-header">
    <h4>Hospital Dashboard</h4>
    <p>Welcome, {{ auth()->user()->name }}! Manage your blood requests here.</p>
</div>

@if(!$hospital)
<div class="alert alert-warning mb-4">
    <i class="bi bi-exclamation-triangle-fill me-2"></i>
    Please complete your <a href="{{ route('hospital.profile') }}" class="fw-bold text-warning">hospital profile</a> first.
</div>
@endif

<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="stat-card card-blue">
            <div class="stat-icon"><i class="bi bi-clipboard2-pulse-fill"></i></div>
            <div class="stat-value">{{ $myRequests->count() }}</div>
            <div class="stat-label">Total Requests</div>
            <i class="bi bi-clipboard2-pulse-fill stat-bg-icon"></i>
        </div>
    </div>
    <div class="col-md-6">
        <div class="stat-card card-orange">
            <div class="stat-icon"><i class="bi bi-hourglass-split"></i></div>
            <div class="stat-value">{{ $myRequests->where('status','pending')->count() }}</div>
            <div class="stat-label">Pending Requests</div>
            <i class="bi bi-hourglass-split stat-bg-icon"></i>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-7">
        <div class="section-card">
            <div class="section-header">
                <div class="section-title"><i class="bi bi-clipboard2-pulse-fill"></i> Recent Requests</div>
                <a href="{{ route('hospital.requests.create') }}" class="btn btn-blood btn-sm">+ New Request</a>
            </div>
            <table class="table">
                <thead>
                    <tr><th>Patient</th><th>Blood</th><th>Units</th><th>Priority</th><th>Status</th></tr>
                </thead>
                <tbody>
                    @forelse($myRequests as $req)
                    <tr>
                        <td class="fw-600">{{ $req->patient_name }}</td>
                        <td><div class="blood-badge" style="width:32px;height:32px;font-size:0.65rem;">{{ $req->blood_group }}</div></td>
                        <td>{{ $req->units_required }}</td>
                        <td><span class="status-badge badge-{{ $req->priority }}">{{ ucfirst($req->priority) }}</span></td>
                        <td><span class="status-badge badge-{{ $req->status }}">{{ ucfirst($req->status) }}</span></td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center text-muted py-4">No requests yet.</td></tr>
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
                    <span class="fw-700 {{ $item->units_available < 10 ? 'text-danger' : 'text-success' }}">
                        {{ $item->units_available }} units
                    </span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
