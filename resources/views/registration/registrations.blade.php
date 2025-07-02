<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobRwanda - Registrations</title>
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

    <!-- Content Wrapper -->
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
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Registration List</h3>
                            </div>
                            <div class="card-body">
                                <table id="registrationsTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
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
                                        @foreach ($registrationData as $data)
                                            <tr data-id="{{ $data['registration']->id }}">
                                                <td>{{ $data['registration']->id }}</td>
                                                <td>{{ $data['registration']->names }}</td>
                                                <td>{{ $data['registration']->phone }}</td>
                                                <td>{{ $data['registration']->email }}</td>
                                                <td>{{ $data['registration']->id_number }}</td>
                                                <td>{{ $data['registration']->department->name ?? 'N/A' }}</td>
                                                <td>{{ $data['registration']->province->name ?? '' }} {{ $data['registration']->district->name ?? '' }} {{ $data['registration']->sector->name ?? '' }}</td>
                                                <td>
                                                    <button class="btn btn-info btn-sm edit-btn" data-id="{{ $data['registration']->id }}" data-toggle="modal" data-target="#editRegistrationModal-{{ $data['registration']->id }}"><i class="fas fa-edit"></i> Edit</button>
                                                    <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $data['registration']->id }}" data-toggle="modal" data-target="#deleteConfirmModal"><i class="fas fa-trash"></i> Delete</button>
                                                </td>
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

    <!-- Edit Modal -->
    @foreach ($registrationData as $data)
        <div class="modal fade" id="editRegistrationModal-{{ $data['registration']->id }}" tabindex="-1" role="dialog" aria-labelledby="editRegistrationModalLabel-{{ $data['registration']->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="editRegistrationModalLabel-{{ $data['registration']->id }}">Edit Registration #{{ $data['registration']->id }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="edit-success-message-{{ $data['registration']->id }}" class="alert alert-success d-none" role="alert"></div>
                        <div id="edit-error-message-{{ $data['registration']->id }}" class="alert alert-danger d-none" role="alert"></div>
                        <form id="edit-registration-form-{{ $data['registration']->id }}" action="{{ route('registrations.update', $data['registration']->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="names-{{ $data['registration']->id }}">Names</label>
                                        <input type="text" name="names" id="names-{{ $data['registration']->id }}" class="form-control" value="{{ $data['registration']->names }}" required>
                                        <span class="text-danger error-names"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone-{{ $data['registration']->id }}">Phone</label>
                                        <input type="text" name="phone" id="phone-{{ $data['registration']->id }}" class="form-control" value="{{ $data['registration']->phone }}" required>
                                        <span class="text-danger error-phone"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="email-{{ $data['registration']->id }}">Email</label>
                                        <input type="email" name="email" id="email-{{ $data['registration']->id }}" class="form-control" value="{{ $data['registration']->email }}" required>
                                        <span class="text-danger error-email" id="emailFeedback-{{ $data['registration']->id }}"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="id_number-{{ $data['registration']->id }}">ID Number</label>
                                        <input type="text" name="id_number" id="id_number-{{ $data['registration']->id }}" class="form-control" value="{{ $data['registration']->id_number }}" required pattern="[A-Z0-9]{16}" title="Must be 16 characters (letters or numbers)">
                                        <span class="text-danger error-id_number"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="department_id-{{ $data['registration']->id }}">Department</label>
                                        <select name="department_id" id="department_id-{{ $data['registration']->id }}" class="form-control custom-select" required>
                                            <option value="">Select Department</option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}" {{ $data['registration']->department_id == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger error-department_id"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="province_id-{{ $data['registration']->id }}">Province</label>
                                        <select name="province_id" id="province_id-{{ $data['registration']->id }}" class="form-control custom-select" required>
                                            <option value="">Select Province</option>
                                            @foreach ($provinces as $province)
                                                <option value="{{ $province->id }}" {{ $data['registration']->province_id == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger error-province_id"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="district_id-{{ $data['registration']->id }}">District</label>
                                        <select name="district_id" id="district_id-{{ $data['registration']->id }}" class="form-control custom-select" required>
                                            <option value="">Select District</option>
                                            @foreach ($data['districts'] as $district)
                                                <option value="{{ $district->id }}" {{ $data['registration']->district_id == $district->id ? 'selected' : '' }}>{{ $district->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger error-district_id"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="sector_id-{{ $data['registration']->id }}">Sector</label>
                                        <select name="sector_id" id="sector_id-{{ $data['registration']->id }}" class="form-control custom-select" required>
                                            <option value="">Select Sector</option>
                                            @foreach ($data['sectors'] as $sector)
                                                <option value="{{ $sector->id }}" {{ $data['registration']->sector_id == $sector->id ? 'selected' : '' }}>{{ $sector->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger error-sector_id"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cv-{{ $data['registration']->id }}">Upload CV</label>
                                        <input type="file" name="cv" id="cv-{{ $data['registration']->id }}" class="form-control">
                                        @if ($data['registration']->cv)
                                            <a href="{{ asset('storage/' . $data['registration']->cv) }}" target="_blank" class="btn btn-sm btn-default mt-2">View Current CV</a>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="degree-{{ $data['registration']->id }}">Upload Degree</label>
                                        <input type="file" name="degree" id="degree-{{ $data['registration']->id }}" class="form-control">
                                        @if ($data['registration']->degree)
                                            <a href="{{ asset('storage/' . $data['registration']->degree) }}" target="_blank" class="btn btn-sm btn-default mt-2">View Current Degree</a>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="id_doc-{{ $data['registration']->id }}">Upload ID</label>
                                        <input type="file" name="id_doc" id="id_doc-{{ $data['registration']->id }}" class="form-control">
                                        @if ($data['registration']->id_doc)
                                            <a href="{{ asset('storage/' . $data['registration']->id_doc) }}" target="_blank" class="btn btn-sm btn-default mt-2">View Current ID</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Update Registration</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title" id="deleteConfirmModalLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this registration?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Popup Modal -->
    <div class="modal fade" id="successPopup" tabindex="-1" role="dialog" aria-labelledby="successPopupLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title" id="successPopupLabel">Success</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="successPopupMessage"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
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
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        var table = $('#registrationsTable').DataTable();

        $('.edit-btn').on('click', function() {
            var id = $(this).data('id');
            $('#editRegistrationModal-' + id).modal('show');
        });

        $('.delete-btn').on('click', function() {
            var id = $(this).data('id');
            $('#confirmDelete').data('id', id);
            $('#deleteConfirmModal').modal('show');
        });

        $('#confirmDelete').on('click', function() {
            var id = $(this).data('id');
            $.ajax({
                url: '{{ route("registrations.destroy", ["registration" => ":id"]) }}'.replace(':id', id),
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#deleteConfirmModal').modal('hide');
                    table.row($('tr[data-id="' + id + '"]')).remove().draw();
                    $('#successPopupMessage').text(response.message);
                    $('#successPopup').modal('show');
                },
                error: function(xhr) {
                    $('#deleteConfirmModal').modal('hide');
                    alert('Error deleting registration.');
                }
            });
        });

        @foreach ($registrationData as $data)
            $('#province_id-{{ $data['registration']->id }}').change(function() {
                var provinceId = $(this).val();
                var districtSelect = $('#district_id-{{ $data['registration']->id }}');
                var sectorSelect = $('#sector_id-{{ $data['registration']->id }}');
                districtSelect.empty().append('<option value="">Select District</option>');
                sectorSelect.empty().append('<option value="">Select Sector</option>');
                if (provinceId) {
                    $.get('/api/districts/' + provinceId, function(data) {
                        $.each(data, function(index, district) {
                            districtSelect.append($('<option>', {
                                value: district.id,
                                text: district.name
                            }));
                        });
                    });
                }
            });

            $('#district_id-{{ $data['registration']->id }}').change(function() {
                var districtId = $(this).val();
                var sectorSelect = $('#sector_id-{{ $data['registration']->id }}');
                sectorSelect.empty().append('<option value="">Select Sector</option>');
                if (districtId) {
                    $.get('/api/sectors/' + districtId, function(data) {
                        $.each(data, function(index, sector) {
                            sectorSelect.append($('<option>', {
                                value: sector.id,
                                text: sector.name
                            }));
                        });
                    });
                }
            });

            $('#email-{{ $data['registration']->id }}').on('input', function() {
                var email = $(this).val();
                if (email) {
                    $.ajax({
                        url: '{{ route("registrations.check-email") }}',
                        type: 'GET',
                        data: { email: email, ignore_id: {{ $data['registration']->id }} },
                        success: function(response) {
                            if (response.exists) {
                                $('#emailFeedback-{{ $data['registration']->id }}').text('This email is already registered by another entry.');
                            } else {
                                $('#emailFeedback-{{ $data['registration']->id }}').text('');
                            }
                        },
                        error: function(xhr) {
                            $('#emailFeedback-{{ $data['registration']->id }}').text('Error checking email.');
                        }
                    });
                } else {
                    $('#emailFeedback-{{ $data['registration']->id }}').text('');
                }
            });

            $('#edit-registration-form-{{ $data['registration']->id }}').on('submit', function(e) {
                e.preventDefault();
                $('.error').text('');
                $('#edit-success-message-{{ $data['registration']->id }}, #edit-error-message-{{ $data['registration']->id }}').addClass('d-none');

                var formData = new FormData(this);

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#editRegistrationModal-{{ $data['registration']->id }}').modal('hide');
                        table.row($('tr[data-id="{{ $data['registration']->id }}"]')).data([
                            response.registration.id,
                            response.registration.names,
                            response.registration.phone,
                            response.registration.email,
                            response.registration.id_number,
                            response.registration.department?.name ?? 'N/A',
                            response.registration.province?.name + ' ' + response.registration.district?.name + ' ' + response.registration.sector?.name,
                            `
                                <button class="btn btn-info btn-sm edit-btn" data-id="${response.registration.id}" data-toggle="modal" data-target="#editRegistrationModal-${response.registration.id}"><i class="fas fa-edit"></i> Edit</button>
                                <button class="btn btn-danger btn-sm delete-btn" data-id="${response.registration.id}" data-toggle="modal" data-target="#deleteConfirmModal"><i class="fas fa-trash"></i> Delete</button>
                            `
                        ]).draw(false);
                        $('#successPopupMessage').text('Successfully updated registration!');
                        $('#successPopup').modal('show');
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('.error-' + key).text(value[0]);
                            });
                        } else {
                            $('#edit-error-message-{{ $data['registration']->id }}').removeClass('d-none').text('An error occurred: ' + xhr.responseText);
                        }
                    }
                });
            });
        @endforeach
    });
</script>
</body>
</html>