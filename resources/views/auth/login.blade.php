@extends('layouts.app')
@section('content')
<div class="min-vh-100 d-flex align-items-center justify-content-center"
     style="background:linear-gradient(135deg,#1a1a2e 0%,#16213e 50%,#0f3460 100%);margin:-1.5rem;">
    <div class="row w-100 justify-content-center px-3">
        <div class="col-md-10 col-lg-8">
            <div class="row g-0 shadow-lg" style="border-radius:24px;overflow:hidden;min-height:520px;">

                {{-- Left Panel --}}
                <div class="col-md-5 d-none d-md-flex flex-column align-items-center justify-content-center p-5"
                     style="background:linear-gradient(135deg,#e63946,#c1121f);">
                    <div style="font-size:4rem;">🩸</div>
                    <h3 class="text-white fw-800 mt-3 text-center" style="font-weight:800;">BloodMS</h3>
                    <p class="text-white text-center mt-2" style="opacity:0.85;font-size:0.9rem;">
                        Connecting donors, hospitals and blood banks for a healthier world.
                    </p>
                    <div class="mt-4 w-100">
                        @foreach(['🩸 Donor Registration','🏥 Hospital Management','📊 Real-time Inventory'] as $f)
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <div style="width:8px;height:8px;background:#fff;border-radius:50%;opacity:0.7;"></div>
                            <span style="color:rgba(255,255,255,0.85);font-size:0.82rem;">{{ $f }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Right Panel --}}
                <div class="col-md-7 d-flex flex-column justify-content-center p-5" style="background:#fff;">
                    <h4 style="font-weight:800;color:#1a1a2e;">Welcome back 👋</h4>
                    <p class="text-muted mb-4" style="font-size:0.875rem;">Sign in to your account to continue</p>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text" style="background:#f8f9fa;border-right:none;border-radius:10px 0 0 10px;">
                                    <i class="bi bi-envelope-fill text-danger"></i>
                                </span>
                                <input type="email" name="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       style="border-left:none;border-radius:0 10px 10px 0;"
                                       value="{{ old('email') }}" placeholder="you@example.com" required autofocus>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text" style="background:#f8f9fa;border-right:none;border-radius:10px 0 0 10px;">
                                    <i class="bi bi-lock-fill text-danger"></i>
                                </span>
                                <input type="password" name="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       style="border-left:none;border-radius:0 10px 10px 0;"
                                       placeholder="••••••••" required>
                                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label small" for="remember">Remember me</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-blood w-100 py-2" style="font-size:0.95rem;">
                            <i class="bi bi-box-arrow-in-right me-2"></i> Sign In
                        </button>
                    </form>

                    <div class="text-center mt-4">
                        <span class="text-muted small">Don't have an account? </span>
                        <a href="{{ route('register') }}" class="text-danger fw-bold small">Create one</a>
                    </div>

                    <div class="mt-4 p-3 rounded-3" style="background:#fff8f8;border:1px dashed #e63946;">
                        <p class="small fw-bold text-danger mb-1">🔑 Demo Accounts</p>
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
</div>
@endsection
