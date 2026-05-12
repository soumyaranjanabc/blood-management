@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height:80vh;">
        <div class="col-md-5">
            <div class="text-center mb-4">
                <div style="font-size:3rem;">🩸</div>
                <h3 class="fw-bold text-danger">Blood Management System</h3>
                <p class="text-muted">Sign in to your account</p>
            </div>
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-envelope-fill text-danger"></i></span>
                                <input type="email" name="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       value="{{ old('email') }}" required autofocus
                                       placeholder="Enter your email">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-lock-fill text-danger"></i></span>
                                <input type="password" name="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       required placeholder="Enter your password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label small" for="remember">Remember Me</label>
                            </div>
                            @if(Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="small text-danger">Forgot Password?</a>
                            @endif
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-danger btn-lg">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Login
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="text-center mt-3">
                <span class="text-muted small">Don't have an account?</span>
                <a href="{{ route('register') }}" class="text-danger fw-bold small ms-1">Register here</a>
            </div>

            {{-- Quick Login Hints --}}
            <div class="card mt-4 border-0 bg-light">
                <div class="card-body p-3">
                    <p class="small fw-bold text-muted mb-2">🔑 Demo Accounts:</p>
                    <div class="small text-muted">
                        <div><b>Admin:</b> admin@blood.com / password</div>
                        <div><b>Donor:</b> donor@blood.com / password</div>
                        <div><b>Hospital:</b> hospital@blood.com / password</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
