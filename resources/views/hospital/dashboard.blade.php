@extends('layouts.app')
@section('content')

@if(!$hospital)
<div class="alert alert-warning">
    <i class="bi bi-exclamation-triangle-fill me-2"></i>
    Please complete your <a href="{{ route('hospital.profile') }}" class="alert-link">hospital profile</a> first.
</div>
@endif

<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="card stat-card bg-primary text-white">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="fs-2 fw-bold">{{ $myRequests->count() }}</div>
                    <div class="small">Total Requests</div>
                </div>
                <i class="bi bi-clipboard2-pulse-fill fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card stat-card bg-warning text-dark">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="fs-2 fw-bold">{{ $myRequests->where('status','pending')->count() }}</div>
                    <div class="small">Pending Requests</div>
                </div>
                <i class="bi bi-hourglass-split fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-7">
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-bold d-flex justify-content-between">
                <span><i class="bi bi-clipboard2-pulse text-danger"></i> Recent Requests</span>
                <a href="{{ route('hospital.requests.create') }}" class="btn btn-sm btn-danger">+ New Request</a>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr><th>Patient</th><th>Blood</th><th>Units</th><th>Priority</th><th>Status</th></tr>
                    </thead>
                    <tbody>
                        @forelse($myRequests as $req)
                        <tr>
                            <td>{{ $req->patient_name }}</td>
                            <td><span class="blood-badge" style="width:28px;height:28px;line-height:28px;font-size:0.6rem;">{{ $req->blood_group }}</span></td>
                            <td>{{ $req->units_required }}</td>
                            <td><span class="badge badge-{{ $req->priority }}">{{ ucfirst($req->priority) }}</span></td>
                            <td><span class="badge badge-{{ $req->status }}">{{ ucfirst($req->status) }}</span></td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center text-muted py-3">No requests yet.</td></tr>
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
                            <td><span class="fw-bold {{ $item->units_available < 10 ? 'text-danger' : 'text-success' }}">{{ $item->units_available }} units</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
