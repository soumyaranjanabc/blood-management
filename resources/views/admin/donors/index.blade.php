@extends('layouts.app')
@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white fw-bold d-flex justify-content-between align-items-center">
        <span><i class="bi bi-people-fill text-danger"></i> All Donors</span>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th><th>Name</th><th>Blood</th><th>Age</th>
                    <th>Phone</th><th>City</th><th>Last Donation</th><th>Status</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($donors as $donor)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $donor->name }}</td>
                    <td><span class="blood-badge" style="width:32px;height:32px;line-height:32px;font-size:0.65rem;">{{ $donor->blood_group }}</span></td>
                    <td>{{ $donor->age }}</td>
                    <td>{{ $donor->phone }}</td>
                    <td>{{ $donor->city }}</td>
                    <td>{{ $donor->last_donation_date ? $donor->last_donation_date->format('d M Y') : 'Never' }}</td>
                    <td>
                        <span class="badge bg-{{ $donor->status === 'active' ? 'success' : 'secondary' }}">
                            {{ ucfirst($donor->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.donors.edit', $donor) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.donors.destroy', $donor) }}" class="d-inline"
                              onsubmit="return confirm('Delete this donor?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="9" class="text-center text-muted py-4">No donors registered yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-white">{{ $donors->links() }}</div>
</div>
@endsection
