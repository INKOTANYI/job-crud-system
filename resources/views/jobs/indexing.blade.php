@extends('layouts.adminlte')

@section('title', 'Job Listings')
@section('header', 'Job Listings')

@section('content')
<style>
    .card {
        transition: all 0.3s ease;
        border-radius: 10px;
        overflow: hidden;
        cursor: pointer;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15) !important;
    }
    .card-header {
        background: linear-gradient(135deg, #007bff, #00c6ff);
        color: #fff;
        font-weight: 500;
    }
    .card-success .card-header {
        background: linear-gradient(135deg, #28a745, #34ce57);
    }
</style>

<div class="row">
    <!-- Add New Job Card -->
    <div class="col-md-4">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-plus-circle mr-2"></i>Add New Job</h3>
            </div>
            <div class="card-body text-center">
                <p>Create a new job to manage.</p>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addJobModal">Add Job</button>
            </div>
        </div>
    </div>

    <!-- Job Cards -->
    @forelse ($jobs as $job)
        <div class="col-md-4">
            <div class="card card-primary" data-toggle="modal" data-target="#manageJobModal{{ $job->job_id }}">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-briefcase mr-2"></i>{{ $job->job_title }}</h3>
                </div>
                <div class="card-body">
                    <p><strong><i class="fas fa-map-marker-alt mr-1"></i>Location:</strong> {{ $job->location }}</p>
                    <p><strong><i class="fas fa-info-circle mr-1"></i>Description:</strong> {{ $job->job_description ?? 'N/A' }}</p>
                    @if ($job->logo)
                        <img src="{{ Storage::url($job->logo) }}" alt="Logo" class="img-fluid mb-2" style="max-height: 100px; border-radius: 5px;">
                    @endif
                </div>
            </div>
        </div>

        <!-- Manage Job Modal -->
        <div class="modal fade" id="manageJobModal{{ $job->job_id }}" tabindex="-1" role="dialog" aria-labelledby="manageJobModalLabel{{ $job->job_id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="manageJobModalLabel{{ $job->job_id }}">Manage {{ $job->job_title }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="success-message-{{ $job->job_id }}" class="alert alert-success d-none" role="alert"></div>
                        <div id="error-message-{{ $job->job_id }}" class="alert alert-danger d-none" role="alert"></div>
                        <!-- Edit Form -->
                        <form id="update-form-{{ $job->job_id }}" action="{{ route('jobs.update', $job->job_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="job_title_{{ $job->job_id }}">Job Title</label>
                                <input type="text" name="job_title" id="job_title_{{ $job->job_id }}" class="form-control" value="{{ $job->job_title }}" required>
                                <p class="text-danger error-job_title-{{ $job->job_id }} mt-1"></p>
                            </div>
                            <div class="form-group">
                                <label for="logo_{{ $job->job_id }}">Logo (Optional)</label>
                                <input type="file" name="logo" id="logo_{{ $job->job_id }}" class="form-control">
                                @if ($job->logo)
                                    <img src="{{ Storage::url($job->logo) }}" alt="Logo" class="img-fluid mt-2" style="max-height: 100px; border-radius: 5px;">
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="job_description_{{ $job->job_id }}">Description (Optional)</label>
                                <textarea name="job_description" id="job_description_{{ $job->job_id }}" class="form-control" rows="3">{{ $job->job_description }}</textarea>
                                <p class="text-danger error-job_description-{{ $job->job_id }} mt-1"></p>
                            </div>
                            <div class="form-group">
                                <label for="category_id_{{ $job->job_id }}">Category</label>
                                <select name="category_id" id="category_id_{{ $job->job_id }}" class="form-control" required>
                                    <option value="">Select Category</option>
                                    @foreach (\App\Models\Category::all() as $category)
                                        <option value="{{ $category->id }}" {{ $job->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <p class="text-danger error-category_id-{{ $job->job_id }} mt-1"></p>
                            </div>
                            <div class="form-group">
                                <label for="province_id_{{ $job->job_id }}">Province</label>
                                <select name="province_id" id="province_id_{{ $job->job_id }}" class="form-control" required>
                                    <option value="">Select Province</option>
                                    @foreach (\App\Models\Province::all() as $province)
                                        <option value="{{ $province->id }}" {{ $job->province_id == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
                                    @endforeach
                                </select>
                                <p class="text-danger error-province_id-{{ $job->job_id }} mt-1"></p>
                            </div>
                            <div class="form-group">
                                <label for="district_id_{{ $job->job_id }}">District</label>
                                <select name="district_id" id="district_id_{{ $job->job_id }}" class="form-control" required>
                                    <option value="">Select District</option>
                                    @if ($job->district_id)
                                        @foreach (\App\Models\District::where('province_id', $job->province_id)->get() as $district)
                                            <option value="{{ $district->id }}" {{ $job->district_id == $district->id ? 'selected' : '' }}>{{ $district->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <p class="text-danger error-district_id-{{ $job->job_id }} mt-1"></p>
                            </div>
                            <div class="form-group">
                                <label for="sector_id_{{ $job->job_id }}">Sector</label>
                                <select name="sector_id" id="sector_id_{{ $job->job_id }}" class="form-control" required>
                                    <option value="">Select Sector</option>
                                    @if ($job->sector_id)
                                        @foreach (\App\Models\Sector::where('district_id', $job->district_id)->get() as $sector)
                                            <option value="{{ $sector->id }}" {{ $job->sector_id == $sector->id ? 'selected' : '' }}>{{ $sector->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <p class="text-danger error-sector_id-{{ $job->job_id }} mt-1"></p>
                            </div>
                            <div class="form-group">
                                <label for="location_{{ $job->job_id }}">Location</label>
                                <input type="text" name="location" id="location_{{ $job->job_id }}" class="form-control" value="{{ $job->location }}" readonly>
                                <p class="text-danger error-location-{{ $job->job_id }} mt-1"></p>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Job</button>
                        </form>

                        <!-- Delete Button -->
                        <form id="delete-form-{{ $job->job_id }}" action="{{ route('jobs.destroy', $job->job_id) }}" method="POST" class="mt-3">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger" onclick="confirmDelete('{{ $job->job_id }}')">Delete Job</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info">No jobs found. Use the "Add New Job" card to create one!</div>
        </div>
    @endforelse
</div>

<!-- Add Job Modal -->
<div class="modal fade" id="addJobModal" tabindex="-1" role="dialog" aria-labelledby="addJobModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addJobModalLabel">Add New Job</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="success-message" class="alert alert-success d-none" role="alert"></div>
                <div id="error-message" class="alert alert-danger d-none" role="alert"></div>
                <form id="job-form" action="{{ route('jobs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="job_title">Job Title</label>
                        <input type="text" name="job_title" id="job_title" class="form-control" required>
                        <p class="text-danger error-job_title mt-1"></p>
                    </div>
                    <div class="form-group">
                        <label for="logo">Logo (Optional)</label>
                        <input type="file" name="logo" id="logo" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="job_description">Description (Optional)</label>
                        <textarea name="job_description" id="job_description" class="form-control" rows="3"></textarea>
                        <p class="text-danger error-job_description mt-1"></p>
                    </div>
                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select name="category_id" id="category_id" class="form-control" required>
                            <option value="">Select Category</option>
                            @foreach (\App\Models\Category::all() as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <p class="text-danger error-category_id mt-1"></p>
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
                        <label for="location">Location</label>
                        <input type="text" name="location" id="location" class="form-control" readonly>
                        <p class="text-danger error-location mt-1"></p>
                    </div>
                    <button type="submit" class="btn btn-primary">Create Job</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    console.log('jobs.blade.php content section loaded at 04:10 PM CAT, June 22, 2025');
    $('.card-primary').on('click', function() {
        var targetModal = $(this).data('target');
        $(targetModal).modal('show');
    });

    // Reusable Function to Fetch Districts
    function fetchDistricts(provinceId, districtSelectId, errorMessageId, callback = null) {
        if (provinceId) {
            $.ajax({
                url: '/api/districts/' + provinceId,
                type: 'GET',
                success: function(data) {
                    console.log('Districts fetched for Province ID ' + provinceId + ':', data);
                    var html = '<option value="">Select District</option>';
                    if (data && data.length > 0) {
                        $.each(data, function(key, value) {
                            html += '<option value="' + value.id + '">' + value.name + '</option>';
                        });
                    } else {
                        html += '<option disabled>No districts available</option>';
                    }
                    $(districtSelectId).html(html);
                    if (callback) callback();
                },
                error: function(xhr) {
                    console.error('Error fetching districts:', xhr.status, xhr.responseText);
                    $(errorMessageId).removeClass('d-none').text('Error fetching districts: ' + xhr.status);
                    $(districtSelectId).html('<option value="">Error Fetching Districts</option>');
                }
            });
        } else {
            $(districtSelectId).html('<option value="">Select Province First</option>');
            if (callback) callback();
        }
    }

    // Reusable Function to Fetch Sectors
    function fetchSectors(districtId, sectorSelectId, errorMessageId, callback = null) {
        if (districtId) {
            $.ajax({
                url: '/api/sectors/' + districtId,
                type: 'GET',
                success: function(data) {
                    console.log('Sectors fetched for District ID ' + districtId + ':', data);
                    var html = '<option value="">Select Sector</option>';
                    if (data && data.length > 0) {
                        $.each(data, function(key, value) {
                            html += '<option value="' + value.id + '">' + value.name + '</option>';
                        });
                    } else {
                        html += '<option disabled>No sectors available</option>';
                    }
                    $(sectorSelectId).html(html);
                    if (callback) callback();
                },
                error: function(xhr) {
                    console.error('Error fetching sectors:', xhr.status, xhr.responseText);
                    $(errorMessageId).removeClass('d-none').text('Error fetching sectors: ' + xhr.status);
                    $(sectorSelectId).html('<option value="">Error Fetching Sectors</option>');
                }
            });
        } else {
            $(sectorSelectId).html('<option value="">Select District First</option>');
            if (callback) callback();
        }
    }

    // Reusable Function to Update Location
    function updateLocation(provinceSelectId, districtSelectId, sectorSelectId, locationInputId) {
        var provinceName = $(provinceSelectId + ' option:selected').text();
        var districtName = $(districtSelectId + ' option:selected').text();
        var sectorName = $(sectorSelectId + ' option:selected').text();

        if (provinceName && districtName && sectorName &&
            provinceName !== 'Select Province' && districtName !== 'Select District' && sectorName !== 'Select Sector') {
            var generatedLocation = sectorName + ', ' + districtName + ', ' + provinceName;
            $(locationInputId).val(generatedLocation);
        } else {
            $(locationInputId).val('');
        }
    }

    // Add Modal Handlers
    $(document).on('change', '#province_id', function() {
        var provinceId = $(this).val();
        console.log('Add Modal - Province changed to:', provinceId);
        fetchDistricts(provinceId, '#district_id', '#error-message', function() {
            $('#sector_id').html('<option value="">Select Sector</option>');
            updateLocation('#province_id', '#district_id', '#sector_id', '#location');
        });
    });

    $(document).on('change', '#district_id', function() {
        var districtId = $(this).val();
        console.log('Add Modal - District changed to:', districtId);
        fetchSectors(districtId, '#sector_id', '#error-message', function() {
            updateLocation('#province_id', '#district_id', '#sector_id', '#location');
        });
    });

    $(document).on('change', '#sector_id', function() {
        updateLocation('#province_id', '#district_id', '#sector_id', '#location');
    });

    // Add Job Form Submission
    $('#job-form').on('submit', function(e) {
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
                $('#success-message').removeClass('d-none').text(response.message || 'Job created successfully!');
                $('#addJobModal').modal('hide');
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        $('.error-' + key).text(value[0]);
                    });
                } else {
                    $('#error-message').removeClass('d-none').text('An error occurred: ' + xhr.status + ' - ' + (xhr.responseJSON?.message || xhr.responseText));
                }
            }
        });
    });

    // Manage Modal Initialization
    $('.modal').on('shown.bs.modal', function() {
        var modalId = $(this).attr('id');
        if (!modalId.startsWith('manageJobModal')) return;

        var jobId = modalId.replace('manageJobModal', '');
        console.log('Manage Modal opened for Job ID:', jobId);
        console.log('Initial Province ID:', $('#province_id_' + jobId).val() ?? 'null');
        console.log('Initial District ID:', $('#district_id_' + jobId).val() ?? 'null');
        console.log('Initial Sector ID:', $('#sector_id_' + jobId).val() ?? 'null');

        var provinceId = $('#province_id_' + jobId).val();
        console.log('Selected Province ID on modal show:', provinceId);

        if (provinceId) {
            fetchDistricts(provinceId, '#district_id_' + jobId, '#error-message-' + jobId, function() {
                var districtId = $('#district_id_' + jobId).val();
                if (districtId) {
                    fetchSectors(districtId, '#sector_id_' + jobId, '#error-message-' + jobId, function() {
                        var sectorId = $('#sector_id_' + jobId).val();
                        if (sectorId) {
                            updateLocation('#province_id_' + jobId, '#district_id_' + jobId, '#sector_id_' + jobId, '#location_' + jobId);
                        } else {
                            $('#location_' + jobId).val('');
                        }
                    });
                } else {
                    $('#sector_id_' + jobId).html('<option value="">Select District First</option>');
                    $('#location_' + jobId).val('');
                }
            });
        } else {
            $('#district_id_' + jobId).html('<option value="">Select Province First</option>');
            $('#sector_id_' + jobId).html('<option value="">Select District First</option>');
            $('#location_' + jobId).val('');
        }
    });

    // Manage Modal Province Change
    $(document).on('change', '[id^=province_id_]', function() {
        var jobId = $(this).attr('id').replace('province_id_', '');
        var provinceId = $(this).val();
        console.log('Manage Modal - Province changed to:', provinceId, 'for Job ID:', jobId);
        fetchDistricts(provinceId, '#district_id_' + jobId, '#error-message-' + jobId, function() {
            $('#sector_id_' + jobId).html('<option value="">Select Sector</option>');
            updateLocation('#province_id_' + jobId, '#district_id_' + jobId, '#sector_id_' + jobId, '#location_' + jobId);
        });
    });

    // Manage Modal District Change
    $(document).on('change', '[id^=district_id_]', function() {
        var jobId = $(this).attr('id').replace('district_id_', '');
        var districtId = $(this).val();
        console.log('Manage Modal - District changed to:', districtId, 'for Job ID:', jobId);
        fetchSectors(districtId, '#sector_id_' + jobId, '#error-message-' + jobId, function() {
            updateLocation('#province_id_' + jobId, '#district_id_' + jobId, '#sector_id_' + jobId, '#location_' + jobId);
        });
    });

    // Manage Modal Sector Change
    $(document).on('change', '[id^=sector_id_]', function() {
        var jobId = $(this).attr('id').replace('sector_id_', '');
        updateLocation('#province_id_' + jobId, '#district_id_' + jobId, '#sector_id_' + jobId, '#location_' + jobId);
    });

    // Manage Modal Update Form Submission
    $('[id^=update-form-]').on('submit', function(e) {
        e.preventDefault();
        var jobId = $(this).attr('id').replace('update-form-', '');
        $('.error-' + jobId).text('');
        $('#success-message-' + jobId + ', #error-message-' + jobId).addClass('d-none');

        var formData = new FormData(this);

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#success-message-' + jobId).removeClass('d-none').text(response.message || 'Job updated successfully!');
                $('#manageJobModal' + jobId).modal('hide');
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        $('.error-' + key + '-' + jobId).text(value[0]);
                    });
                } else {
                    $('#error-message-' + jobId).removeClass('d-none').text('An error occurred: ' + xhr.status + ' - ' + (xhr.responseJSON?.message || xhr.responseText));
                }
            }
        });
    });

    // Manage Modal Delete Form Submission
    function confirmDelete(jobId) {
        if (confirm('Are you sure you want to delete this job?')) {
            $.ajax({
                url: $('#delete-form-' + jobId).attr('action'),
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    _method: 'DELETE'
                },
                success: function(response) {
                    $('#success-message-' + jobId).removeClass('d-none').text(response.message || 'Job deleted successfully!');
                    $('#manageJobModal' + jobId).modal('hide');
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                },
                error: function(xhr) {
                    $('#error-message-' + jobId).removeClass('d-none').text('Error deleting job: ' + xhr.status + ' - ' + (xhr.responseJSON?.message || xhr.responseText));
                }
            });
        }
    }
});
</script>
@endsection