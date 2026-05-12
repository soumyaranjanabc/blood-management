@extends('layouts.app')
@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white fw-bold">
        <i class="bi bi-clipboard2-pulse-fill text-danger"></i> All Blood Requests
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th><th>Patient</th><th>Blood</th><th>Units</th>
                    <th>Hospital</th><th>Priority</th><th>Required Date</th><th>Status</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($requests as $req)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $req->patient_name }}</td>
                    <td><span class="blood-badge" style="width:30px;height:30px;line-height:30px;font-size:0.65rem;">{{ $req->blood_group }}</span></td>
                    <td>{{ $req->units_required }}</td>
                    <td>{{ $req->hospital_name }}</td>
                    <td><span class="badge badge-{{ $req->priority }}">{{ ucfirst($req->priority) }}</span></td>
                    <td>{{ $req->required_date->format('d M Y') }}</td>
                    <td><span class="badge badge-{{ $req->status }}">{{ ucfirst($req->status) }}</span></td>
                    <td>
                        @if($req->status === 'pending')
                        <form method="POST" action="{{ route('admin.requests.approve', $req) }}" class="d-inline">
                            @csrf @method('PATCH')
                            <button class="btn btn-sm btn-success" title="Approve">
                                <i class="bi bi-check-lg"></i>
                            </button>
                        </form>
                        <form method="POST" action="{{ route('admin.requests.reject', $req) }}" class="d-inline">
                            @csrf @method('PATCH')
                            <button class="btn btn-sm btn-danger" title="Reject">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </form>
                        @elseif($req->status === 'approved')
                        <form method="POST" action="{{ route('admin.requests.fulfill', $req) }}" class="d-inline">
                            @csrf @method('PATCH')
                            <button class="btn btn-sm btn-primary" title="Mark Fulfilled">
                                <i class="bi bi-check2-all"></i>
                            </button>
                        </form>
                        @else
                        <span class="text-muted small">—</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="9" class="text-center text-muted py-4">No blood requests found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-white">{{ $requests->links() }}</div>
</div>
@endsection
