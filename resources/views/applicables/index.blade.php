@extends('layouts.adminlte')

@section('title', 'Applications')
@section('header', 'Applications')

@section('content')
<style>
    .card { border-radius: 10px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); }
    .card-header { background: linear-gradient(135deg, #007bff, #00c6ff); color: #fff; font-weight: 500; }
    .table-responsive { margin-top: 20px; }
    .modal-content { border-radius: 10px; }
    .btn-info, .btn-danger { margin-right: 5px; }
</style>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Application List</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addApplicationModal">
                        <i class="fas fa-plus"></i> Add Application
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="applicationsTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Applicant</th>
                                <th>Job</th>
                                <th>Phone</th>
                                <th>Applied</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($applicables as $applicable)
                                <tr>
                                    <td>{{ $applicable->id }}</td>
                                    <td>{{ $applicable->names }}</td>
                                    <td>{{ $applicable->job->title ?? 'N/A' }}</td>
                                    <td>{{ $applicable->phone }}</td>
                                    <td>{{ $applicable->created_at->diffForHumans() }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-info view-btn" data-id="{{ $applicable->id }}" data-toggle="modal" data-target="#viewApplicationModal{{ $applicable->id }}">
                                            View
                                        </button>
                                        <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $applicable->id }}" data-toggle="modal" data-target="#deleteApplicationModal{{ $applicable->id }}">
                                            Delete
                                        </button>
                                    </td>
                                </tr>

                                <!-- View Modal -->
                                <div class="modal fade" id="viewApplicationModal{{ $applicable->id }}" tabindex="-1" role="dialog" aria-labelledby="viewApplicationModalLabel{{ $applicable->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="viewApplicationModalLabel{{ $applicable->id }}">View Application #{{ $applicable->id }}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Applicant:</strong> {{ $applicable->names }}</p>
                                                <p><strong>Job:</strong> {{ $applicable->job->title ?? 'N/A' }}</p>
                                                <p><strong>Phone:</strong> {{ $applicable->phone }}</p>
                                                <p><strong>Email:</strong> {{ $applicable->email }}</p>
                                                <p><strong>ID Number:</strong> {{ $applicable->id_number }}</p>
                                                <p><strong>Department:</strong> {{ $applicable->department->name ?? 'N/A' }}</p>
                                                <p><strong>Location:</strong> {{ $applicable->sector->name ?? '' }}, {{ $applicable->district->name ?? '' }}, {{ $applicable->province->name ?? '' }}</p>
                                                <p><strong>Applied:</strong> {{ $applicable->created_at }}</p>
                                                @if ($applicable->cv)
                                                    <p><strong>CV:</strong> <a href="{{ Storage::url($applicable->cv) }}" target="_blank">Download</a></p>
                                                @endif
                                                @if ($applicable->degree)
                                                    <p><strong>Degree:</strong> <a href="{{ Storage::url($applicable->degree) }}" target="_blank">Download</a></p>
                                                @endif
                                                @if ($applicable->id_doc)
                                                    <p><strong>ID Doc:</strong> <a href="{{ Storage::url($applicable->id_doc) }}" target="_blank">Download</a></p>
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteApplicationModal{{ $applicable->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteApplicationModalLabel{{ $applicable->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteApplicationModalLabel{{ $applicable->id }}">Confirm Deletion</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete the application for {{ $applicable->names }}?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <form action="{{ route('applicables.destroy', $applicable) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No applications found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Application Modal -->
<div class="modal fade" id="addApplicationModal" tabindex="-1" role="dialog" aria-labelledby="addApplicationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addApplicationModalLabel">Add New Application</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="success-message" class="alert alert-success d-none" role="alert"></div>
                <div id="error-message" class="alert alert-danger d-none" role="alert"></div>
                <form id="application-form" action="{{ route('applicables.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="names">Full Name</label>
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
                        <label for="id_number">ID Number</label>
                        <input type="text" name="id_number" id="id_number" class="form-control" required>
                        <p class="text-danger error-id_number mt-1"></p>
                    </div>
                    <div class="form-group">
                        <label for="department_id">Department</label>
                        <select name="department_id" id="department_id" class="form-control" required>
                            <option value="">Select Department</option>
                            @foreach (\App\Models\Department::all() as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                        <p class="text-danger error-department_id mt-1"></p>
                    </div>
                    <div class="form-group">
                        <label for="province_id">Province</label>
                        <select name="province_id" id="province_id" class="form-control" required>
                            <option value="">Select Province</option>
                            @foreach (\App\Models\Province::all() as $province)
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
                    <div class="form-group">
                        <label for="job_id">Job</label>
                        <select name="job_id" id="job_id" class="form-control" required>
                            <option value="">Select Job</option>
                            @foreach (\App\Models\Job::all() as $job)
                                <option value="{{ $job->job_id }}">{{ $job->title }}</option>
                            @endforeach
                        </select>
                        <p class="text-danger error-job_id mt-1"></p>
                    </div>
                    <div class="form-group">
                        <label for="cv">CV (PDF, DOC, DOCX)</label>
                        <input type="file" name="cv" id="cv" class="form-control">
                        <p class="text-danger error-cv mt-1"></p>
                    </div>
                    <div class="form-group">
                        <label for="degree">Degree (PDF, DOC, DOCX)</label>
                        <input type="file" name="degree" id="degree" class="form-control">
                        <p class="text-danger error-degree mt-1"></p>
                    </div>
                    <div class="form-group">
                        <label for="id_doc">ID Document (PDF, JPG, PNG)</label>
                        <input type="file" name="id_doc" id="id_doc" class="form-control">
                        <p class="text-danger error-id_doc mt-1"></p>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Application</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
    // Initialize DataTable
    $('#applicationsTable').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        pageLength: 10
    });

    // Fetch Districts Dynamically
    $('#province_id').on('change', function() {
        var provinceId = $(this).val();
        $.ajax({
            url: '/api/districts/' + provinceId,
            type: 'GET',
            success: function(data) {
                var html = '<option value="">Select District</option>';
                if (data.length > 0) {
                    $.each(data, function(key, value) {
                        html += '<option value="' + value.id + '">' + value.name + '</option>';
                    });
                } else {
                    html += '<option disabled>No districts available</option>';
                }
                $('#district_id').html(html);
                $('#sector_id').html('<option value="">Select Sector</option>');
            },
            error: function(xhr) {
                $('#error-message').removeClass('d-none').text('Error fetching districts: ' + xhr.status);
                $('#district_id').html('<option value="">Error Fetching Districts</option>');
            }
        });
    });

    // Fetch Sectors Dynamically
    $('#district_id').on('change', function() {
        var districtId = $(this).val();
        $.ajax({
            url: '/api/sectors/' + districtId,
            type: 'GET',
            success: function(data) {
                var html = '<option value="">Select Sector</option>';
                if (data.length > 0) {
                    $.each(data, function(key, value) {
                        html += '<option value="' + value.id + '">' + value.name + '</option>';
                    });
                } else {
                    html += '<option disabled>No sectors available</option>';
                }
                $('#sector_id').html(html);
            },
            error: function(xhr) {
                $('#error-message').removeClass('d-none').text('Error fetching sectors: ' + xhr.status);
                $('#sector_id').html('<option value="">Error Fetching Sectors</option>');
            }
        });
    });

    // Form Submission
    $('#application-form').on('submit', function(e) {
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
                $('#success-message').removeClass('d-none').text(response.message);
                $('#addApplicationModal').modal('hide');
                setTimeout(() => window.location.reload(), 1500);
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        $('.error-' + key).text(value[0]);
                    });
                } else {
                    $('#error-message').removeClass('d-none').text('An error occurred: ' + xhr.status);
                }
            }
        });
    });
});
</script>
@endsection