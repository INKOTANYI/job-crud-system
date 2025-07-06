<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobRwanda - Dashboard</title>
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js">
    <style>
        .small-box { transition: transform 0.3s ease, box-shadow 0.3s ease; border-radius: 10px; }
        .small-box:hover { transform: translateY(-5px); box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1); }
        .content-header { background: #f8f9fa; padding: 15px; border-bottom: 1px solid #dee2e6; animation: fadeIn 0.5s ease-out; }
        .brand-text { font-weight: 600; color: #ffffff; }
        .nav-link { color: #c2c7d0; transition: color 0.3s ease; }
        .nav-link.active { background-color: #00B074; color: #fff !important; }
        .nav-link:hover { color: #ffffff; }
        .main-footer { background: #343a40; color: #ffffff; }
        .card { border: none; border-radius: 10px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); animation: slideUp 0.5s ease-out; }
        .card-header { background: #ffffff; border-bottom: 1px solid #e9ecef; }
        .table-responsive { margin-top: 20px; }
        #recentActivities { max-height: 300px; overflow-y: auto; }
        .chart-container { position: relative; margin-top: 20px; height: 400px; animation: fadeIn 0.5s ease-out 0.2s both; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes slideUp { from { transform: translateY(20px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        body { background: linear-gradient(135deg, #f0f4f8, #ffffff); transition: background 0.5s ease; }
        .hidden-link { display: none !important; } /* Hide unwanted links */
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fas fa-user"></i> {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </nav>

    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="{{ url('/') }}" class="brand-link">
            <span class="brand-text">JobRwanda</span>
        </a>
        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    <li class="nav-item">
                        <a href="{{ url('/dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/new-registrations') }}" class="nav-link {{ request()->is('new-registrations*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-plus"></i>
                            <p>New Registrations</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/contact-us') }}" class="nav-link {{ request()->is('contact-us*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-envelope"></i>
                            <p>Contact Us</p>
                        </a>
                    </li>
                    <li class="nav-item hidden-link"> <!-- Hide Companies -->
                        <a href="{{ url('/companies') }}" class="nav-link {{ request()->is('companies*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-building"></i>
                            <p>Companies</p>
                        </a>
                    </li>
                    <li class="nav-item hidden-link"> <!-- Hide Jobs -->
                        <a href="{{ url('/jobs') }}" class="nav-link {{ request()->is('jobs*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-briefcase"></i>
                            <p>Jobs</p>
                        </a>
                    </li>
                    <li class="nav-item hidden-link"> <!-- Hide Applications -->
                        <a href="{{ url('/applications') }}" class="nav-link {{ request()->is('applications*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>Applications</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Dashboard</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <a href="{{ url('/new-registrations') }}" class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $newRegistrationCount }}</h3>
                                <p>Total New Registrations</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <a href="{{ url('/new-registrations') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </a>
                    </div>
                    <div class="col-lg-6 col-12">
                        <a href="{{ url('/contact-us') }}" class="small-box bg-primary">
                            <div class="inner">
                                <h3>{{ $contactCount }}</h3>
                                <p>Total SMS Contact Us</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <a href="{{ url('/contact-us') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </a>
                    </div>
                </div>

                <!-- Report Graph -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">New Registrations Report</h3>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="applicationsChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="main-footer">
        <strong>Copyright © 2025 <a href="{{ url('/') }}">JobRwanda</a>.</strong> All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0.0
        </div>
    </footer>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
$(document).ready(function() {
    // Chart for Registrations by District and Department
    const ctx = document.getElementById('applicationsChart').getContext('2d');
    const applicationsChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                ...{{ $applicationByDistrict->pluck('district.name')->toJson() }},
                ...{{ $applicationByDepartment->pluck('department.name')->toJson() }}
            ],
            datasets: [{
                label: 'Registrations',
                data: [
                    ...{{ $applicationByDistrict->pluck('total')->toJson() }},
                    ...{{ $applicationByDepartment->pluck('total')->toJson() }}
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    title: { display: true, text: 'Number of Registrations' }
                },
                x: { title: { display: true, text: 'Districts and Departments' } }
            },
            plugins: {
                legend: { position: 'top' },
                title: { display: true, text: 'Registrations by District and Department' }
            },
            animation: { duration: 1000, easing: 'easeOutQuart' }
        }
    });
});
</script>
</body>
</html>