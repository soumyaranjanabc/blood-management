@extends('layouts.app')
@section('content')

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card stat-card bg-danger text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="fs-2 fw-bold">{{ $stats['total_donors'] }}</div>
                        <div class="small">Total Donors</div>
                    </div>
                    <i class="bi bi-people-fill fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="fs-2 fw-bold">{{ $stats['total_hospitals'] }}</div>
                        <div class="small">Hospitals</div>
                    </div>
                    <i class="bi bi-hospital-fill fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card bg-warning text-dark">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="fs-2 fw-bold">{{ $stats['pending_requests'] }}</div>
                        <div class="small">Pending Requests</div>
                    </div>
                    <i class="bi bi-hourglass-split fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="fs-2 fw-bold">{{ $stats['fulfilled_requests'] }}</div>
                        <div class="small">Fulfilled Requests</div>
                    </div>
                    <i class="bi bi-check-circle-fill fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Blood Inventory Overview --}}
<div class="card shadow-sm mb-4">
    <div class="card-header bg-white fw-bold">
        <i class="bi bi-droplet-half text-danger"></i> Blood Inventory Overview
    </div>
    <div class="card-body">
        <div class="row g-3">
            @foreach($inventory as $item)
            <div class="col-md-3 col-6">
                <div class="border rounded p-3 text-center">
                    <div class="blood-badge mb-2">{{ $item->blood_group }}</div>
                    <div class="fw-bold fs-5">{{ $item->units_available }} <small class="text-muted fw-normal">units</small></div>
                    <div class="text-muted small">Reserved: {{ $item->units_reserved }}</div>
                    <div class="progress mt-2" style="height:6px;">
                        @php $pct = $item->units_available > 0 ? min(100, ($item->units_available / 100) * 100) : 0; @endphp
                        <div class="progress-bar bg-danger" style="width:{{ $pct }}%"></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div class="row g-4">
    {{-- Recent Requests --}}
    <div class="col-md-7">
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-bold d-flex justify-content-between">
                <span><i class="bi bi-clipboard2-pulse text-danger"></i> Recent Blood Requests</span>
                <a href="{{ route('admin.requests') }}" class="btn btn-sm btn-outline-danger">View All</a>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Patient</th>
                            <th>Blood</th>
                            <th>Units</th>
                            <th>Priority</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentRequests as $req)
                        <tr>
                            <td>{{ $req->patient_name }}</td>
                            <td><span class="blood-badge" style="width:30px;height:30px;line-height:30px;font-size:0.65rem;">{{ $req->blood_group }}</span></td>
                            <td>{{ $req->units_required }}</td>
                            <td><span class="badge badge-{{ $req->priority }}">{{ ucfirst($req->priority) }}</span></td>
                            <td><span class="badge badge-{{ $req->status }}">{{ ucfirst($req->status) }}</span></td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center text-muted py-3">No requests yet</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Recent Donors --}}
    <div class="col-md-5">
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-bold d-flex justify-content-between">
                <span><i class="bi bi-people text-danger"></i> Recent Donors</span>
                <a href="{{ route('admin.donors') }}" class="btn btn-sm btn-outline-danger">View All</a>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr><th>Name</th><th>Blood</th><th>City</th></tr>
                    </thead>
                    <tbody>
                        @forelse($recentDonors as $donor)
                        <tr>
                            <td>{{ $donor->name }}</td>
                            <td><span class="blood-badge" style="width:30px;height:30px;line-height:30px;font-size:0.65rem;">{{ $donor->blood_group }}</span></td>
                            <td>{{ $donor->city }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="text-center text-muted py-3">No donors yet</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
