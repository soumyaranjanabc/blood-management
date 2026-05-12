@extends('layouts.app')
@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white fw-bold">
        <i class="bi bi-hospital-fill text-danger"></i> Registered Hospitals
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr><th>#</th><th>Name</th><th>License</th><th>Phone</th><th>City</th><th>Status</th><th>Actions</th></tr>
            </thead>
            <tbody>
                @forelse($hospitals as $hospital)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $hospital->name }}</td>
                    <td>{{ $hospital->license_number }}</td>
                    <td>{{ $hospital->phone }}</td>
                    <td>{{ $hospital->city }}</td>
                    <td>
                        <span class="badge bg-{{ $hospital->status === 'active' ? 'success' : 'secondary' }}">
                            {{ ucfirst($hospital->status) }}
                        </span>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.hospitals.destroy', $hospital) }}"
                              class="d-inline" onsubmit="return confirm('Remove this hospital?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted py-4">No hospitals registered yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-white">{{ $hospitals->links() }}</div>
</div>
@endsection
