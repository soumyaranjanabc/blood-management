<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BloodMS — Blood Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        body { background: #f0f2f5; }

        /* ── Sidebar ── */
        .sidebar {
            min-height: 100vh;
            width: 260px;
            position: fixed;
            top: 0; left: 0;
            z-index: 100;
            background: #1a1a2e;
            display: flex;
            flex-direction: column;
            box-shadow: 4px 0 20px rgba(0,0,0,0.3);
        }
        .sidebar-brand {
            padding: 24px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .sidebar-brand .brand-icon {
            width: 42px; height: 42px;
            background: linear-gradient(135deg, #e63946, #c1121f);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            box-shadow: 0 4px 15px rgba(230,57,70,0.4);
        }
        .sidebar-brand .brand-text {
            color: #fff;
            font-weight: 800;
            font-size: 1.1rem;
            line-height: 1.2;
        }
        .sidebar-brand .brand-sub {
            color: rgba(255,255,255,0.4);
            font-size: 0.7rem;
            font-weight: 400;
        }
        .nav-section-label {
            color: rgba(255,255,255,0.3);
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            padding: 20px 20px 6px;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.6);
            padding: 11px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 0;
            transition: all 0.25s;
            position: relative;
            margin: 2px 10px;
            border-radius: 10px;
        }
        .sidebar .nav-link i {
            width: 20px;
            font-size: 1rem;
            text-align: center;
        }
        .sidebar .nav-link:hover {
            color: #fff;
            background: rgba(255,255,255,0.08);
        }
        .sidebar .nav-link.active {
            color: #fff;
            background: linear-gradient(135deg, #e63946, #c1121f);
            box-shadow: 0 4px 15px rgba(230,57,70,0.35);
        }
        .sidebar-footer {
            margin-top: auto;
            padding: 16px;
            border-top: 1px solid rgba(255,255,255,0.08);
        }
        .user-card {
            background: rgba(255,255,255,0.06);
            border-radius: 12px;
            padding: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .user-avatar {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, #e63946, #c1121f);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: 0.85rem;
            flex-shrink: 0;
        }
        .user-name {
            color: #fff;
            font-size: 0.82rem;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .user-role {
            color: rgba(255,255,255,0.4);
            font-size: 0.7rem;
        }

        /* ── Main Content ── */
        .main-content { margin-left: 260px; }

        /* ── Topbar ── */
        .topbar {
            background: #fff;
            padding: 14px 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 99;
            box-shadow: 0 1px 20px rgba(0,0,0,0.06);
        }
        .topbar-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #1a1a2e;
        }
        .topbar-title span {
            color: #e63946;
        }

        /* ── Content ── */
        .content-area { padding: 28px; }

        /* ── Stat Cards ── */
        .stat-card {
            border: none;
            border-radius: 16px;
            padding: 24px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: transform 0.25s, box-shadow 0.25s;
        }
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        }
        .stat-card .stat-icon {
            width: 52px; height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            background: rgba(255,255,255,0.2);
            margin-bottom: 16px;
        }
        .stat-card .stat-value {
            font-size: 2rem;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 4px;
        }
        .stat-card .stat-label {
            font-size: 0.82rem;
            opacity: 0.85;
            font-weight: 500;
        }
        .stat-card .stat-bg-icon {
            position: absolute;
            right: -10px;
            bottom: -10px;
            font-size: 6rem;
            opacity: 0.08;
        }
        .card-red    { background: linear-gradient(135deg, #e63946, #c1121f); color: #fff; }
        .card-blue   { background: linear-gradient(135deg, #4361ee, #3a0ca3); color: #fff; }
        .card-green  { background: linear-gradient(135deg, #2dc653, #1a7a31); color: #fff; }
        .card-orange { background: linear-gradient(135deg, #f77f00, #d62828); color: #fff; }
        .card-purple { background: linear-gradient(135deg, #7b2d8b, #4a0e8f); color: #fff; }
        .card-teal   { background: linear-gradient(135deg, #0096c7, #005f73); color: #fff; }

        /* ── Section Cards ── */
        .section-card {
            background: #fff;
            border-radius: 16px;
            border: none;
            box-shadow: 0 2px 15px rgba(0,0,0,0.06);
            overflow: hidden;
        }
        .section-card .section-header {
            padding: 18px 22px;
            border-bottom: 1px solid #f0f2f5;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .section-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: #1a1a2e;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .section-title i { color: #e63946; }

        /* ── Tables ── */
        .table { margin: 0; }
        .table thead th {
            background: #f8f9fa;
            color: #6c757d;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
            padding: 12px 16px;
        }
        .table tbody td {
            padding: 13px 16px;
            vertical-align: middle;
            border-color: #f0f2f5;
            font-size: 0.875rem;
            color: #2d3748;
        }
        .table tbody tr:hover { background: #fafafa; }

        /* ── Blood Badge ── */
        .blood-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px; height: 36px;
            background: linear-gradient(135deg, #e63946, #c1121f);
            color: #fff;
            border-radius: 10px;
            font-weight: 800;
            font-size: 0.7rem;
            box-shadow: 0 3px 10px rgba(230,57,70,0.3);
        }

        /* ── Status Badges ── */
        .badge-pending   { background: #fff3cd; color: #856404; border: 1px solid #ffc107; }
        .badge-approved  { background: #d1e7dd; color: #0f5132; border: 1px solid #2dc653; }
        .badge-rejected  { background: #f8d7da; color: #842029; border: 1px solid #e63946; }
        .badge-fulfilled { background: #cfe2ff; color: #084298; border: 1px solid #4361ee; }
        .badge-normal    { background: #e2e3e5; color: #383d41; border: 1px solid #999; }
        .badge-urgent    { background: #ffe5d0; color: #7d3c01; border: 1px solid #f77f00; }
        .badge-critical  { background: #f8d7da; color: #842029; border: 1px solid #e63946; }
        .badge-verified  { background: #d1e7dd; color: #0f5132; border: 1px solid #2dc653; }
        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        /* ── Buttons ── */
        .btn-blood {
            background: linear-gradient(135deg, #e63946, #c1121f);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.85rem;
            padding: 8px 18px;
            box-shadow: 0 4px 12px rgba(230,57,70,0.3);
            transition: all 0.25s;
        }
        .btn-blood:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(230,57,70,0.4);
            color: #fff;
        }
        .btn-action {
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            padding: 6px 14px;
        }

        /* ── Inventory Grid ── */
        .inventory-item {
            background: #fff;
            border-radius: 16px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 15px rgba(0,0,0,0.06);
            border: 2px solid transparent;
            transition: all 0.25s;
        }
        .inventory-item:hover {
            border-color: #e63946;
            transform: translateY(-3px);
        }
        .inventory-item .inv-blood {
            width: 56px; height: 56px;
            background: linear-gradient(135deg, #e63946, #c1121f);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 800;
            font-size: 0.9rem;
            margin: 0 auto 12px;
            box-shadow: 0 4px 15px rgba(230,57,70,0.3);
        }
        .inventory-item .inv-count {
            font-size: 1.8rem;
            font-weight: 800;
            color: #1a1a2e;
            line-height: 1;
        }
        .inventory-item .inv-label {
            font-size: 0.75rem;
            color: #6c757d;
            margin-top: 4px;
        }
        .inv-progress {
            height: 5px;
            border-radius: 10px;
            background: #f0f2f5;
            margin-top: 10px;
            overflow: hidden;
        }
        .inv-progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #e63946, #c1121f);
            border-radius: 10px;
        }

        /* ── Alerts ── */
        .alert-success {
            background: #d1e7dd;
            border: none;
            border-left: 4px solid #2dc653;
            border-radius: 10px;
            color: #0f5132;
        }
        .alert-danger {
            background: #f8d7da;
            border: none;
            border-left: 4px solid #e63946;
            border-radius: 10px;
            color: #842029;
        }
        .alert-warning {
            background: #fff3cd;
            border: none;
            border-left: 4px solid #ffc107;
            border-radius: 10px;
            color: #856404;
        }

        /* ── Form Controls ── */
        .form-control, .form-select {
            border-radius: 10px;
            border: 1.5px solid #e2e8f0;
            padding: 10px 14px;
            font-size: 0.875rem;
            transition: all 0.2s;
        }
        .form-control:focus, .form-select:focus {
            border-color: #e63946;
            box-shadow: 0 0 0 3px rgba(230,57,70,0.1);
        }
        .form-label {
            font-weight: 600;
            font-size: 0.82rem;
            color: #4a5568;
            margin-bottom: 6px;
        }

        /* ── Page Header ── */
        .page-header {
            margin-bottom: 24px;
        }
        .page-header h4 {
            font-weight: 800;
            color: #1a1a2e;
            margin: 0;
        }
        .page-header p {
            color: #6c757d;
            font-size: 0.875rem;
            margin: 4px 0 0;
        }

        @media (max-width: 768px) {
            .sidebar { display: none; }
            .main-content { margin-left: 0; }
        }
    </style>
</head>
<body>

@auth
<div class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon">🩸</div>
        <div>
            <div class="brand-text">BloodMS</div>
            <div class="brand-sub">Management System</div>
        </div>
    </div>

    @if(auth()->user()->isAdmin())
        <div class="nav-section-label">Main</div>
        <a href="{{ route('admin.dashboard') }}"
           class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-fill"></i> Dashboard
        </a>
        <div class="nav-section-label">Management</div>
        <a href="{{ route('admin.donors') }}"
           class="nav-link {{ request()->routeIs('admin.donors*') ? 'active' : '' }}">
            <i class="bi bi-people-fill"></i> Donors
        </a>
        <a href="{{ route('admin.hospitals') }}"
           class="nav-link {{ request()->routeIs('admin.hospitals*') ? 'active' : '' }}">
            <i class="bi bi-hospital-fill"></i> Hospitals
        </a>
        <a href="{{ route('admin.requests') }}"
           class="nav-link {{ request()->routeIs('admin.requests*') ? 'active' : '' }}">
            <i class="bi bi-clipboard2-pulse-fill"></i> Blood Requests
        </a>
        <a href="{{ route('admin.inventory') }}"
           class="nav-link {{ request()->routeIs('admin.inventory*') ? 'active' : '' }}">
            <i class="bi bi-droplet-half"></i> Inventory
        </a>
        <a href="{{ route('admin.donations') }}"
           class="nav-link {{ request()->routeIs('admin.donations*') ? 'active' : '' }}">
            <i class="bi bi-patch-check-fill"></i> Verify Donations
        </a>
        <div class="nav-section-label">System</div>
        <a href="{{ route('admin.users') }}"
           class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
            <i class="bi bi-person-gear"></i> Manage Users
        </a>

    @elseif(auth()->user()->isDonor())
        <div class="nav-section-label">Main</div>
        <a href="{{ route('donor.dashboard') }}"
           class="nav-link {{ request()->routeIs('donor.dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-fill"></i> Dashboard
        </a>
        <div class="nav-section-label">Actions</div>
        <a href="{{ route('donor.profile') }}"
           class="nav-link {{ request()->routeIs('donor.profile') ? 'active' : '' }}">
            <i class="bi bi-person-fill"></i> My Profile
        </a>
        <a href="{{ route('donor.inventory') }}"
           class="nav-link {{ request()->routeIs('donor.inventory') ? 'active' : '' }}">
            <i class="bi bi-droplet-half"></i> Blood Availability
        </a>
        <a href="{{ route('donor.donations') }}"
           class="nav-link {{ request()->routeIs('donor.donations*') ? 'active' : '' }}">
            <i class="bi bi-droplet-fill"></i> My Donations
        </a>

    @elseif(auth()->user()->isHospital())
        <div class="nav-section-label">Main</div>
        <a href="{{ route('hospital.dashboard') }}"
           class="nav-link {{ request()->routeIs('hospital.dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-fill"></i> Dashboard
        </a>
        <div class="nav-section-label">Actions</div>
        <a href="{{ route('hospital.profile') }}"
           class="nav-link {{ request()->routeIs('hospital.profile') ? 'active' : '' }}">
            <i class="bi bi-hospital-fill"></i> Hospital Profile
        </a>
        <a href="{{ route('hospital.inventory') }}"
           class="nav-link {{ request()->routeIs('hospital.inventory') ? 'active' : '' }}">
            <i class="bi bi-droplet-half"></i> Blood Availability
        </a>
        <a href="{{ route('hospital.requests') }}"
           class="nav-link {{ request()->routeIs('hospital.requests*') ? 'active' : '' }}">
            <i class="bi bi-clipboard2-pulse-fill"></i> My Requests
        </a>
    @endif

    <div class="sidebar-footer">
        <div class="user-card">
            <div class="user-avatar">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div style="overflow:hidden;">
                <div class="user-name">{{ auth()->user()->name }}</div>
                <div class="user-role">{{ ucfirst(auth()->user()->role) }}</div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="ms-auto">
                @csrf
                <button type="submit" class="btn p-0 border-0 bg-transparent"
                        title="Logout" style="color:rgba(255,255,255,0.4);font-size:1.1rem;">
                    <i class="bi bi-box-arrow-right"></i>
                </button>
            </form>
        </div>
    </div>
</div>

<div class="main-content">
    <div class="topbar">
        <div class="topbar-title">🩸 <span>Blood</span> Management System</div>
        <div class="d-flex align-items-center gap-2">
            <span class="badge rounded-pill px-3 py-2"
                  style="background:linear-gradient(135deg,#e63946,#c1121f);font-size:0.78rem;">
                <i class="bi bi-shield-fill-check me-1"></i>
                {{ ucfirst(auth()->user()->role) }}
            </span>
        </div>
    </div>

    <div class="content-area">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        @yield('content')
    </div>
</div>

@else
<nav class="navbar navbar-expand-lg bg-white border-bottom" style="box-shadow:0 2px 15px rgba(0,0,0,0.06);">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="/">
            <div style="width:36px;height:36px;background:linear-gradient(135deg,#e63946,#c1121f);border-radius:10px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.1rem;">🩸</div>
            <span style="font-weight:800;color:#1a1a2e;">BloodMS</span>
        </a>
        <div class="ms-auto d-flex gap-2">
            <a href="{{ route('login') }}" class="btn btn-outline-danger rounded-pill px-4" style="font-weight:600;">Login</a>
            <a href="{{ route('register') }}" class="btn btn-blood rounded-pill px-4">Register</a>
        </div>
    </div>
</nav>
<div class="container mt-4">
    @yield('content')
</div>
@endauth

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>
