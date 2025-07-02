<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobRwanda - Apply for Job</title>
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
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
                    <i class="fas fa-user"></i> {{ Auth::user()->name ?? 'Guest' }}
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    @if (Auth::check())
                        <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="dropdown-item">Login</a>
                    @endif
                </div>
            </li>
        </ul>
    </nav>

    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="{{ url('/') }}" class="brand-link">
            <span class="brand-text font-weight-light">JobRwanda</span>
        </a>
        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    <li class="nav-item">
                        <a href="{{ url('/dashboard') }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/companies') }}" class="nav-link">
                            <i class="nav-icon fas fa-building"></i>
                            <p>Companies</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/jobs') }}" class="nav-link">
                            <i class="nav-icon fas fa-briefcase"></i>
                            <p>Jobs</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/applications') }}" class="nav-link">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>Applications</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/registrations') }}" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Registrations</p>
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
                        <h1 class="m-0">Apply for Job: {{ $job->job_title }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Application Form</h3>
                            </div>
                            <div class="card-body">
                                <form id="apply-form" action="{{ route('applications.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="job_id" value="{{ $job->id }}">
                                    @if ($registration)
                                        <input type="hidden" name="registration_id" value="{{ $registration->id }}">
                                    @endif
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $email) }}" required readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="cover_letter">Cover Letter</label>
                                        <textarea name="cover_letter" id="cover_letter" class="form-control" required>{{ old('cover_letter') }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit Application</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="main-footer">
        <strong>Copyright © 2025 JobRwanda.</strong> All rights reserved.
    </footer>
</div>

<script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#apply-form').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    alert('Application submitted successfully!');
                    window.location.href = '{{ url('/') }}';
                },
                error: function(xhr) {
                    alert('Error submitting application: ' + xhr.responseText);
                }
            });
        });

        $('#email').on('input', function() {
            var email = $(this).val();
            if (email) {
                $.ajax({
                    url: '{{ route('registrations.check-email') }}',
                    type: 'GET',
                    data: { email: email },
                    success: function(response) {
                        if (response.exists) {
                            $('#apply-form').append('<input type="hidden" name="registration_id" value="' + response.registration.id + '">');
                        }
                    },
                    error: function(xhr) {
                        console.log('Error checking email');
                    }
                });
            }
        });
    });
</script>
</body>
</html>