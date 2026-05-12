@extends('layouts.app')
@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white fw-bold d-flex justify-content-between align-items-center">
        <span><i class="bi bi-clipboard2-pulse-fill text-danger"></i> My Blood Requests</span>
        <a href="{{ route('donor.requests.create') }}" class="btn btn-danger btn-sm">+ New Request</a>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr><th>#</th><th>Patient</th><th>Blood</th><th>Units</th><th>Hospital</th><th>Priority</th><th>Required Date</th><th>Status</th></tr>
            </thead>
            <tbody>
                @forelse($requests as $req)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $req->patient_name }}</td>
                    <td><span class="blood-badge" style="width:28px;height:28px;line-height:28px;font-size:0.6rem;">{{ $req->blood_group }}</span></td>
                    <td>{{ $req->units_required }}</td>
                    <td>{{ $req->hospital_name }}</td>
                    <td><span class="badge badge-{{ $req->priority }}">{{ ucfirst($req->priority) }}</span></td>
                    <td>{{ $req->required_date->format('d M Y') }}</td>
                    <td><span class="badge badge-{{ $req->status }}">{{ ucfirst($req->status) }}</span></td>
                </tr>
                @empty
                <tr><td colspan="8" class="text-center text-muted py-4">No requests submitted yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-white">{{ $requests->links() }}</div>
</div>
@endsection
