@extends('layouts.app')

@section('content')
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
                        <a href="{{ url('/companies') }}" class="nav-link active">
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
                        <h1 class="m-0">Companies</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <!-- Success Message -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Add Company Button -->
                <div class="mb-3">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCompanyModal">
                        Add New Company
                    </button>
                </div>

                <!-- Companies Table -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List of Companies</h3>
                    </div>
                    <div class="card-body">
                        @if ($companies && $companies->count())
                            <table class="table table-striped" id="companiesTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Company Name</th>
                                        <th>Category</th>
                                        <th>Location</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($companies as $company)
                                        <tr data-id="{{ $company->id }}">
                                            <td>{{ $company->id }}</td>
                                            <td>{{ $company->company_name }}</td>
                                            <td>{{ $company->jobCategory->name ?? 'N/A' }}</td>
                                            <td>{{ $company->province->name ?? 'N/A' }} {{ $company->district->name ?? 'N/A' }} {{ $company->sector->name ?? 'N/A' }}</td>
                                            <td>
                                                <button class="btn btn-info btn-sm edit-btn" data-id="{{ $company->id }}" data-toggle="modal" data-target="#editCompanyModal-{{ $company->id }}">Edit</button>
                                                <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $company->id }}" data-toggle="modal" data-target="#deleteConfirmModal">Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @foreach ($companies as $company)
                                @include('companies-edit', ['company' => $company])
                            @endforeach
                        @else
                            <p class="text-center">No companies found or data is not available.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="main-footer">
        <strong>Copyright © 2025 JobRwanda.</strong> All rights reserved.
    </footer>

    <!-- Add Company Modal -->
    <div class="modal fade" id="addCompanyModal" tabindex="-1" role="dialog" aria-labelledby="addCompanyModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCompanyModalLabel">Add New Company</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="success-message" class="alert alert-success d-none" role="alert"></div>
                    <div id="error-message" class="alert alert-danger d-none" role="alert"></div>
                    <form id="company-form" action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="company_name">Company Name</label>
                            <input type="text" name="company_name" id="company_name" class="form-control" required>
                            <p class="text-danger error-company_name mt-1"></p>
                        </div>
                        <div class="form-group">
                            <label for="logo">Logo (Optional)</label>
                            <input type="file" name="logo" id="logo" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="description">Description (Optional)</label>
                            <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                            <p class="text-danger error-description mt-1"></p>
                        </div>
                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select name="category_id" id="category_id" class="form-control" required>
                                <option value="">Select Category</option>
                                @foreach ($jobCategories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <p class="text-danger error-category_id mt-1"></p>
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
                        <button type="submit" class="btn btn-primary">Create Company</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Popup Modal -->
    <div class="modal fade" id="successPopup" tabindex="-1" role="dialog" aria-labelledby="successPopupLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content custom-modal">
                <div class="modal-body text-center">
                    <span class="check-icon">✓</span>
                    <h4 class="modal-title" id="successPopupLabel">Oh Yeah!</h4>
                    <p id="successPopupMessage">Successfully created company!</p>
                    <button type="button" class="btn btn-success" id="successOkBtn">OK</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Popup Modal -->
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content custom-modal">
                <div class="modal-body text-center">
                    <span class="warning-icon">⚠️</span>
                    <h4 class="modal-title" id="deleteConfirmModalLabel">Are you sure?</h4>
                    <p>Are you sure you want to delete this company?</p>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Yes</button>
                    <button type="button" class="btn btn-secondary" id="cancelDeleteBtn">No</button>
                </div>
            </div>
        </div>
    </div>

    <!-- DataTables JS and CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <style>
        .custom-modal {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin: 0 auto;
        }
        .check-icon {
            font-size: 40px;
            color: #28a745;
            display: block;
            margin-bottom: 10px;
        }
        .warning-icon {
            font-size: 40px;
            color: #dc3545;
            display: block;
            margin-bottom: 10px;
        }
        .modal-body {
            padding: 20px;
        }
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
            padding: 5px 20px;
            margin-right: 10px;
        }
        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
            padding: 5px 20px;
            margin-right: 10px;
        }
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            padding: 5px 20px;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
    </style>
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            var table = $('#companiesTable').DataTable();
            var companyIdToDelete = null;
            var activeModalId = null;

            // Fetch districts based on province (Add Modal)
            $('#province_id').on('change', function() {
                var provinceId = $(this).val();
                console.log('Add Modal - Province changed to:', provinceId);
                if (provinceId) {
                    $.ajax({
                        url: '/api/districts/' + provinceId,
                        type: 'GET',
                        success: function(data) {
                            console.log('Add Modal - Districts fetched:', data);
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
                            console.error('Add Modal - Error fetching districts:', xhr.status, xhr.responseText);
                            $('#district_id').html('<option value="">Error Fetching Districts</option>');
                            $('#sector_id').html('<option value="">Select District First</option>');
                        }
                    });
                } else {
                    $('#district_id').html('<option value="">Select District</option>');
                    $('#sector_id').html('<option value="">Select Sector</option>');
                }
            });

            // Fetch sectors based on district (Add Modal)
            $('#district_id').on('change', function() {
                var districtId = $(this).val();
                console.log('Add Modal - District changed to:', districtId);
                if (districtId) {
                    $.ajax({
                        url: '/api/sectors/' + districtId,
                        type: 'GET',
                        success: function(data) {
                            console.log('Add Modal - Sectors fetched:', data);
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
                            console.error('Add Modal - Error fetching sectors:', xhr.status, xhr.responseText);
                            $('#sector_id').html('<option value="">Error Fetching Sectors</option>');
                        }
                    });
                } else {
                    $('#sector_id').html('<option value="">Select Sector</option>');
                }
            });

            // Add Company Form Submission
            $('#company-form').on('submit', function(e) {
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
                        $('#addCompanyModal').modal('hide');
                        $('#company-form')[0].reset();

                        table.row.add([
                            response.company.id,
                            response.company.company_name,
                            response.company.jobCategory?.name ?? 'N/A',
                            response.company.province?.name + ' ' + response.company.district?.name + ' ' + response.company.sector?.name,
                            `
                                <button class="btn btn-info btn-sm edit-btn" data-id="${response.company.id}" data-toggle="modal" data-target="#editCompanyModal-${response.company.id}">Edit</button>
                                <button class="btn btn-danger btn-sm delete-btn" data-id="${response.company.id}" data-toggle="modal" data-target="#deleteConfirmModal">Delete</button>
                            `
                        ]).draw(false);

                        activeModalId = '#addCompanyModal';
                        $('#successPopupMessage').text('Successfully created company!');
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

            // Edit Company Form Submission
            $(document).on('submit', '[id^="edit-company-form-"]', function(e) {
                e.preventDefault();
                var form = $(this);
                var companyId = form.attr('id').split('-').pop();
                $('.error').text('');
                $('#edit-success-message-' + companyId + ', #edit-error-message-' + companyId).addClass('d-none');

                var formData = new FormData(this);

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        var row = table.row($('tr[data-id="' + companyId + '"]'));
                        row.data([
                            response.company.id,
                            response.company.company_name,
                            response.company.jobCategory?.name ?? 'N/A',
                            response.company.province?.name + ' ' + response.company.district?.name + ' ' + response.company.sector?.name,
                            `
                                <button class="btn btn-info btn-sm edit-btn" data-id="${response.company.id}" data-toggle="modal" data-target="#editCompanyModal-${response.company.id}">Edit</button>
                                <button class="btn btn-danger btn-sm delete-btn" data-id="${response.company.id}" data-toggle="modal" data-target="#deleteConfirmModal">Delete</button>
                            `
                        ]).draw(false);

                        activeModalId = '#editCompanyModal-' + companyId;
                        $('#successPopupMessage').text('Successfully updated company!');
                        $('#successPopup').modal('show');
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                form.find('.error-' + key).text(value[0]);
                            });
                        } else {
                            $('#edit-error-message-' + companyId).removeClass('d-none').text('An error occurred: ' + xhr.responseText);
                        }
                    }
                });
            });

            // Handle edit modal events for all companies
            $('[id^="editCompanyModal-"]').on('show.bs.modal', function () {
                var companyId = $(this).attr('id').split('-').pop();
                var $modal = $(this);
                var provinceId = $('#province_id-' + companyId).val();
                var districtId = $('#district_id-' + companyId).data('selected') || '';
                var sectorId = $('#sector_id-' + companyId).data('selected') || '';
                
                console.log('Edit Modal - Opening for company:', companyId);
                console.log('Edit Modal - Initial Province ID from select:', provinceId);
                console.log('Edit Modal - Initial District ID from data-selected:', districtId);
                console.log('Edit Modal - Initial Sector ID from data-selected:', sectorId);

                // Fallback to company data if provinceId is empty
                if (!provinceId || provinceId === '') {
                    provinceId = $modal.find('[name="province_id"]').val() || '';
                    console.warn('Edit Modal - No province ID from select, falling back to form value:', provinceId);
                    if (provinceId) $('#province_id-' + companyId).val(provinceId);
                }

                if (!provinceId || provinceId === '') {
                    console.error('Edit Modal - No valid province ID for company ' + companyId + '. Cannot proceed.');
                    $('#district_id-' + companyId).html('<option value="">Select District</option>');
                    $('#sector_id-' + companyId).html('<option value="">Select Sector</option>');
                    return;
                }

                // Fetch districts
                console.log('Edit Modal - Fetching districts for province ID:', provinceId);
                $.ajax({
                    url: '/api/districts/' + provinceId,
                    type: 'GET',
                    success: function(data) {
                        console.log('Edit Modal - Districts fetched for province ' + provinceId + ':', data);
                        var districtHtml = '<option value="">Select District</option>';
                        if (data && Array.isArray(data) && data.length > 0) {
                            $.each(data, function(key, value) {
                                var isSelected = (value.id == districtId) ? 'selected' : '';
                                districtHtml += '<option value="' + value.id + '" ' + isSelected + '>' + value.name + '</option>';
                            });
                        } else {
                            console.warn('Edit Modal - No districts found for province ' + provinceId + '. Falling back to districtId:', districtId);
                            districtHtml = '<option value="' + districtId + '" selected>' + (districtId ? 'Unknown District' : 'Select District') + '</option>';
                        }
                        $('#district_id-' + companyId).html(districtHtml);

                        // Fetch sectors only if districtId exists and is valid
                        if (districtId && districtId !== '') {
                            console.log('Edit Modal - Fetching sectors for district ID:', districtId);
                            $.ajax({
                                url: '/api/sectors/' + districtId,
                                type: 'GET',
                                success: function(data) {
                                    console.log('Edit Modal - Sectors fetched for district ' + districtId + ':', data);
                                    var sectorHtml = '<option value="">Select Sector</option>';
                                    if (data && Array.isArray(data) && data.length > 0) {
                                        $.each(data, function(key, value) {
                                            var isSelected = (value.id == sectorId) ? 'selected' : '';
                                            sectorHtml += '<option value="' + value.id + '" ' + isSelected + '>' + value.name + '</option>';
                                        });
                                    } else {
                                        console.warn('Edit Modal - No sectors found for district ' + districtId + '. Falling back to sectorId:', sectorId);
                                        sectorHtml = '<option value="' + sectorId + '" selected>' + (sectorId ? 'Unknown Sector' : 'Select Sector') + '</option>';
                                    }
                                    $('#sector_id-' + companyId).html(sectorHtml);
                                },
                                error: function(xhr) {
                                    console.error('Edit Modal - Error fetching sectors for district ' + districtId + ':', xhr.status, xhr.responseText);
                                    $('#sector_id-' + companyId).html('<option value="' + sectorId + '" selected>' + (sectorId ? 'Unknown Sector' : 'Select Sector') + '</option>');
                                }
                            });
                        } else {
                            console.log('Edit Modal - No valid district ID available to fetch sectors.');
                            $('#sector_id-' + companyId).html('<option value="' + sectorId + '" selected>' + (sectorId ? 'Unknown Sector' : 'Select Sector') + '</option>');
                        }
                    },
                    error: function(xhr) {
                        console.error('Edit Modal - Error fetching districts for province ' + provinceId + ':', xhr.status, xhr.responseText);
                        $('#district_id-' + companyId).html('<option value="' + districtId + '" selected>' + (districtId ? 'Unknown District' : 'Select District') + '</option>');
                        $('#sector_id-' + companyId).html('<option value="' + sectorId + '" selected>' + (sectorId ? 'Unknown Sector' : 'Select Sector') + '</option>');
                    }
                });
            });

            // Fetch districts on province change for edit modals
            $(document).on('change', '[id^="province_id-"]', function() {
                var companyId = $(this).attr('id').split('-').pop();
                var provinceId = $(this).val();
                console.log('Edit Modal - Province changed for company ' + companyId + ':', provinceId);
                if (provinceId) {
                    $.ajax({
                        url: '/api/districts/' + provinceId,
                        type: 'GET',
                        success: function(data) {
                            console.log('Edit Modal - Districts fetched on province change:', data);
                            var html = '<option value="">Select District</option>';
                            if (data && Array.isArray(data) && data.length > 0) {
                                $.each(data, function(key, value) {
                                    html += '<option value="' + value.id + '">' + value.name + '</option>';
                                });
                            } else {
                                html = '<option value="">No Districts Available</option>';
                            }
                            $('#district_id-' + companyId).html(html);
                            $('#sector_id-' + companyId).html('<option value="">Select Sector</option>');
                        },
                        error: function(xhr) {
                            console.error('Edit Modal - Error fetching districts on province change:', xhr.status, xhr.responseText);
                            $('#district_id-' + companyId).html('<option value="">Error Fetching Districts</option>');
                            $('#sector_id-' + companyId).html('<option value="">Select District First</option>');
                        }
                    });
                } else {
                    $('#district_id-' + companyId).html('<option value="">Select District</option>');
                    $('#sector_id-' + companyId).html('<option value="">Select Sector</option>');
                }
            });

            // Fetch sectors on district change for edit modals
            $(document).on('change', '[id^="district_id-"]', function() {
                var companyId = $(this).attr('id').split('-').pop();
                var districtId = $(this).val();
                console.log('Edit Modal - District changed for company ' + companyId + ':', districtId);
                if (districtId) {
                    $.ajax({
                        url: '/api/sectors/' + districtId,
                        type: 'GET',
                        success: function(data) {
                            console.log('Edit Modal - Sectors fetched on district change:', data);
                            var html = '<option value="">Select Sector</option>';
                            if (data && Array.isArray(data) && data.length > 0) {
                                $.each(data, function(key, value) {
                                    html += '<option value="' + value.id + '">' + value.name + '</option>';
                                });
                            } else {
                                html = '<option value="">No Sectors Available</option>';
                            }
                            $('#sector_id-' + companyId).html(html);
                        },
                        error: function(xhr) {
                            console.error('Edit Modal - Error fetching sectors on district change:', xhr.status, xhr.responseText);
                            $('#sector_id-' + companyId).html('<option value="">Error Fetching Sectors</option>');
                        }
                    });
                } else {
                    $('#sector_id-' + companyId).html('<option value="">Select Sector</option>');
                }
            });

            // Delete Button Click
            $(document).on('click', '.delete-btn', function() {
                companyIdToDelete = $(this).data('id');
                $('#deleteConfirmModal').modal('show');
            });

            // Confirm Delete Action
            $('#confirmDeleteBtn').on('click', function() {
                if (companyIdToDelete) {
                    $.ajax({
                        url: '{{ url("/companies") }}/' + companyIdToDelete,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            table.row($('tr[data-id="' + companyIdToDelete + '"]')).remove().draw(false);
                            $('#deleteConfirmModal').modal('hide');
                            activeModalId = null;
                            $('#successPopupMessage').text('Successfully deleted company!');
                            $('#successPopup').modal('show');
                            companyIdToDelete = null;
                        },
                        error: function(xhr) {
                            $('#deleteConfirmModal').modal('hide');
                            alert('An error occurred: ' + xhr.responseText);
                            companyIdToDelete = null;
                        }
                    });
                }
            });

            // Cancel Delete Action
            $('#cancelDeleteBtn').on('click', function() {
                $('#deleteConfirmModal').modal('hide');
                companyIdToDelete = null;
            });

            // Success Popup OK Button
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