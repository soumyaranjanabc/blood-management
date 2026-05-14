@extends('layouts.app')
@section('content')
<div class="min-vh-100 d-flex align-items-center justify-content-center"
     style="background:linear-gradient(135deg,#1a1a2e 0%,#16213e 50%,#0f3460 100%);margin:-1.5rem;">
    <div class="row w-100 justify-content-center px-3">
        <div class="col-md-6 col-lg-5">
            <div class="shadow-lg p-5" style="background:#fff;border-radius:24px;">
                <div class="text-center mb-4">
                    <div style="width:56px;height:56px;background:linear-gradient(135deg,#e63946,#c1121f);border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;margin:0 auto 12px;box-shadow:0 4px 15px rgba(230,57,70,0.4);">🩸</div>
                    <h4 style="font-weight:800;color:#1a1a2e;">Create Account</h4>
                    <p class="text-muted" style="font-size:0.875rem;">Join the Blood Management System</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf
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

                    <div class="mb-3">
                        <label class="form-label">Register As</label>
                        <div class="row g-2">
                            <div class="col-6">
                                <input type="radio" class="btn-check" name="role" id="role_donor"
                                       value="donor" {{ old('role','donor')=='donor' ? 'checked':'' }} required>
                                <label class="btn w-100 py-2" for="role_donor"
                                       style="border:2px solid #e63946;border-radius:12px;font-weight:600;color:#e63946;transition:all 0.2s;">
                                    <i class="bi bi-person-heart me-1"></i> Donor
                                </label>
                            </div>
                            <div class="col-6">
                                <input type="radio" class="btn-check" name="role" id="role_hospital"
                                       value="hospital" {{ old('role')=='hospital' ? 'checked':'' }}>
                                <label class="btn w-100 py-2" for="role_hospital"
                                       style="border:2px solid #4361ee;border-radius:12px;font-weight:600;color:#4361ee;transition:all 0.2s;">
                                    <i class="bi bi-hospital-fill me-1"></i> Hospital
                                </label>
                            </div>
                        </div>
                        @error('role')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
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

                    <button type="submit" class="btn btn-blood w-100 py-2" style="font-size:0.95rem;">
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
@endsection
