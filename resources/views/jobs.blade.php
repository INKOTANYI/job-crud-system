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
                        <a href="{{ url('/companies') }}" class="nav-link">
                            <i class="nav-icon fas fa-building"></i>
                            <p>Companies</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/jobs') }}" class="nav-link active">
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
                        <h1 class="m-0">Jobs</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                @endif

                <div class="row mb-3">
                    <div class="col-12 text-right">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#jobModal" data-action="add">
                            <i class="fas fa-plus"></i> Add Job
                        </button>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List of Jobs</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-responsive" id="jobsTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Job ID</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Qualification</th>
                                    <th>Company</th>
                                    <th>Deadline</th>
                                    <th>Location</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="main-footer text-center">
        <strong>© 2025 JobRwanda. All rights reserved.</strong>
    </footer>

    <!-- Reusable Job Modal -->
    <div class="modal fade" id="jobModal" tabindex="-1" role="dialog" aria-labelledby="jobModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="jobModalLabel">Add New Job</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="message" class="alert d-none" role="alert"></div>
                    <form id="jobForm" method="POST">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="job_id" id="job_id">
                        <div class="row">
                            <div class="col-12 col-md-6 form-group">
                                <label for="job_title">Title</label>
                                <input type="text" name="job_title" id="job_title" class="form-control" required>
                            </div>
                            <div class="col-12 col-md-6 form-group">
                                <label for="job_deadline">Deadline</label>
                                <input type="date" name="job_deadline" id="job_deadline" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 form-group">
                                <label for="job_description">Description</label>
                                <textarea name="job_description" id="job_description" class="form-control" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 form-group">
                                <label for="job_qualification">Qualification</label>
                                <textarea name="job_qualification" id="job_qualification" class="form-control" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6 form-group">
                                <label for="company_id">Company</label>
                                <select name="company_id" id="company_id" class="form-control" required>
                                    <option value="">Select Company</option>
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-md-6 form-group">
                                <label for="department_id">Department</label>
                                <select name="department_id" id="department_id" class="form-control" required>
                                    <option value="">Select Department</option>
                                    @foreach ($departments as $dept)
                                        <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-4 form-group">
                                <label for="province_id">Province</label>
                                <select name="province_id" id="province_id" class="form-control province-select" data-district-id="district_id" required>
                                    <option value="">Select Province</option>
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-md-4 form-group">
                                <label for="district_id">District</label>
                                <select name="district_id" id="district_id" class="form-control district-select" data-sector-id="sector_id" required>
                                    <option value="">Select District</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-4 form-group">
                                <label for="sector_id">Sector</label>
                                <select name="sector_id" id="sector_id" class="form-control" required>
                                    <option value="">Select Sector</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-right">
                                <button type="submit" class="btn btn-primary" id="submitBtn">Create Job</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content custom-modal">
                <div class="modal-body text-center">
                    <span class="warning-icon">⚠️</span>
                    <h4 class="modal-title" id="deleteModalLabel">Confirm Deletion</h4>
                    <p>Are you sure you want to delete this job?</p>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content custom-modal">
                <div class="modal-body text-center">
                    <span class="check-icon">✓</span>
                    <h4 class="modal-title" id="successModalLabel">Success!</h4>
                    <p id="successMessage">Operation completed.</p>
                    <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
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
        .custom-modal { border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
        .check-icon, .warning-icon { font-size: 40px; display: block; margin-bottom: 10px; }
        .check-icon { color: #28a745; }
        .warning-icon { color: #dc3545; }
        .modal-body { padding: 20px; }
        .btn { padding: 5px 15px; margin-right: 10px; }
        .btn-success { background-color: #28a745; border-color: #28a745; }
        .btn-success:hover { background-color: #218838; border-color: #1e7e34; }
        .btn-danger { background-color: #dc3545; border-color: #dc3545; }
        .btn-danger:hover { background-color: #c82333; border-color: #bd2130; }
        .btn-secondary { background-color: #6c757d; border-color: #6c757d; }
        .btn-secondary:hover { background-color: #5a6268; border-color: #545b62; }
        @media (max-width: 768px) {
            .modal-dialog { margin: 0.5rem; }
            .row > .col-md-6, .row > .col-md-4 { margin-bottom: 15px; }
            .table-responsive { display: block; width: 100%; overflow-x: auto; }
        }
    </style>
   <script>
    $(document).ready(function() {
        var table = $('#jobsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route("jobs.index") }}',
                type: 'GET',
                dataSrc: function(json) {
                    if (!json.data || !Array.isArray(json.data)) {
                        console.error('Invalid data structure:', json);
                        return [];
                    }
                    return json.data.map(row => {
                        // Ensure all required fields exist, fallback to null if missing
                        return {
                            job_id: row.job_id || null,
                            job_title: row.job_title || 'N/A',
                            job_description: row.job_description || '',
                            job_qualification: row.job_qualification || '',
                            company: row.company || {},
                            job_deadline: row.job_deadline || '',
                            province: row.province || {},
                            district: row.district || {},
                            sector: row.sector || {}
                        };
                    });
                }
            },
            columns: [
                { data: 'job_id', defaultContent: 'N/A' },
                { data: 'job_title', defaultContent: 'N/A' },
                { data: function(row) {
                    return row.job_description ? row.job_description.split(' ').slice(0, 20).join(' ') + (row.job_description.split(' ').length > 20 ? '...' : '') : 'N/A';
                }},
                { data: function(row) {
                    return row.job_qualification ? row.job_qualification.split(' ').slice(0, 20).join(' ') + (row.job_qualification.split(' ').length > 20 ? '...' : '') : 'N/A';
                }},
                { data: 'company.company_name', defaultContent: 'N/A' },
                { data: 'job_deadline', defaultContent: 'N/A' },
                { data: function(row) {
                    return [row.province?.name, row.district?.name, row.sector?.name].filter(Boolean).join(', ') || 'N/A';
                }},
                { data: null, render: function(data) {
                    return `
                        <button class="btn btn-info btn-sm edit-btn" data-id="${data.job_id || ''}" data-toggle="modal" data-target="#jobModal" data-action="edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-danger btn-sm delete-btn" data-id="${data.job_id || ''}" data-toggle="modal" data-target="#deleteModal">
                            <i class="fas fa-trash"></i>
                        </button>
                    `;
                }}
            ],
            pageLength: 10,
            responsive: true,
            // Add error handling for DataTable
            error: function(xhr, error, thrown) {
                console.error('DataTable AJAX error:', xhr.status, error, thrown);
            }
        });
        var jobIdToDelete = null;

        // Dependent Dropdowns
        function updateDistricts(provinceId, districtId) {
            if (provinceId) {
                $.ajax({
                    url: '/api/districts/' + provinceId,
                    type: 'GET',
                    success: function(data) {
                        var html = '<option value="">Select District</option>';
                        if (data?.length) {
                            $.each(data, function(k, v) {
                                html += `<option value="${v.id}">${v.name}</option>`;
                            });
                        } else {
                            html += '<option value="">No districts available</option>';
                        }
                        $(districtId).html(html).prop('disabled', false);
                        $(districtId).next('select').html('<option value="">Select Sector</option>').prop('disabled', true);
                    },
                    error: function(xhr) {
                        console.error('Districts error:', xhr.status, xhr.responseText);
                        $(districtId).html('<option value="">Error loading districts</option>').prop('disabled', true);
                        $(districtId).next('select').html('<option value="">Select Sector</option>').prop('disabled', true);
                    }
                });
            } else {
                $(districtId).html('<option value="">Select District</option>').prop('disabled', true);
                $(districtId).next('select').html('<option value="">Select Sector</option>').prop('disabled', true);
            }
        }

        function updateSectors(districtId, sectorId) {
            if (districtId) {
                $.ajax({
                    url: '/api/sectors/' + districtId,
                    type: 'GET',
                    success: function(data) {
                        var html = '<option value="">Select Sector</option>';
                        if (data?.length) {
                            $.each(data, function(k, v) {
                                html += `<option value="${v.id}">${v.name}</option>`;
                            });
                        } else {
                            html += '<option value="">No sectors available</option>';
                            console.warn('No sectors found for district:', districtId);
                        }
                        $(sectorId).html(html).prop('disabled', false);
                    },
                    error: function(xhr) {
                        console.error('Sectors error:', xhr.status, xhr.responseText);
                        $(sectorId).html('<option value="">Error loading sectors</option>').prop('disabled', true);
                    }
                });
            } else {
                $(sectorId).html('<option value="">Select Sector</option>').prop('disabled', true);
            }
        }

        $('.province-select').on('change', function() {
            var provinceId = $(this).val();
            var districtId = '#' + $(this).data('district-id');
            updateDistricts(provinceId, districtId);
        });

        $('.district-select').on('change', function() {
            var districtId = $(this).val();
            var sectorId = '#' + $(this).data('sector-id');
            updateSectors(districtId, sectorId);
        });

        // Modal Handling
        $('#jobModal').on('show.bs.modal', function(e) {
            var button = $(e.relatedTarget);
            var action = button.data('action');
            var jobId = button.data('id') || '';
            var title = action === 'edit' ? 'Edit Job' : 'Add New Job';
            var method = action === 'edit' ? 'PUT' : 'POST';
            var url = action === 'edit' ? '{{ url("/jobs") }}/' + jobId : '{{ route("jobs.store") }}';

            $('#jobModalLabel').text(title);
            $('#jobForm').attr('action', url).attr('method', method).find('#job_id').val(jobId);
            $('#message').addClass('d-none');

            if (action === 'edit') {
                $.ajax({
                    url: '{{ url("/jobs") }}/' + jobId,
                    type: 'GET',
                    success: function(data) {
                        $('#job_title').val(data.job_title || '');
                        $('#job_description').val(data.job_description || '');
                        $('#job_qualification').val(data.job_qualification || '');
                        $('#company_id').val(data.company_id || '');
                        $('#department_id').val(data.department_id || '');
                        $('#job_deadline').val(data.job_deadline || '');
                        $('#province_id').val(data.province_id || '').trigger('change');
                        $('#district_id').val(data.district_id || '');
                        $('#sector_id').val(data.sector_id || '');
                    },
                    error: function(xhr) {
                        console.error('Edit data error:', xhr.status, xhr.responseText);
                    }
                });
            } else {
                $('#jobForm')[0].reset();
                $('#district_id').prop('disabled', true).html('<option value="">Select District</option>');
                $('#sector_id').prop('disabled', true).html('<option value="">Select Sector</option>');
            }
        });

        $('#jobForm').on('submit', function(e) {
            e.preventDefault();
            var url = $(this).attr('action');
            var method = $(this).attr('method');

            $.ajax({
                url: url,
                type: method,
                data: $(this).serialize(),
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function(response) {
                    $('#jobModal').modal('hide');
                    var job = response.job || {};
                    var rowData = [
                        job.job_id || 'N/A',
                        job.job_title || 'N/A',
                        job.job_description ? job.job_description.split(' ').slice(0, 20).join(' ') + (job.job_description.split(' ').length > 20 ? '...' : '') : 'N/A',
                        job.job_qualification ? job.job_qualification.split(' ').slice(0, 20).join(' ') + (job.job_qualification.split(' ').length > 20 ? '...' : '') : 'N/A',
                        job.company?.company_name ?? 'N/A',
                        job.job_deadline || 'N/A',
                        [job.province?.name, job.district?.name, job.sector?.name].filter(Boolean).join(', ') || 'N/A',
                        `
                            <button class="btn btn-info btn-sm edit-btn" data-id="${job.job_id || ''}" data-toggle="modal" data-target="#jobModal" data-action="edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-danger btn-sm delete-btn" data-id="${job.job_id || ''}" data-toggle="modal" data-target="#deleteModal">
                                <i class="fas fa-trash"></i>
                            </button>
                        `
                    ];
                    if (method === 'POST') table.row.add(rowData).draw(false);
                    else table.row($('tr[data-id="' + (job.job_id || '') + '"]')).data(rowData).draw(false);
                    $('#successMessage').text(`Successfully ${method === 'POST' ? 'created' : 'updated'} job!`);
                    $('#successModal').modal('show');
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        $('#message').html(Object.values(xhr.responseJSON.errors || {}).join('<br>')).removeClass('d-none alert-success').addClass('alert-danger');
                    } else {
                        $('#message').text('Error: ' + (xhr.responseText || 'Unknown error')).removeClass('d-none alert-success').addClass('alert-danger');
                    }
                    console.error('Form submission error:', xhr.status, xhr.responseText);
                }
            });
        });

        $('.delete-btn').on('click', function() {
            jobIdToDelete = $(this).data('id');
        });

        $('#confirmDelete').on('click', function() {
            if (jobIdToDelete) {
                $.ajax({
                    url: '{{ url("/jobs") }}/' + jobIdToDelete,
                    type: 'DELETE',
                    data: { _token: $('meta[name="csrf-token"]').attr('content') },
                    success: function(response) {
                        table.row($('tr[data-id="' + jobIdToDelete + '"]')).remove().draw(false);
                        $('#deleteModal').modal('hide');
                        $('#successMessage').text('Successfully deleted job!');
                        $('#successModal').modal('show');
                        jobIdToDelete = null;
                    },
                    error: function(xhr) {
                        $('#deleteModal').modal('hide');
                        alert('Error: ' + (xhr.responseText || 'Unknown error'));
                        console.error('Delete error:', xhr.status, xhr.responseText);
                        jobIdToDelete = null;
                    }
                });
            }
        });
    });
</script>
@endsection