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
    <style>
        .small-box { transition: transform 0.3s ease, box-shadow 0.3s ease; border-radius: 10px; }
        .small-box:hover { transform: translateY(-5px); box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1); }
        .content-header { background: #f8f9fa; padding: 15px; border-bottom: 1px solid #dee2e6; }
        .brand-text { font-weight: 600; color: #ffffff; }
        .nav-link { color: #c2c7d0; }
        .nav-link.active { background-color: #00B074; color: #fff !important; }
        .main-footer { background: #343a40; color: #ffffff; }
        .card { border: none; border-radius: 10px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); }
        .card-header { background: #ffffff; border-bottom: 1px solid #e9ecef; }
        .table-responsive { margin-top: 20px; }
        #recentActivities { max-height: 300px; overflow-y: auto; }
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
                        <a href="{{ url('/companies') }}" class="nav-link {{ request()->is('companies*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-building"></i>
                            <p>Companies</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/jobs') }}" class="nav-link {{ request()->is('jobs*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-briefcase"></i>
                            <p>Jobs</p>
                        </a>
                    </li>
                    <li class="nav-item">
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
                    <div class="col-lg-3 col-6">
                        <a href="{{ url('/companies') }}" class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $companyCount }}</h3>
                                <p>Companies</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-building"></i>
                            </div>
                            <a href="{{ url('/companies') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </a>
                    </div>
                    <div class="col-lg-3 col-6">
                        <a href="{{ url('/jobs') }}" class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $jobCount }}</h3>
                                <p>Jobs</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-briefcase"></i>
                            </div>
                            <a href="{{ url('/jobs') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </a>
                    </div>
                    <div class="col-lg-3 col-6">
                        <a href="{{ url('/applications') }}" class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $applicationCount }}</h3>
                                <p>Applications</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <a href="{{ url('/applications') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </a>
                    </div>
                    <div class="col-lg-3 col-6">
                        <a href="{{ url('/users') }}" class="small-box bg-primary">
                            <div class="inner">
                                <h3>{{ $userCount }}</h3>
                                <p>Users</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <a href="{{ url('/users') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </a>
                    </div>
                </div>

                <!-- Jobs and Applications Section -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Recent Jobs</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Company</th>
                                                <th>Posted</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($recentJobs as $job)
                                                <tr>
                                                    <td>{{ $job->title }}</td>
                                                    <td>{{ $job->company->name ?? 'N/A' }}</td>
                                                    <td>{{ $job->created_at->diffForHumans() }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Recent Applications</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Applicant</th>
                                                <th>Job</th>
                                                <th>Applied</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($recentApplications as $application)
                                                <tr>
                                                    <td>{{ $application->names }}</td>
                                                    <td>{{ $application->job->title ?? 'N/A' }}</td>
                                                    <td>{{ $application->created_at->diffForHumans() }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
</body>
</html>