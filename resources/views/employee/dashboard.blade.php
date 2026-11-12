
@extends('layouts.admin')

@section('title', 'Farm Supervisor Dashboard')
@section('page-heading', 'Farm Overview')

@section('content')

<div class="dashboard-container">

    <!-- WELCOME BANNER -->
    <section class="welcome-banner">
        <div>
            <h1>Welcome, Farm Supervisor!</h1>
            <p>
                Monitor and manage Star Poultry Farm operations
                through your centralized farm management dashboard.
            </p>
        </div>

        <div class="banner-icon">
            <i class="fa-solid fa-egg"></i>
        </div>
    </section>

    <!-- FARM OVERVIEW -->
    <section class="dashboard-section">

        <div class="dashboard-section-title">
            <h2>Farm Overview</h2>
            <p>General information about farm operations</p>
        </div>

        <div class="dashboard-cards">

            <div class="dashboard-card">
                <div class="card-top">
                    <span class="card-label">Total Chickens</span>
                    <div class="card-icon icon-green">
                        <i class="fa-solid fa-crow"></i>
                    </div>
                </div>
                <div class="card-value">5,000</div>
                <p class="card-description">Farm chicken population</p>
            </div>

            <div class="dashboard-card">
                <div class="card-top">
                    <span class="card-label">Feeding Schedule</span>
                    <div class="card-icon icon-amber">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                </div>
                <div class="card-value">2 Times</div>
                <p class="card-description">5:00 AM and 1:00 PM daily</p>
            </div>

            <div class="dashboard-card">
                <div class="card-top">
                    <span class="card-label">Feed Consumption</span>
                    <div class="card-icon icon-blue">
                        <i class="fa-solid fa-wheat-awn"></i>
                    </div>
                </div>
                <div class="card-value">12 Sacks</div>
                <p class="card-description">Average daily feed consumption</p>
            </div>

            <div class="dashboard-card">
                <div class="card-top">
                    <span class="card-label">Growing Period</span>
                    <div class="card-icon icon-purple">
                        <i class="fa-solid fa-calendar-days"></i>
                    </div>
                </div>
                <div class="card-value">45 Days</div>
                <p class="card-description">Approximate growing cycle</p>
            </div>

        </div>
    </section>

    <!-- FARM CLIMATE MONITORING -->
    <section class="dashboard-section">

        <div class="dashboard-section-title">
            <h2>Farm Climate Monitoring</h2>
            <p>Environmental sensor monitoring and hardware connection status</p>
        </div>

        <div class="monitoring-grid">

            <div class="dashboard-card">
                <div class="card-top">
                    <span class="card-label">Temperature</span>
                    <div class="card-icon icon-amber">
                        <i class="fa-solid fa-temperature-half"></i>
                    </div>
                </div>

                <div class="card-value">-- °C</div>
                <p class="card-description">Waiting for sensor data</p>
                <span class="badge badge-warning">No Sensor Data</span>
            </div>

            <div class="dashboard-card">
                <div class="card-top">
                    <span class="card-label">Humidity</span>
                    <div class="card-icon icon-blue">
                        <i class="fa-solid fa-droplet"></i>
                    </div>
                </div>

                <div class="card-value">-- %</div>
                <p class="card-description">Waiting for sensor data</p>
                <span class="badge badge-warning">No Sensor Data</span>
            </div>

            <div class="dashboard-card">
                <div class="card-top">
                    <span class="card-label">Camera Status</span>
                    <div class="card-icon icon-purple">
                        <i class="fa-solid fa-video"></i>
                    </div>
                </div>

                <div class="card-value">Offline</div>
                <p class="card-description">Camera connection not yet established</p>
                <span class="badge badge-warning">Not Connected</span>
            </div>

        </div>

    </section>

    <!-- FARM OPERATIONS -->
    <section class="dashboard-section">

        <div class="dashboard-section-title">
            <h2>Farm Operations</h2>
            <p>Management modules of Star Poultry Farm</p>
        </div>

        <div class="operation-grid">

            <div class="operation-card">
                <div class="operation-icon">
                    <i class="fa-solid fa-wheat-awn"></i>
                </div>
                <div>
                    <h3>Automated Feeding</h3>
                    <p>Manage feeding schedules and feeding operations.</p>
                </div>
            </div>

            <div class="operation-card">
                <div class="operation-icon">
                    <i class="fa-solid fa-droplet"></i>
                </div>
                <div>
                    <h3>Water Management</h3>
                    <p>Monitor water filtration and electrolyte regulation.</p>
                </div>
            </div>

            <div class="operation-card">
                <div class="operation-icon">
                    <i class="fa-solid fa-recycle"></i>
                </div>
                <div>
                    <h3>Waste Management</h3>
                    <p>Monitor waste collection and treatment operations.</p>
                </div>
            </div>

            <div class="operation-card">
                <div class="operation-icon">
                    <i class="fa-solid fa-boxes-stacked"></i>
                </div>
                <div>
                    <h3>Inventory Management</h3>
                    <p>Manage feed stocks and farm supplies.</p>
                </div>
            </div>

            <div class="operation-card">
                <div class="operation-icon">
                    <i class="fa-solid fa-truck-field"></i>
                </div>
                <div>
                    <h3>Supplier Management</h3>
                    <p>Manage farm suppliers and inventory sources.</p>
                </div>
            </div>

            <div class="operation-card">
                <div class="operation-icon">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
                <div>
                    <h3>Predictive Analytics</h3>
                    <p>Analyze feed consumption and inventory requirements.</p>
                </div>
            </div>

        </div>

    </section>

    <!-- CAMERA PREVIEW -->
    <section class="dashboard-section">

        <div class="dashboard-section-title">
            <h2>Chicken Camera Monitoring</h2>
            <p>Camera-based chicken detection and activity monitoring</p>
        </div>

        <div class="camera-panel">

            <div class="camera-screen">
                <div>
                    <i class="fa-solid fa-video-slash"></i>
                    <h3>Camera Not Connected</h3>
                    <p>Camera preview will appear when the camera module is connected.</p>
                </div>
            </div>

            <div class="camera-footer">
                <span><i class="fa-solid fa-camera"></i> Camera Preview</span>
                <span>Connection: Offline</span>
            </div>

        </div>

    </section>

</div>

@endsection
