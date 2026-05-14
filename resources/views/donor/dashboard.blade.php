@extends('layouts.app')
@section('content')

@if(!$donor)
<div class="alert alert-warning">
    <i class="bi bi-exclamation-triangle-fill me-2"></i>
    Please complete your <a href="{{ route('donor.profile') }}" class="alert-link">donor profile</a> before recording donations.
</div>
@endif

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card stat-card bg-danger text-white">
            <div class="card-body text-center">
                <div class="blood-badge mx-auto mb-2"
                     style="width:50px;height:50px;line-height:50px;font-size:1rem;">
                    {{ $user->blood_group ?? '?' }}
                </div>
                <div class="fw-bold">My Blood Group</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card bg-primary text-white">
            <div class="card-body text-center">
                <div class="fs-2 fw-bold">{{ $myDonations->count() }}</div>
                <div class="small">Total Donations</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card bg-success text-white">
            <div class="card-body text-center">
                <div class="fs-5 fw-bold">
                    {{ $donor && $donor->last_donation_date
                        ? $donor->last_donation_date->format('d M Y')
                        : 'Never' }}
                </div>
                <div class="small">Last Donation</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    {{-- Recent Donations --}}
    <div class="col-md-7">
        <div class="card shadow-sm">
            <div class="card-header bg-white fw-bold d-flex justify-content-between">
                <span><i class="bi bi-droplet-fill text-danger"></i> My Recent Donations</span>
                <a href="{{ route('donor.donations.create') }}" class="btn btn-sm btn-danger">
                    + Record Donation
                </a>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Blood Group</th>
                            <th>Units</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($myDonations as $donation)
                        <tr>
                            <td>
                                <span class="blood-badge"
                                      style="width:28px;height:28px;line-height:28px;font-size:0.6rem;">
                                    {{ $donation->blood_group }}
                                </span>
                            </td>
                            <td>{{ $donation->units_donated }} unit(s)</td>
                            <td>{{ $donation->donation_date->format('d M Y') }}</td>
                            <td>
                                @if($donation->status === 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($donation->status === 'verified')
                                    <span class="badge bg-success">Verified</span>
                                @else
                                    <span class="badge bg-danger">Rejected</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-3">
                                No donations yet.
                                <a href="{{ route('donor.donations.create') }}">Record one now</a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Blood Availability --}}
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
                            <td>
                                <span class="blood-badge"
                                      style="width:28px;height:28px;line-height:28px;font-size:0.6rem;">
                                    {{ $item->blood_group }}
                                </span>
                            </td>
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
