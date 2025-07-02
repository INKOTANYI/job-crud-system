@extends('layouts.adminlte')

@section('title', 'Companies')
@section('header', 'Companies')

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
    <!-- Add New Company Card -->
    <div class="col-md-4">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-plus-circle mr-2"></i>Add New Company</h3>
            </div>
            <div class="card-body text-center">
                <p>Create a new company to manage.</p>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addCompanyModal">Add Company</button>
            </div>
        </div>
    </div>

    <!-- Company Cards -->
    @forelse ($companies as $company)
        <div class="col-md-4">
            <div class="card card-primary" data-toggle="modal" data-target="#manageCompanyModal{{ $company->id }}">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-building mr-2"></i>{{ $company->company_name }}</h3>
                </div>
                <div class="card-body">
                    <p><strong><i class="fas fa-map-marker-alt mr-1"></i>Location:</strong> {{ $company->location }}</p>
                    <p><strong><i class="fas fa-info-circle mr-1"></i>Description:</strong> {{ $company->description ?? 'N/A' }}</p>
                    @if ($company->logo)
                        <img src="{{ Storage::url($company->logo) }}" alt="Logo" class="img-fluid mb-2" style="max-height: 100px; border-radius: 5px;">
                    @endif
                </div>
            </div>
        </div>

        <!-- Manage Company Modal -->
        <div class="modal fade" id="manageCompanyModal{{ $company->id }}" tabindex="-1" role="dialog" aria-labelledby="manageCompanyModalLabel{{ $company->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="manageCompanyModalLabel{{ $company->id }}">Manage {{ $company->company_name }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="success-message-{{ $company->id }}" class="alert alert-success d-none" role="alert"></div>
                        <div id="error-message-{{ $company->id }}" class="alert alert-danger d-none" role="alert"></div>
                        <!-- Edit Form -->
                        <form id="update-form-{{ $company->id }}" action="{{ route('companies.update', $company) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="company_name_{{ $company->id }}">Company Name</label>
                                <input type="text" name="company_name" id="company_name_{{ $company->id }}" class="form-control" value="{{ $company->company_name }}" required>
                                <p class="text-danger error-company_name-{{ $company->id }} mt-1"></p>
                            </div>
                            <div class="form-group">
                                <label for="logo_{{ $company->id }}">Logo (Optional)</label>
                                <input type="file" name="logo" id="logo_{{ $company->id }}" class="form-control">
                                @if ($company->logo)
                                    <img src="{{ Storage::url($company->logo) }}" alt="Logo" class="img-fluid mt-2" style="max-height: 100px; border-radius: 5px;">
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="description_{{ $company->id }}">Description (Optional)</label>
                                <textarea name="description" id="description_{{ $company->id }}" class="form-control" rows="3">{{ $company->description }}</textarea>
                                <p class="text-danger error-description-{{ $company->id }} mt-1"></p>
                            </div>
                            <div class="form-group">
                                <label for="category_id_{{ $company->id }}">Category</label>
                                <select name="category_id" id="category_id_{{ $company->id }}" class="form-control" required>
                                    <option value="">Select Category</option>
                                    @foreach (\App\Models\Category::all() as $category)
                                        <option value="{{ $category->id }}" {{ $company->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <p class="text-danger error-category_id-{{ $company->id }} mt-1"></p>
                            </div>
                            <div class="form-group">
                                <label for="province_id_{{ $company->id }}">Province</label>
                                <select name="province_id" id="province_id_{{ $company->id }}" class="form-control" required>
                                    <option value="">Select Province</option>
                                    @foreach (\App\Models\Province::all() as $province)
                                        <option value="{{ $province->id }}" {{ $company->province_id == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
                                    @endforeach
                                </select>
                                <p class="text-danger error-province_id-{{ $company->id }} mt-1"></p>
                            </div>
                            <div class="form-group">
                                <label for="district_id_{{ $company->id }}">District</label>
                                <select name="district_id" id="district_id_{{ $company->id }}" class="form-control" required>
                                    <option value="">Select District</option>
                                    @if ($company->district_id)
                                        @foreach (\App\Models\District::where('province_id', $company->province_id)->get() as $district)
                                            <option value="{{ $district->id }}" {{ $company->district_id == $district->id ? 'selected' : '' }}>{{ $district->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <p class="text-danger error-district_id-{{ $company->id }} mt-1"></p>
                            </div>
                            <div class="form-group">
                                <label for="sector_id_{{ $company->id }}">Sector</label>
                                <select name="sector_id" id="sector_id_{{ $company->id }}" class="form-control" required>
                                    <option value="">Select Sector</option>
                                    @if ($company->sector_id)
                                        @foreach (\App\Models\Sector::where('district_id', $company->district_id)->get() as $sector)
                                            <option value="{{ $sector->id }}" {{ $company->sector_id == $sector->id ? 'selected' : '' }}>{{ $sector->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <p class="text-danger error-sector_id-{{ $company->id }} mt-1"></p>
                            </div>
                            <div class="form-group">
                                <label for="location_{{ $company->id }}">Location</label>
                                <input type="text" name="location" id="location_{{ $company->id }}" class="form-control" value="{{ $company->location }}" readonly>
                                <p class="text-danger error-location-{{ $company->id }} mt-1"></p>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Company</button>
                        </form>

                        <!-- Delete Button -->
                        <form id="delete-form-{{ $company->id }}" action="{{ route('companies.destroy', $company) }}" method="POST" class="mt-3">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger" onclick="confirmDelete('{{ $company->id }}')">Delete Company</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info">No companies found. Use the "Add New Company" card to create one!</div>
        </div>
    @endforelse
</div>

<!-- Add Company Modal -->
<div class="modal fade" id="addCompanyModal" tabindex="-1" role="dialog" aria-labelledby="addCompanyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
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
                    <button type="submit" class="btn btn-primary">Create Company</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    console.log('companies.blade.php content section loaded at 01:40 AM CAT, May 22, 2025');
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
                $('#success-message').removeClass('d-none').text(response.message || 'Company created successfully!');
                $('#addCompanyModal').modal('hide');
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
        if (!modalId.startsWith('manageCompanyModal')) return;

        var companyId = modalId.replace('manageCompanyModal', '');
        console.log('Manage Modal opened for Company ID:', companyId);
        console.log('Initial Province ID:', $('#province_id_' + companyId).val() ?? 'null');
        console.log('Initial District ID:', $('#district_id_' + companyId).val() ?? 'null');
        console.log('Initial Sector ID:', $('#sector_id_' + companyId).val() ?? 'null');

        var provinceId = $('#province_id_' + companyId).val();
        console.log('Selected Province ID on modal show:', provinceId);

        if (provinceId) {
            fetchDistricts(provinceId, '#district_id_' + companyId, '#error-message-' + companyId, function() {
                var districtId = $('#district_id_' + companyId).val();
                if (districtId) {
                    fetchSectors(districtId, '#sector_id_' + companyId, '#error-message-' + companyId, function() {
                        var sectorId = $('#sector_id_' + companyId).val();
                        if (sectorId) {
                            updateLocation('#province_id_' + companyId, '#district_id_' + companyId, '#sector_id_' + companyId, '#location_' + companyId);
                        } else {
                            $('#location_' + companyId).val('');
                        }
                    });
                } else {
                    $('#sector_id_' + companyId).html('<option value="">Select District First</option>');
                    $('#location_' + companyId).val('');
                }
            });
        } else {
            $('#district_id_' + companyId).html('<option value="">Select Province First</option>');
            $('#sector_id_' + companyId).html('<option value="">Select District First</option>');
            $('#location_' + companyId).val('');
        }
    });

    // Manage Modal Province Change
    $(document).on('change', '[id^=province_id_]', function() {
        var companyId = $(this).attr('id').replace('province_id_', '');
        var provinceId = $(this).val();
        console.log('Manage Modal - Province changed to:', provinceId, 'for Company ID:', companyId);
        fetchDistricts(provinceId, '#district_id_' + companyId, '#error-message-' + companyId, function() {
            $('#sector_id_' + companyId).html('<option value="">Select Sector</option>');
            updateLocation('#province_id_' + companyId, '#district_id_' + companyId, '#sector_id_' + companyId, '#location_' + companyId);
        });
    });

    // Manage Modal District Change
    $(document).on('change', '[id^=district_id_]', function() {
        var companyId = $(this).attr('id').replace('district_id_', '');
        var districtId = $(this).val();
        console.log('Manage Modal - District changed to:', districtId, 'for Company ID:', companyId);
        fetchSectors(districtId, '#sector_id_' + companyId, '#error-message-' + companyId, function() {
            updateLocation('#province_id_' + companyId, '#district_id_' + companyId, '#sector_id_' + companyId, '#location_' + companyId);
        });
    });

    // Manage Modal Sector Change
    $(document).on('change', '[id^=sector_id_]', function() {
        var companyId = $(this).attr('id').replace('sector_id_', '');
        updateLocation('#province_id_' + companyId, '#district_id_' + companyId, '#sector_id_' + companyId, '#location_' + companyId);
    });

    // Manage Modal Update Form Submission
    $('[id^=update-form-]').on('submit', function(e) {
        e.preventDefault();
        var companyId = $(this).attr('id').replace('update-form-', '');
        $('.error-' + companyId).text('');
        $('#success-message-' + companyId + ', #error-message-' + companyId).addClass('d-none');

        var formData = new FormData(this);

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#success-message-' + companyId).removeClass('d-none').text(response.message || 'Company updated successfully!');
                $('#manageCompanyModal' + companyId).modal('hide');
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        $('.error-' + key + '-' + companyId).text(value[0]);
                    });
                } else {
                    $('#error-message-' + companyId).removeClass('d-none').text('An error occurred: ' + xhr.status + ' - ' + (xhr.responseJSON?.message || xhr.responseText));
                }
            }
        });
    });

    // Manage Modal Delete Form Submission
    function confirmDelete(companyId) {
        if (confirm('Are you sure you want to delete this company?')) {
            $.ajax({
                url: $('#delete-form-' + companyId).attr('action'),
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    _method: 'DELETE'
                },
                success: function(response) {
                    $('#success-message-' + companyId).removeClass('d-none').text(response.message || 'Company deleted successfully!');
                    $('#manageCompanyModal' + companyId).modal('hide');
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                },
                error: function(xhr) {
                    $('#error-message-' + companyId).removeClass('d-none').text('Error deleting company: ' + xhr.status + ' - ' + (xhr.responseJSON?.message || xhr.responseText));
                }
            });
        }
    }
});
</script>
@endsection