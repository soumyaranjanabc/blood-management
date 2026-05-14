@extends('layouts.app')
@section('content')

<div class="page-header">
    <h4>Admin Dashboard</h4>
    <p>Welcome back, {{ auth()->user()->name }}! Here's what's happening today.</p>
</div>

{{-- Stat Cards --}}
<div class="row g-3 mb-4">
    <div class="col-md-3 col-6">
        <div class="stat-card card-red">
            <div class="stat-icon"><i class="bi bi-people-fill"></i></div>
            <div class="stat-value">{{ $stats['total_donors'] }}</div>
            <div class="stat-label">Total Donors</div>
            <i class="bi bi-people-fill stat-bg-icon"></i>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="stat-card card-blue">
            <div class="stat-icon"><i class="bi bi-hospital-fill"></i></div>
            <div class="stat-value">{{ $stats['total_hospitals'] }}</div>
            <div class="stat-label">Hospitals</div>
            <i class="bi bi-hospital-fill stat-bg-icon"></i>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="stat-card card-orange">
            <div class="stat-icon"><i class="bi bi-hourglass-split"></i></div>
            <div class="stat-value">{{ $stats['pending_requests'] }}</div>
            <div class="stat-label">Pending Requests</div>
            <i class="bi bi-hourglass-split stat-bg-icon"></i>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="stat-card card-green">
            <div class="stat-icon"><i class="bi bi-check-circle-fill"></i></div>
            <div class="stat-value">{{ $stats['fulfilled_requests'] }}</div>
            <div class="stat-label">Fulfilled</div>
            <i class="bi bi-check-circle-fill stat-bg-icon"></i>
        </div>
    </div>
</div>

{{-- Inventory Overview --}}
<div class="section-card mb-4">
    <div class="section-header">
        <div class="section-title"><i class="bi bi-droplet-half"></i> Blood Inventory Overview</div>
        <a href="{{ route('admin.inventory') }}" class="btn btn-blood btn-sm">Manage</a>
    </div>
    <div class="p-4">
        <div class="row g-3">
            @foreach($inventory as $item)
            <div class="col-md-3 col-6">
                <div class="inventory-item">
                    <div class="inv-blood">{{ $item->blood_group }}</div>
                    <div class="inv-count">{{ $item->units_available }}</div>
                    <div class="inv-label">units available</div>
                    <div class="inv-progress">
                        @php $pct = min(100, ($item->units_available / max(1,100)) * 100); @endphp
                        <div class="inv-progress-bar" style="width:{{ $pct }}%"></div>
                    </div>
                    @if($item->units_available < 10)
                        <span class="badge mt-2" style="background:#f8d7da;color:#842029;font-size:0.7rem;">Low Stock</span>
                    @else
                        <span class="badge mt-2" style="background:#d1e7dd;color:#0f5132;font-size:0.7rem;">Available</span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div class="row g-4">
    {{-- Recent Requests --}}
    <div class="col-md-7">
        <div class="section-card">
            <div class="section-header">
                <div class="section-title"><i class="bi bi-clipboard2-pulse-fill"></i> Recent Blood Requests</div>
                <a href="{{ route('admin.requests') }}" class="btn btn-blood btn-sm">View All</a>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Patient</th><th>Blood</th><th>Units</th><th>Priority</th><th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentRequests as $req)
                    <tr>
                        <td class="fw-600">{{ $req->patient_name }}</td>
                        <td><div class="blood-badge" style="width:32px;height:32px;font-size:0.65rem;">{{ $req->blood_group }}</div></td>
                        <td>{{ $req->units_required }}</td>
                        <td><span class="status-badge badge-{{ $req->priority }}">{{ ucfirst($req->priority) }}</span></td>
                        <td><span class="status-badge badge-{{ $req->status }}">{{ ucfirst($req->status) }}</span></td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center text-muted py-4">No requests yet</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Recent Donors --}}
    <div class="col-md-5">
        <div class="section-card">
            <div class="section-header">
                <div class="section-title"><i class="bi bi-people-fill"></i> Recent Donors</div>
                <a href="{{ route('admin.donors') }}" class="btn btn-blood btn-sm">View All</a>
            </div>
            <table class="table">
                <thead>
                    <tr><th>Name</th><th>Blood</th><th>City</th></tr>
                </thead>
                <tbody>
                    @forelse($recentDonors as $donor)
                    <tr>
                        <td class="fw-600">{{ $donor->name }}</td>
                        <td><div class="blood-badge" style="width:32px;height:32px;font-size:0.65rem;">{{ $donor->blood_group }}</div></td>
                        <td>{{ $donor->city }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="text-center text-muted py-4">No donors yet</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
