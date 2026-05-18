@extends('layouts.app')
@section('content')
<div class="min-vh-100 d-flex align-items-center justify-content-center"
     style="background:linear-gradient(135deg,#1a1a2e 0%,#16213e 50%,#0f3460 100%);margin:-1.5rem;">
    <div class="row w-100 justify-content-center px-3">
        <div class="col-md-7 col-lg-6">
            <div class="shadow-lg p-5" style="background:#fff;border-radius:24px;">

                {{-- Header --}}
                <div class="text-center mb-4">
                    <div style="width:56px;height:56px;background:linear-gradient(135deg,#e63946,#c1121f);border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;margin:0 auto 12px;box-shadow:0 4px 15px rgba(230,57,70,0.4);">🩸</div>
                    <h4 style="font-weight:800;color:#1a1a2e;">Create Account</h4>
                    <p class="text-muted" style="font-size:0.875rem;">Join the Blood Management System</p>
                </div>

                {{-- Validation Errors --}}
                @if($errors->any())
                <div class="alert alert-danger py-2 mb-3">
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $error)
                        <li style="font-size:0.85rem;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    {{-- IMPORTANT: This hidden input is what Laravel reads on submit --}}
                    <input type="hidden" name="role" id="selectedRole" value="{{ old('role', 'donor') }}">

                    {{-- ── ROLE SELECTOR BUTTONS ── --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Register As</label>
                        <div class="row g-2">
                            <div class="col-6">
                                <button type="button" id="btn-donor" onclick="selectRole('donor')"
                                    class="btn w-100 py-2"
                                    style="border:2px solid #e63946;border-radius:12px;font-weight:600;">
                                    <i class="bi bi-person-heart me-1"></i> Donor
                                </button>
                            </div>
                            <div class="col-6">
                                <button type="button" id="btn-hospital" onclick="selectRole('hospital')"
                                    class="btn w-100 py-2"
                                    style="border:2px solid #4361ee;border-radius:12px;font-weight:600;">
                                    <i class="bi bi-hospital-fill me-1"></i> Hospital
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- ── COMMON FIELDS ── --}}
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}" placeholder="Your full name" required autofocus>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}" placeholder="you@example.com" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label">Phone</label>
                            <input type="tel" name="phone"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   value="{{ old('phone') }}" placeholder="10-digit number" required>
                            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-6">
                            <label class="form-label">City</label>
                            <input type="text" name="city"
                                   class="form-control @error('city') is-invalid @enderror"
                                   value="{{ old('city') }}" placeholder="Your city" required>
                            @error('city')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">State</label>
                        <select name="state" class="form-select @error('state') is-invalid @enderror" required>
                            <option value="">Select your state</option>
                            @foreach(['Andhra Pradesh','Assam','Bihar','Chandigarh','Delhi','Goa','Gujarat','Haryana','Himachal Pradesh','Jharkhand','Karnataka','Kerala','Madhya Pradesh','Maharashtra','Manipur','Meghalaya','Odisha','Punjab','Rajasthan','Tamil Nadu','Telangana','Uttar Pradesh','Uttarakhand','West Bengal'] as $s)
                            <option value="{{ $s }}" {{ old('state')===$s ? 'selected' : '' }}>{{ $s }}</option>
                            @endforeach
                        </select>
                        @error('state')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="Min. 8 characters" required>
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation"
                               class="form-control" placeholder="Repeat password" required>
                    </div>

                    {{-- ══════════════════════════════
                         DONOR EXTRA FIELDS
                    ══════════════════════════════ --}}
                    <div id="donor-fields">
                        <hr style="border-color:#fde8e8;">
                        <p class="fw-semibold mb-3" style="color:#e63946;font-size:0.875rem;">🩸 Donor Details</p>
                        <div class="row g-2 mb-3">
                            <div class="col-4">
                                <label class="form-label">Blood Group</label>
                                <select name="blood_group" id="blood_group"
                                        class="form-select @error('blood_group') is-invalid @enderror">
                                    <option value="">Select</option>
                                    @foreach(['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $g)
                                    <option value="{{ $g }}" {{ old('blood_group')===$g ? 'selected':'' }}>{{ $g }}</option>
                                    @endforeach
                                </select>
                                @error('blood_group')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-4">
                                <label class="form-label">Gender</label>
                                <select name="gender" id="gender"
                                        class="form-select @error('gender') is-invalid @enderror">
                                    <option value="">Select</option>
                                    <option value="male"   {{ old('gender')==='male'   ? 'selected':'' }}>Male</option>
                                    <option value="female" {{ old('gender')==='female' ? 'selected':'' }}>Female</option>
                                    <option value="other"  {{ old('gender')==='other'  ? 'selected':'' }}>Other</option>
                                </select>
                                @error('gender')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-4">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" name="date_of_birth" id="date_of_birth"
                                       class="form-control @error('date_of_birth') is-invalid @enderror"
                                       value="{{ old('date_of_birth') }}"
                                       max="{{ now()->subYears(18)->format('Y-m-d') }}">
                                @error('date_of_birth')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" id="donor_address"
                                   class="form-control" value="{{ old('address') }}"
                                   placeholder="Your home address">
                        </div>
                    </div>

                    {{-- ══════════════════════════════
                         HOSPITAL EXTRA FIELDS
                    ══════════════════════════════ --}}
                    <div id="hospital-fields" style="display:none;">
                        <hr style="border-color:#e0e7ff;">
                        <p class="fw-semibold mb-3" style="color:#4361ee;font-size:0.875rem;">🏥 Hospital Details</p>
                        <div class="mb-3">
                            <label class="form-label">Hospital Name</label>
                            <input type="text" name="hospital_name" id="hospital_name"
                                   class="form-control @error('hospital_name') is-invalid @enderror"
                                   value="{{ old('hospital_name') }}" placeholder="Full hospital name">
                            @error('hospital_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Registration Number</label>
                            <input type="text" name="registration_number" id="registration_number"
                                   class="form-control @error('registration_number') is-invalid @enderror"
                                   value="{{ old('registration_number') }}" placeholder="Govt. registration number">
                            @error('registration_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label class="form-label">Hospital Type</label>
                                <select name="hospital_type" id="hospital_type" class="form-select">
                                    <option value="private"    {{ old('hospital_type')==='private'    ? 'selected':'' }}>Private</option>
                                    <option value="government" {{ old('hospital_type')==='government' ? 'selected':'' }}>Government</option>
                                    <option value="trust"      {{ old('hospital_type')==='trust'      ? 'selected':'' }}>Trust / NGO</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Hospital Address</label>
                                <input type="text" name="address" id="hospital_address"
                                       class="form-control" value="{{ old('address') }}"
                                       placeholder="Hospital address">
                            </div>
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit" class="btn w-100 py-2"
                            style="background:linear-gradient(135deg,#e63946,#c1121f);color:#fff;font-weight:700;font-size:0.95rem;border-radius:12px;border:none;">
                        <i class="bi bi-person-plus-fill me-2"></i> Create Account
                    </button>
                </form>

                <div class="text-center mt-3">
                    <span class="text-muted small">Already have an account? </span>
                    <a href="{{ route('login') }}" class="text-danger fw-bold small">Sign in</a>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
function selectRole(role) {

    // Step 1: Update hidden input — this is what Laravel receives
    document.getElementById('selectedRole').value = role;

    // Step 2: Style both buttons correctly
    var donorBtn    = document.getElementById('btn-donor');
    var hospitalBtn = document.getElementById('btn-hospital');

    if (role === 'donor') {
        // Donor = filled red
        donorBtn.style.background  = '#e63946';
        donorBtn.style.color       = '#ffffff';
        donorBtn.style.borderColor = '#e63946';
        // Hospital = outline blue
        hospitalBtn.style.background  = '#ffffff';
        hospitalBtn.style.color       = '#4361ee';
        hospitalBtn.style.borderColor = '#4361ee';
    } else {
        // Hospital = filled blue
        hospitalBtn.style.background  = '#4361ee';
        hospitalBtn.style.color       = '#ffffff';
        hospitalBtn.style.borderColor = '#4361ee';
        // Donor = outline red
        donorBtn.style.background  = '#ffffff';
        donorBtn.style.color       = '#e63946';
        donorBtn.style.borderColor = '#e63946';
    }

    // Step 3: Show/hide extra fields
    document.getElementById('donor-fields').style.display    = (role === 'donor')    ? 'block' : 'none';
    document.getElementById('hospital-fields').style.display = (role === 'hospital') ? 'block' : 'none';

    // Step 4: Toggle required so browser validation works on visible fields only
    if (role === 'donor') {
        document.getElementById('blood_group').setAttribute('required', 'required');
        document.getElementById('gender').setAttribute('required', 'required');
        document.getElementById('date_of_birth').setAttribute('required', 'required');
        document.getElementById('hospital_name').removeAttribute('required');
        document.getElementById('registration_number').removeAttribute('required');
    } else {
        document.getElementById('hospital_name').setAttribute('required', 'required');
        document.getElementById('registration_number').setAttribute('required', 'required');
        document.getElementById('blood_group').removeAttribute('required');
        document.getElementById('gender').removeAttribute('required');
        document.getElementById('date_of_birth').removeAttribute('required');
    }
}

// Runs on page load — restores selected role if Laravel bounced back with errors
document.addEventListener('DOMContentLoaded', function () {
    var role = document.getElementById('selectedRole').value || 'donor';
    selectRole(role);
});
</script>

@endsection
