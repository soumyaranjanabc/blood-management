<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #c0392b 0%, #922b21 100%);
            width: 250px;
            position: fixed;
            top: 0; left: 0;
            z-index: 100;
            padding-top: 20px;
        }
        .sidebar .brand {
            color: #fff;
            font-size: 1.2rem;
            font-weight: 700;
            padding: 10px 20px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.85);
            padding: 10px 20px;
            border-radius: 0;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.2s;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: rgba(255,255,255,0.15);
            color: #fff;
            padding-left: 28px;
        }
        .sidebar .nav-section {
            color: rgba(255,255,255,0.5);
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 15px 20px 5px;
        }
        .main-content {
            margin-left: 250px;
            padding: 0;
        }
        .topbar {
            background: #fff;
            border-bottom: 1px solid #dee2e6;
            padding: 12px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 99;
        }
        .topbar .page-title {
            font-weight: 600;
            font-size: 1.1rem;
            color: #333;
        }
        .content-area { padding: 25px; }
        .stat-card {
            border-radius: 12px;
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.07);
            transition: transform 0.2s;
        }
        .stat-card:hover { transform: translateY(-3px); }
        .badge-pending   { background-color: #ffc107; color: #000; }
        .badge-approved  { background-color: #198754; color: #fff; }
        .badge-rejected  { background-color: #dc3545; color: #fff; }
        .badge-fulfilled { background-color: #0d6efd; color: #fff; }
        .badge-normal    { background-color: #6c757d; color: #fff; }
        .badge-urgent    { background-color: #fd7e14; color: #fff; }
        .badge-critical  { background-color: #dc3545; color: #fff; }
        .blood-badge {
            display: inline-block;
            background: #dc3545;
            color: #fff;
            border-radius: 50%;
            width: 38px; height: 38px;
            line-height: 38px;
            text-align: center;
            font-weight: 700;
            font-size: 0.75rem;
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
    <div class="brand">
        <i class="bi bi-droplet-fill text-white"></i> BloodMS
    </div>

    @if(auth()->user()->isAdmin())
        <div class="nav-section">Main</div>
        <a href="{{ route('admin.dashboard') }}"
           class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
        <div class="nav-section">Management</div>
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
        <div class="nav-section">Users</div>
        <a href="{{ route('admin.users') }}"
           class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
            <i class="bi bi-person-gear"></i> Manage Users
        </a>

    @elseif(auth()->user()->isDonor())
        <div class="nav-section">Main</div>
        <a href="{{ route('donor.dashboard') }}"
           class="nav-link {{ request()->routeIs('donor.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
        <div class="nav-section">Actions</div>
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
        <div class="nav-section">Main</div>
        <a href="{{ route('hospital.dashboard') }}"
           class="nav-link {{ request()->routeIs('hospital.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
        <div class="nav-section">Actions</div>
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
</div>

<div class="main-content">
    <div class="topbar">
        <span class="page-title">🩸 Blood Management System</span>
        <div class="d-flex align-items-center gap-3">
            <span class="text-muted small">
                <i class="bi bi-person-circle"></i>
                {{ auth()->user()->name }}
                <span class="badge bg-danger ms-1">{{ ucfirst(auth()->user()->role) }}</span>
            </span>
            <form method="POST" action="{{ route('logout') }}" class="mb-0">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
    </div>
    <div class="content-area">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @yield('content')
    </div>
</div>

@else
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
    <div class="container">
        <a class="navbar-brand fw-bold text-danger" href="/">
            <i class="bi bi-droplet-fill"></i> Blood Management System
        </a>
        <div class="ms-auto">
            <a href="{{ route('login') }}" class="btn btn-outline-danger me-2">Login</a>
            <a href="{{ route('register') }}" class="btn btn-danger">Register</a>
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
