@extends('layouts.app')

@section('content')
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
                        <a href="{{ url('/registrations') }}" class="nav-link active">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Registrations</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Registrations</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="mb-3">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addRegistrationModal">
                        Add New Registration
                    </button>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List of Registrations</h3>
                    </div>
                    <div class="card-body">
                        @if ($registrations && $registrations->count())
                            <table class="table table-striped" id="registrationsTable">
                                <thead>
                                    <tr>
                                        <th>Registration ID</th>
                                        <th>Names</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>ID Number</th>
                                        <th>Department</th>
                                        <th>Location</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($registrations as $registration)
                                        <tr data-id="{{ $registration->id }}">
                                            <td>{{ $registration->id }}</td>
                                            <td>{{ $registration->names }}</td>
                                            <td>{{ $registration->phone }}</td>
                                            <td>{{ $registration->email }}</td>
                                            <td>{{ $registration->id_number }}</td>
                                            <td>{{ $registration->department->name ?? 'N/A' }}</td>
                                            <td>{{ $registration->province->name ?? 'N/A' }} {{ $registration->district->name ?? 'N/A' }} {{ $registration->sector->name ?? 'N/A' }}</td>
                                            <td>
                                                <button class="btn btn-info btn-sm edit-btn" data-id="{{ $registration->id }}" data-toggle="modal" data-target="#editRegistrationModal-{{ $registration->id }}">Edit</button>
                                                <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $registration->id }}" data-toggle="modal" data-target="#deleteConfirmModal">Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @foreach ($registrations as $registration)
                                @include('registrations-edit', ['registration' => $registration])
                            @endforeach
                        @else
                            <p class="text-center">No registrations found or data is not available.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="main-footer">
        <strong>Copyright © 2025 JobRwanda.</strong> All rights reserved.
    </footer>

    <div class="modal fade" id="addRegistrationModal" tabindex="-1" role="dialog" aria-labelledby="addRegistrationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRegistrationModalLabel">Add New Registration</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="success-message" class="alert alert-success d-none" role="alert"></div>
                    <div id="error-message" class="alert alert-danger d-none" role="alert"></div>
                    <form id="registration-form" action="{{ route('registrations.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="names">Names</label>
                            <input type="text" name="names" id="names" class="form-control" required>
                            <p class="text-danger error-names mt-1"></p>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control" required>
                            <p class="text-danger error-phone mt-1"></p>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                            <p class="text-danger error-email mt-1"></p>
                        </div>
                        <div class="form-group">
                            <label for="id_number">ID Number (Rwandan National ID)</label>
                            <input type="text" name="id_number" id="id_number" class="form-control" required pattern="[A-Z0-9]{16}" title="Must be 16 characters (letters or numbers)">
                            <p class="text-danger error-id_number mt-1"></p>
                        </div>
                        <div class="form-group">
                            <label for="department_id">Department</label>
                            <select name="department_id" id="department_id" class="form-control" required>
                                <option value="">Select Department</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                            <p class="text-danger error-department_id mt-1"></p>
                        </div>
                        <div class="form-group">
                            <label for="cv">Upload CV</label>
                            <input type="file" name="cv" id="cv" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="degree">Upload Degree</label>
                            <input type="file" name="degree" id="degree" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="id_doc">Upload ID</label>
                            <input type="file" name="id_doc" id="id_doc" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="province_id">Province</label>
                            <select name="province_id" id="province_id" class="form-control" required>
                                <option value="">Select Province</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                @endforeach
                            </select>
                            <p class="text-danger error-province_id mt-1"></p>
                        </div>
                        <div class="form-group">
                            <label for="district_id">District</label>
                            <select name="district_id" id="district_id" class="form-control" required>
                                <option value="">Select District</option>
                            </select>
                            <p class="text-danger error-district_id mt-1"></p>
                        </div>
                        <div class="form-group">
                            <label for="sector_id">Sector</label>
                            <select name="sector_id" id="sector_id" class="form-control" required>
                                <option value="">Select Sector</option>
                            </select>
                            <p class="text-danger error-sector_id mt-1"></p>
                        </div>
                        <button type="submit" class="btn btn-primary">Create Registration</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="successPopup" tabindex="-1" role="dialog" aria-labelledby="successPopupLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content custom-modal">
                <div class="modal-body text-center">
                    <span class="check-icon">✓</span>
                    <h4 class="modal-title" id="successPopupLabel">Oh Yeah!</h4>
                    <p id="successPopupMessage">Successfully created registration!</p>
                    <button type="button" class="btn btn-success" id="successOkBtn">OK</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content custom-modal">
                <div class="modal-body text-center">
                    <span class="warning-icon">⚠️</span>
                    <h4 class="modal-title" id="deleteConfirmModalLabel">Are you sure?</h4>
                    <p>Are you sure you want to delete this registration?</p>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Yes</button>
                    <button type="button" class="btn btn-secondary" id="cancelDeleteBtn">No</button>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <style>
        .custom-modal { border: none; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); width: 300px; margin: 0 auto; }
        .check-icon { font-size: 40px; color: #28a745; display: block; margin-bottom: 10px; }
        .warning-icon { font-size: 40px; color: #dc3545; display: block; margin-bottom: 10px; }
        .modal-body { padding: 20px; }
        .btn-success { background-color: #28a745; border-color: #28a745; padding: 5px 20px; margin-right: 10px; }
        .btn-success:hover { background-color: #218838; border-color: #1e7e34; }
        .btn-danger { background-color: #dc3545; border-color: #dc3545; padding: 5px 20px; margin-right: 10px; }
        .btn-danger:hover { background-color: #c82333; border-color: #bd2130; }
        .btn-secondary { background-color: #6c757d; border-color: #6c757d; padding: 5px 20px; }
        .btn-secondary:hover { background-color: #5a6268; border-color: #545b62; }
    </style>
    <script>
        $(document).ready(function() {
            var table = $('#registrationsTable').DataTable();
            var registrationIdToDelete = null;
            var activeModalId = null;

            $('#province_id').on('change', function() {
                var provinceId = $(this).val();
                if (provinceId) {
                    $.ajax({
                        url: '/api/districts/' + provinceId,
                        type: 'GET',
                        success: function(data) {
                            var html = '<option value="">Select District</option>';
                            if (data && Array.isArray(data) && data.length > 0) {
                                $.each(data, function(key, value) {
                                    html += '<option value="' + value.id + '">' + value.name + '</option>';
                                });
                            } else {
                                html = '<option value="">No Districts Available</option>';
                            }
                            $('#district_id').html(html);
                            $('#sector_id').html('<option value="">Select Sector</option>');
                        },
                        error: function(xhr) {
                            console.error('Error fetching districts:', xhr.status, xhr.responseText);
                            $('#district_id').html('<option value="">Error Fetching Districts</option>');
                            $('#sector_id').html('<option value="">Select District First</option>');
                        }
                    });
                } else {
                    $('#district_id').html('<option value="">Select District</option>');
                    $('#sector_id').html('<option value="">Select Sector</option>');
                }
            });

            $('#district_id').on('change', function() {
                var districtId = $(this).val();
                if (districtId) {
                    $.ajax({
                        url: '/api/sectors/' + districtId,
                        type: 'GET',
                        success: function(data) {
                            var html = '<option value="">Select Sector</option>';
                            if (data && Array.isArray(data) && data.length > 0) {
                                $.each(data, function(key, value) {
                                    html += '<option value="' + value.id + '">' + value.name + '</option>';
                                });
                            } else {
                                html = '<option value="">No Sectors Available</option>';
                            }
                            $('#sector_id').html(html);
                        },
                        error: function(xhr) {
                            console.error('Error fetching sectors:', xhr.status, xhr.responseText);
                            $('#sector_id').html('<option value="">Error Fetching Sectors</option>');
                        }
                    });
                } else {
                    $('#sector_id').html('<option value="">Select Sector</option>');
                }
            });

            $('#registration-form').on('submit', function(e) {
                e.preventDefault();
                $('.error').text('');
                $('#success-message, #error-message').addClass('d-none');

                var formData = new FormData(this);

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#addRegistrationModal').modal('hide');
                        $('#registration-form')[0].reset();

                        table.row.add([
                            response.registration.id,
                            response.registration.names,
                            response.registration.phone,
                            response.registration.email,
                            response.registration.id_number,
                            response.registration.department?.name ?? 'N/A',
                            response.registration.province?.name + ' ' + response.registration.district?.name + ' ' + response.registration.sector?.name,
                            `
                                <button class="btn btn-info btn-sm edit-btn" data-id="${response.registration.id}" data-toggle="modal" data-target="#editRegistrationModal-${response.registration.id}">Edit</button>
                                <button class="btn btn-danger btn-sm delete-btn" data-id="${response.registration.id}" data-toggle="modal" data-target="#deleteConfirmModal">Delete</button>
                            `
                        ]).draw(false);

                        activeModalId = '#addRegistrationModal';
                        $('#successPopupMessage').text('Successfully created registration!');
                        $('#successPopup').modal('show');
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('.error-' + key).text(value[0]);
                            });
                        } else {
                            $('#error-message').removeClass('d-none').text('An error occurred: ' + xhr.responseText);
                        }
                    }
                });
            });

            $(document).on('click', '.delete-btn', function() {
                registrationIdToDelete = $(this).data('id');
                $('#deleteConfirmModal').modal('show');
            });

            $('#confirmDeleteBtn').on('click', function() {
                if (registrationIdToDelete) {
                    $.ajax({
                        url: '{{ url("/registrations") }}/' + registrationIdToDelete,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            table.row($('tr[data-id="' + registrationIdToDelete + '"]')).remove().draw(false);
                            $('#deleteConfirmModal').modal('hide');
                            activeModalId = null;
                            $('#successPopupMessage').text('Successfully deleted registration!');
                            $('#successPopup').modal('show');
                            registrationIdToDelete = null;
                        },
                        error: function(xhr) {
                            $('#deleteConfirmModal').modal('hide');
                            alert('An error occurred: ' + xhr.responseText);
                            registrationIdToDelete = null;
                        }
                    });
                }
            });

            $('#cancelDeleteBtn').on('click', function() {
                $('#deleteConfirmModal').modal('hide');
                registrationIdToDelete = null;
            });

            $('#successOkBtn').on('click', function() {
                $('#successPopup').modal('hide');
                if (activeModalId) {
                    $(activeModalId).modal('hide');
                    activeModalId = null;
                }
            });
        });
    </script>
@endsection
