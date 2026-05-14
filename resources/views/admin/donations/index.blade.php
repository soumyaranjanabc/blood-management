@extends('layouts.app')
@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white fw-bold">
        <i class="bi bi-droplet-fill text-danger"></i> Donation Verification
        <span class="badge bg-warning text-dark ms-2">
            {{ $donations->where('status','pending')->count() }} Pending
        </span>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Donor</th>
                    <th>Blood Group</th>
                    <th>Units</th>
                    <th>Donation Date</th>
                    <th>Notes</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($donations as $donation)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <div class="fw-bold">{{ $donation->donor->name ?? '—' }}</div>
                        <div class="text-muted small">{{ $donation->user->email ?? '' }}</div>
                    </td>
                    <td>
                        <span class="blood-badge"
                              style="width:30px;height:30px;line-height:30px;font-size:0.65rem;">
                            {{ $donation->blood_group }}
                        </span>
                    </td>
                    <td>{{ $donation->units_donated }} unit(s)</td>
                    <td>{{ $donation->donation_date->format('d M Y') }}</td>
                    <td>{{ $donation->notes ?? '—' }}</td>
                    <td>
                        @if($donation->status === 'pending')
                            <span class="badge bg-warning text-dark">Pending</span>
                        @elseif($donation->status === 'verified')
                            <span class="badge bg-success">Verified ✓</span>
                        @else
                            <span class="badge bg-danger">Rejected</span>
                        @endif
                    </td>
                    <td>
                        @if($donation->status === 'pending')
                        <form method="POST"
                              action="{{ route('admin.donations.verify', $donation) }}"
                              class="d-inline">
                            @csrf @method('PATCH')
                            <button class="btn btn-sm btn-success" title="Verify & Add to Inventory">
                                <i class="bi bi-check-lg"></i> Verify
                            </button>
                        </form>
                        <form method="POST"
                              action="{{ route('admin.donations.reject', $donation) }}"
                              class="d-inline">
                            @csrf @method('PATCH')
                            <button class="btn btn-sm btn-danger" title="Reject">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </form>
                        @else
                            <span class="text-muted small">—</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">
                        No donation records found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-white">{{ $donations->links() }}</div>
</div>
@endsection
