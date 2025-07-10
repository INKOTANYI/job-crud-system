<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>JobSmart - Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <style>
        body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg, #f0f4f8, #ffffff); transition: background 0.5s ease; }
        .small-box { transition: transform 0.3s ease, box-shadow 0.3s ease; border-radius: 10px; background: linear-gradient(90deg, #38b2ac, #6b46c1); color: #fff; }
        .small-box:hover { transform: translateY(-5px); box-shadow: 0 5px 15px rgba(56, 178, 172, 0.4); }
        .content-header { background: #f8f9fa; padding: 15px; border-bottom: 1px solid #dee2e6; animation: fadeIn 0.5s ease-out; }
        .brand-text { font-weight: 600; color: #ffffff; }
        .main-sidebar { background: linear-gradient(135deg, #2d3748, #1a202c); }
        .nav-link { color: #c2c7d0; transition: color 0.3s ease; }
        .nav-link.active { background: linear-gradient(90deg, #38b2ac, #6b46c1); color: #fff !important; }
        .nav-link:hover { color: #ffffff; }
        .main-footer { background: linear-gradient(135deg, #2d3748, #1a202c); color: #ffffff; }
        .card { border: none; border-radius: 10px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); animation: slideUp 0.5s ease-out; }
        .card-header { background: #ffffff; border-bottom: 1px solid #e9ecef; }
        .table-responsive { margin-top: 20px; }
        .btn-export { background: linear-gradient(90deg, #38b2ac, #6b46c1); color: #fff; border: none; border-radius: 8px; padding: 6px 12px; }
        .btn-export:hover { background: #2d3748; }
        .modal-content { border-radius: 10px; }
        #contactList { display: none; margin-top: 20px; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes slideUp { from { transform: translateY(20px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        .hidden-link { display: none !important; }
        table.dataTable { font-size: 14px; }
        th, td { white-space: nowrap; }
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
            <span class="brand-text">JobSmart</span>
        </a>
        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" id="newRegistrationsLink">
                            <i class="nav-icon fas fa-user-plus"></i>
                            <p>New Registrations</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" id="contactMessagesLink">
                            <i class="nav-icon fas fa-envelope"></i>
                            <p>Contact Us</p>
                        </a>
                    </li>
                    <li class="nav-item hidden-link">
                        <a href="{{ url('/companies') }}" class="nav-link {{ request()->is('companies*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-building"></i>
                            <p>Companies</p>
                        </a>
                    </li>
                    <li class="nav-item hidden-link">
                        <a href="{{ url('/jobs') }}" class="nav-link {{ request()->is('jobs*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-briefcase"></i>
                            <p>Jobs</p>
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
                <!-- Widgets -->
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <a href="#" data-toggle="modal" data-target="#newRegistrationsModal" class="small-box">
                            <div class="inner">
                                <h3>{{ $newRegistrationCount }}</h3>
                                <p>Total New Registrations</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <span class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></span>
                        </a>
                    </div>
                    <div class="col-lg-6 col-12">
                        <a href="#" data-toggle="modal" data-target="#contactMessagesModal" class="small-box">
                            <div class="inner">
                                <h3>{{ $contactCount }}</h3>
                                <p>Total Contact Messages</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <span class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></span>
                        </a>
                    </div>
                </div>

                <!-- Recent Registrations -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card" id="newRegistrationsList">
                            <div class="card-header">
                                <h3 class="card-title">Recent Registrations</h3>
                                <div class="card-tools">
                                    <a href="{{ route('dashboard.export.pdf') }}" class="btn btn-export btn-sm">
                                        <i class="fas fa-file-pdf"></i> Export PDF
                                    </a>
                                </div>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-hover table-bordered" id="recentRegistrationsTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>ID Number</th>
                                            <th>Department</th>
                                            <th>Province</th>
                                            <th>District</th>
                                            <th>Sector</th>
                                            <th>CV</th>
                                            <th>Degree</th>
                                            <th>ID Doc</th>
                                            <th>Applied At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recentRegistrations as $registration)
                                            <tr>
                                                <td>{{ $registration->id }}</td>
                                                <td>{{ $registration->full_name }}</td>
                                                <td>{{ $registration->email }}</td>
                                                <td>{{ $registration->phone }}</td>
                                                <td>{{ $registration->id_number }}</td>
                                                <td>{{ $registration->department->name ?? 'N/A' }}</td>
                                                <td>{{ $registration->province->name ?? 'N/A' }}</td>
                                                <td>{{ $registration->district->name ?? 'N/A' }}</td>
                                                <td>{{ $registration->sector->name ?? 'N/A' }}</td>
                                                <td>
                                                    @if ($registration->cv)
                                                        <a href="{{ asset('storage/' . $registration->cv) }}" target="_blank" class="btn btn-sm btn-info">
                                                            <i class="fas fa-download"></i> Download
                                                        </a>
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($registration->degree)
                                                        <a href="{{ asset('storage/' . $registration->degree) }}" target="_blank" class="btn btn-sm btn-info">
                                                            <i class="fas fa-download"></i> Download
                                                        </a>
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($registration->id_doc)
                                                        <a href="{{ asset('storage/' . $registration->id_doc) }}" target="_blank" class="btn btn-sm btn-info">
                                                            <i class="fas fa-download"></i> Download
                                                        </a>
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>{{ $registration->created_at->format('d M Y H:i') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Messages List (AJAX-loaded) -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card" id="contactList">
                            <div class="card-header">
                                <h3 class="card-title">All Contact Messages</h3>
                                <div class="card-tools">
                                    <button class="btn btn-export btn-sm" id="refreshContacts">Refresh</button>
                                </div>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-hover table-bordered" id="contactTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Message</th>
                                            <th>Submitted At</th>
                                        </tr>
                                    </thead>
                                    <tbody id="contactTableBody">
                                        <tr><td colspan="5">Loading...</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="main-footer">
        <strong>Copyright © 2025 <a href="{{ url('/') }}">JobSmart</a>.</strong> All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0.0
        </div>
    </footer>

    <!-- New Registrations Modal -->
    <div class="modal fade" id="newRegistrationsModal" tabindex="-1" role="dialog" aria-labelledby="newRegistrationsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newRegistrationsModalLabel">New Registrations Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Total New Registrations:</strong> {{ $newRegistrationCount }}</p>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Applied At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentRegistrations->take(5) as $registration)
                                <tr>
                                    <td>{{ $registration->id }}</td>
                                    <td>{{ $registration->full_name }}</td>
                                    <td>{{ $registration->email }}</td>
                                    <td>{{ $registration->created_at->format('d M Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="#" class="btn btn-primary" id="viewAllRegistrations">View All</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Messages Modal -->
    <div class="modal fade" id="contactMessagesModal" tabindex="-1" role="dialog" aria-labelledby="contactMessagesModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="contactMessagesModalLabel">Contact Messages Details</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Total Contact Messages:</strong> {{ $contactCount }}</p>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th>Submitted At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                use App\Models\Contact;
                            @endphp
                            @foreach (Contact::latest()->take(5)->get() as $contact)
                                <tr>
                                    <td>{{ $contact->id }}</td>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($contact->message, 50) }}</td>
                                    <td>{{ $contact->created_at->format('d M Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" id="viewAllContacts">View All</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
    $('#recentRegistrationsTable').DataTable({
        responsive: true,
        pageLength: 10,
        order: [[12, 'desc']],
        language: { search: 'Filter:', searchPlaceholder: 'Search registrations...' },
        scrollX: true
    });

    // Load Contact Messages via AJAX
    function loadContacts() {
        $.ajax({
            url: '{{ route("contacts.ajax") }}',
            method: 'GET',
            success: function(response) {
                let html = '';
                if (response.data.length > 0) {
                    response.data.forEach(contact => {
                        html += `<tr>
                            <td>${contact.id}</td>
                            <td>${contact.name}</td>
                            <td>${contact.email}</td>
                            <td>${contact.message.substring(0, 100)}</td>
                            <td>${contact.created_at}</td>
                        </tr>`;
                    });
                } else {
                    html = '<tr><td colspan="5">No contacts found.</td></tr>';
                }
                $('#contactTableBody').html(html);
                $('#contactList').show();
                $('#contactTable').DataTable({
                    destroy: true,
                    responsive: true,
                    pageLength: 10,
                    order: [[4, 'desc']],
                    language: { search: 'Filter:', searchPlaceholder: 'Search contacts...' },
                    scrollX: true
                });
            },
            error: function(xhr) {
                $('#contactTableBody').html('<tr><td colspan="5">Error loading contacts.</td></tr>');
            }
        });
    }

    // Trigger AJAX on "View All" button
    $('#viewAllContacts').on('click', function() {
        loadContacts();
        $('#contactMessagesModal').modal('hide');
    });

    // Trigger AJAX on sidebar link
    $('#contactMessagesLink').on('click', function(e) {
        e.preventDefault();
        loadContacts();
    });

    // Refresh button
    $('#refreshContacts').on('click', function() {
        loadContacts();
    });

    // Load New Registrations via AJAX (placeholder)
    function loadRegistrations() {
        // Implement similar AJAX call for registrations
        console.log('Loading registrations...');
    }

    $('#viewAllRegistrations').on('click', function() {
        loadRegistrations();
        $('#newRegistrationsModal').modal('hide');
    });

    $('#newRegistrationsLink').on('click', function(e) {
        e.preventDefault();
        loadRegistrations();
    });
});
</script>
</body>
</html>
