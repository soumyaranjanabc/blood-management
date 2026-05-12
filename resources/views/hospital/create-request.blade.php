@extends('layouts.app')
@section('content')
<div class="card shadow-sm" style="max-width:650px;margin:auto;">
    <div class="card-header bg-white fw-bold">
        <i class="bi bi-plus-circle-fill text-danger"></i> New Blood Request
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('hospital.requests.store') }}">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Patient Name</label>
                    <input type="text" name="patient_name" class="form-control" value="{{ old('patient_name') }}" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Blood Group</label>
                    <select name="blood_group" class="form-select" required>
                        <option value="">Select</option>
                        @foreach(['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $bg)
                        <option value="{{ $bg }}" {{ old('blood_group') == $bg ? 'selected':'' }}>{{ $bg }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Units Required</label>
                    <input type="number" name="units_required" class="form-control" value="{{ old('units_required', 1) }}" min="1" max="50" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Hospital Name</label>
                    <input type="text" name="hospital_name" class="form-control" value="{{ old('hospital_name', auth()->user()->name) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Contact Number</label>
                    <input type="text" name="contact_number" class="form-control" value="{{ old('contact_number', auth()->user()->phone) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Priority</label>
                    <select name="priority" class="form-select" required>
                        <option value="normal"   {{ old('priority')=='normal'   ? 'selected':'' }}>Normal</option>
                        <option value="urgent"   {{ old('priority')=='urgent'   ? 'selected':'' }}>Urgent</option>
                        <option value="critical" {{ old('priority')=='critical' ? 'selected':'' }}>Critical</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Required Date</label>
                    <input type="date" name="required_date" class="form-control"
                           value="{{ old('required_date') }}" min="{{ date('Y-m-d') }}" required>
                </div>
                <div class="col-12">
                    <label class="form-label fw-bold">Notes <span class="text-muted fw-normal">(optional)</span></label>
                    <textarea name="notes" class="form-control" rows="3">{{ old('notes') }}</textarea>
                </div>
            </div>
            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-danger px-4">Submit Request</button>
                <a href="{{ route('hospital.requests') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
