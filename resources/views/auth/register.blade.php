@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height:85vh;">
        <div class="col-md-6">
            <div class="text-center mb-4">
                <div style="font-size:3rem;">🩸</div>
                <h3 class="fw-bold text-danger">Create Your Account</h3>
                <p class="text-muted">Join the Blood Management System</p>
            </div>
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-bold">Full Name</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-person-fill text-danger"></i></span>
                                <input type="text" name="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name') }}" required autofocus placeholder="Your full name">
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-envelope-fill text-danger"></i></span>
                                <input type="email" name="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       value="{{ old('email') }}" required placeholder="Your email">
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Register As</label>
                            <div class="row g-2">
                                <div class="col-6">
                                    <input type="radio" class="btn-check" name="role" id="role_donor" value="donor"
                                           {{ old('role','donor') == 'donor' ? 'checked' : '' }} required>
                                    <label class="btn btn-outline-danger w-100" for="role_donor">
                                        <i class="bi bi-person-heart me-1"></i> Donor
                                    </label>
                                </div>
                                <div class="col-6">
                                    <input type="radio" class="btn-check" name="role" id="role_hospital" value="hospital"
                                           {{ old('role') == 'hospital' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-primary w-100" for="role_hospital">
                                        <i class="bi bi-hospital-fill me-1"></i> Hospital
                                    </label>
                                </div>
                            </div>
                            @error('role')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-lock-fill text-danger"></i></span>
                                <input type="password" name="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       required placeholder="Min. 8 characters">
                                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Confirm Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-lock-fill text-danger"></i></span>
                                <input type="password" name="password_confirmation"
                                       class="form-control" required placeholder="Repeat password">
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-danger btn-lg">
                                <i class="bi bi-person-plus-fill me-1"></i> Create Account
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center mt-3">
                <span class="text-muted small">Already have an account?</span>
                <a href="{{ route('login') }}" class="text-danger fw-bold small ms-1">Login here</a>
            </div>
        </div>
    </div>
</div>
@endsection
