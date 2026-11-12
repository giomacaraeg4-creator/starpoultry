
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Dashboard') | Star Poultry Farm</title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Laravel CSS -->
    @vite(['resources/css/app.css'])
</head>

<body>

@php
    $isAdmin = session('role') === 'ADMIN';

    $dashboardRoute = $isAdmin
        ? 'admin.dashboard'
        : 'employee.dashboard';
@endphp

<!-- SIDEBAR -->
<aside class="sidebar">

    <!-- BRAND -->
    <div class="brand">
        <div class="brand-logo">
            <i class="fa-solid fa-star"></i>
        </div>

        <div class="brand-info">
            <h1>STAR POULTRY</h1>
            <span>SMART FARM MANAGEMENT</span>
        </div>
    </div>

    <!-- NAVIGATION -->
    <nav class="sidebar-nav">

        <!-- MAIN MENU -->
        <div class="nav-group">
            <p class="nav-label">MAIN MENU</p>

            <a href="{{ route($dashboardRoute) }}"
               class="nav-link {{ request()->routeIs('admin.dashboard', 'employee.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-chart-pie"></i>
                <span>Dashboard</span>
            </a>
        </div>

        @if(!$isAdmin)

            <!-- FARM MONITORING -->
            <div class="nav-group">
                <p class="nav-label">FARM MONITORING</p>

                <a href="#" class="nav-link">
                    <i class="fa-solid fa-microchip"></i>
                    <span>Sensor Monitoring</span>
                    <span class="nav-tag">IoT</span>
                </a>

                <a href="#" class="nav-link">
                    <i class="fa-solid fa-video"></i>
                    <span>Camera Monitoring</span>
                </a>

                <a href="#" class="nav-link">
                    <i class="fa-solid fa-feather-pointed"></i>
                    <span>Chicken Activity</span>
                </a>

                <a href="#" class="nav-link">
                    <i class="fa-solid fa-weight-scale"></i>
                    <span>Weight Estimation</span>
                </a>
            </div>

            <!-- FARM OPERATIONS -->
            <div class="nav-group">
                <p class="nav-label">FARM OPERATIONS</p>

                <a href="#" class="nav-link">
                    <i class="fa-solid fa-wheat-awn"></i>
                    <span>Automated Feeding</span>
                </a>

                <a href="#" class="nav-link">
                    <i class="fa-solid fa-droplet"></i>
                    <span>Water Management</span>
                </a>

                <a href="#" class="nav-link">
                    <i class="fa-solid fa-recycle"></i>
                    <span>Waste Management</span>
                </a>

                <a href="#" class="nav-link">
                    <i class="fa-solid fa-boxes-stacked"></i>
                    <span>Inventory</span>
                </a>

                <a href="#" class="nav-link">
                    <i class="fa-solid fa-truck-field"></i>
                    <span>Suppliers</span>
                </a>

                <a href="#" class="nav-link">
                    <i class="fa-solid fa-chart-line"></i>
                    <span>Predictive Analytics</span>
                </a>
            </div>

            <!-- SYSTEM -->
            <div class="nav-group">
                <p class="nav-label">SYSTEM</p>

                <a href="#" class="nav-link">
                    <i class="fa-solid fa-file-lines"></i>
                    <span>Reports</span>
                </a>
            </div>

        @else

            <!-- ACCOUNT MANAGEMENT -->
            <div class="nav-group">
                <p class="nav-label">ACCOUNT MANAGEMENT</p>

                <a href="{{ route('admin.accounts.index') }}"
                   class="nav-link {{ request()->routeIs('admin.accounts.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-users-gear"></i>
                    <span>Account Management</span>
                </a>
            </div>

            <!-- FARM SYSTEM OVERVIEW -->
            <div class="nav-group">
                <p class="nav-label">FARM SYSTEM OVERVIEW</p>

                <a href="#" class="nav-link">
                    <i class="fa-solid fa-microchip"></i>
                    <span>Sensors Overview</span>
                </a>

                <a href="#" class="nav-link">
                    <i class="fa-solid fa-video"></i>
                    <span>Camera Overview</span>
                </a>

                <a href="#" class="nav-link">
                    <i class="fa-solid fa-boxes-stacked"></i>
                    <span>Inventory Overview</span>
                </a>

                <a href="#" class="nav-link">
                    <i class="fa-solid fa-file-lines"></i>
                    <span>System Reports</span>
                </a>
            </div>

            <!-- SYSTEM SETTINGS -->
            <div class="nav-group">
                <p class="nav-label">SYSTEM</p>

                <a href="#" class="nav-link">
                    <i class="fa-solid fa-gear"></i>
                    <span>System Settings</span>
                </a>
            </div>

        @endif

    </nav>

    <!-- SIDEBAR FOOTER -->
    <div class="sidebar-footer">

        <div class="sidebar-user">
            <div class="user-avatar">
                {{ strtoupper(substr(session('user_name', 'U'), 0, 1)) }}
            </div>

            <div class="user-details">
                <strong>{{ session('user_name', 'User') }}</strong>
                <span>
                    {{ $isAdmin ? 'System Administrator' : 'Farm Supervisor' }}
                </span>
            </div>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf

            <button type="submit" class="logout-btn">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Sign Out</span>
            </button>
        </form>

    </div>

</aside>

<!-- MAIN AREA -->
<div class="main">

    <!-- TOPBAR -->
    <header class="topbar">

        <div class="topbar-left">
            <h2>@yield('page-heading', 'Dashboard')</h2>

            <span class="topbar-subtitle">
                Star Poultry Farm Management System
            </span>
        </div>

        <div class="topbar-right">

            <div class="system-status">
                <span class="status-dot"></span>
                <span>System Dashboard</span>
            </div>

            <div class="topbar-divider"></div>

            <div class="topbar-profile">
                <div class="profile-avatar">
                    {{ strtoupper(substr(session('user_name', 'U'), 0, 1)) }}
                </div>

                <div class="profile-info">
                    <strong>{{ session('user_name', 'User') }}</strong>
                    <span>
                        {{ $isAdmin ? 'Administrator' : 'Farm Supervisor' }}
                    </span>
                </div>
            </div>

        </div>

    </header>

    <!-- PAGE CONTENT -->
    <main class="content">
        @yield('content')
    </main>

</div>

</body>
</html>
