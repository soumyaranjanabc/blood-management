@extends('layouts.app')
@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white fw-bold d-flex justify-content-between align-items-center">
        <span><i class="bi bi-droplet-fill text-danger"></i> My Donation History</span>
        <a href="{{ route('donor.donations.create') }}" class="btn btn-danger btn-sm">
            <i class="bi bi-plus-circle me-1"></i> Record Donation
        </a>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Blood Group</th>
                    <th>Units</th>
                    <th>Donation Date</th>
                    <th>Notes</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($donations as $donation)
                <tr>
                    <td>{{ $loop->iteration }}</td>
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
                            <span class="badge bg-warning text-dark">
                                <i class="bi bi-hourglass-split me-1"></i>Pending
                            </span>
                        @elseif($donation->status === 'verified')
                            <span class="badge bg-success">
                                <i class="bi bi-check-circle-fill me-1"></i>Verified
                            </span>
                        @else
                            <span class="badge bg-danger">
                                <i class="bi bi-x-circle-fill me-1"></i>Rejected
                            </span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">
                        <i class="bi bi-droplet text-danger fs-3 d-block mb-2"></i>
                        No donations recorded yet.
                        <a href="{{ route('donor.donations.create') }}">Record your first donation</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-white">{{ $donations->links() }}</div>
</div>
@endsection
