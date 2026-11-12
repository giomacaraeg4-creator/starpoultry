
@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page-heading', 'System Overview')

@section('content')

<div class="dashboard-container">

    <!-- WELCOME BANNER -->
    <section class="welcome-banner">
        <div>
            <h1>Welcome, Administrator!</h1>
            <p>
                Manage system accounts and monitor the overall
                operations of Star Poultry Farm.
            </p>
        </div>

        <div class="banner-icon">
            <i class="fa-solid fa-star"></i>
        </div>
    </section>

    <!-- SYSTEM STATISTICS -->
    <section class="dashboard-section">

        <div class="dashboard-section-title">
            <h2>System Statistics</h2>
            <p>Summary of registered farm resources and operations</p>
        </div>

        <div class="dashboard-cards">

            <div class="dashboard-card">
                <div class="card-top">
                    <span class="card-label">Registered Sensors</span>
                    <div class="card-icon icon-green">
                        <i class="fa-solid fa-microchip"></i>
                    </div>
                </div>

                <div class="card-value">
                    {{ $stats['sensors'] }}
                </div>

                <p class="card-description">
                    Sensors registered in the system
                </p>
            </div>

            <div class="dashboard-card">
                <div class="card-top">
                    <span class="card-label">Inventory Items</span>
                    <div class="card-icon icon-blue">
                        <i class="fa-solid fa-boxes-stacked"></i>
                    </div>
                </div>

                <div class="card-value">
                    {{ $stats['inventory'] }}
                </div>

                <p class="card-description">
                    Registered inventory records
                </p>
            </div>

            <div class="dashboard-card">
                <div class="card-top">
                    <span class="card-label">Feeding Schedules</span>
                    <div class="card-icon icon-amber">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                </div>

                <div class="card-value">
                    {{ $stats['feeding'] }}
                </div>

                <p class="card-description">
                    Registered feeding schedules
                </p>
            </div>

            <div class="dashboard-card">
                <div class="card-top">
                    <span class="card-label">Low Stock Items</span>
                    <div class="card-icon icon-red">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>
                </div>

                <div class="card-value">
                    {{ $stats['low_stock'] }}
                </div>

                <p class="card-description">
                    Items requiring stock attention
                </p>
            </div>

        </div>
    </section>

    <!-- CAMERA AND FARM OVERVIEW -->
    <section class="dashboard-section">

        <div class="dashboard-section-title">
            <h2>Farm System Overview</h2>
            <p>Camera monitoring and registered farm resources</p>
        </div>

        <div class="dashboard-grid">

            <!-- CAMERA PREVIEW -->
            <div class="section">

                <div class="section-header">
                    <h3>
                        <i class="fa-solid fa-video"></i>
                        Chicken Camera Preview
                    </h3>

                    <span class="badge badge-warning">
                        {{ $cameraStreamUrl ? 'STREAM CONFIGURED' : 'NOT CONNECTED' }}
                    </span>
                </div>

                <div class="camera-frame">

                    @if($cameraStreamUrl)

                        <img
                            src="{{ $cameraStreamUrl }}"
                            alt="Poultry farm camera preview"
                        >

                    @else

                        <div class="camera-placeholder">
                            <i class="fa-solid fa-video-slash"></i>

                            <h3>Camera Not Connected</h3>

                            <p>
                                Your poultry camera preview will appear
                                here once the camera stream is configured.
                            </p>
                        </div>

                    @endif

                </div>

                <div class="camera-details">
                    <span>
                        <i class="fa-solid fa-camera"></i>
                        Poultry House Camera
                    </span>

                    <span>
                        {{ $cameraStreamUrl ? 'Stream configured' : 'Waiting for connection' }}
                    </span>
                </div>

            </div>

            <!-- FARM OVERVIEW -->
            <div class="section">

                <div class="section-header">
                    <h3>
                        <i class="fa-solid fa-chart-pie"></i>
                        Farm Overview
                    </h3>
                </div>

                <div class="status-item">
                    <span class="status-name">
                        <i class="fa-solid fa-video"></i>
                        Registered Cameras
                    </span>

                    <strong>{{ $stats['cameras'] }}</strong>
                </div>

                <div class="status-item">
                    <span class="status-name">
                        <i class="fa-solid fa-users"></i>
                        Registered Accounts
                    </span>

                    <strong>{{ $stats['accounts'] }}</strong>
                </div>

                <div class="status-item">
                    <span class="status-name">
                        <i class="fa-solid fa-feather-pointed"></i>
                        Latest Detected Chickens
                    </span>

                    <strong>
                        {{ $latestRecording?->detected_chicken_count ?? 0 }}
                    </strong>
                </div>

                <div class="status-item">
                    <span class="status-name">
                        <i class="fa-solid fa-box"></i>
                        Inventory Records
                    </span>

                    <strong>{{ $stats['inventory'] }}</strong>
                </div>

                <div class="status-item">
                    <span class="status-name">
                        <i class="fa-solid fa-clock"></i>
                        Feeding Schedules
                    </span>

                    <strong>{{ $stats['feeding'] }}</strong>
                </div>

                <div class="section-footer-link">
                    <a href="{{ route('admin.accounts.index') }}">
                        Manage System Accounts
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>

            </div>

        </div>

    </section>

    <!-- ENVIRONMENTAL READINGS -->
    <section class="dashboard-section">

        <div class="section">

            <div class="section-header">
                <div>
                    <h3>
                        <i class="fa-solid fa-temperature-half"></i>
                        Latest Environmental Readings
                    </h3>

                    <p class="section-description">
                        Recent recorded sensor measurements
                    </p>
                </div>

                <span class="badge badge-success">
                    LATEST 5 RECORDS
                </span>
            </div>

            <div class="table-wrapper">

                <table class="dashboard-table">

                    <thead>
                        <tr>
                            <th>Sensor Name</th>
                            <th>Sensor Type</th>
                            <th>Reading</th>
                            <th>Date Recorded</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($latestReadings as $reading)

                            <tr>
                                <td>
                                    <strong>
                                        {{ $reading->sensor_name }}
                                    </strong>
                                </td>

                                <td>
                                    {{ $reading->sensor_type }}
                                </td>

                                <td>
                                    <span class="reading-value">
                                        {{ $reading->reading_value }}
                                        {{ $reading->measurement_unit }}
                                    </span>
                                </td>

                                <td>
                                    {{ $reading->recorded_at }}
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="4" class="empty">
                                    <i class="fa-solid fa-database"></i>

                                    <p>No environmental readings available.</p>
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </section>

</div>

@endsection
