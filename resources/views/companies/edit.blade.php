@extends('layouts.adminlte')

@section('title', 'Manage Company')
@section('header', 'Manage Company: ' . $company->company_name)

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Manage {{ $company->company_name }}</h3>
    </div>
    <div class="card-body">
        <div id="success-message" class="alert alert-success d-none" role="alert"></div>
        <div id="error-message" class="alert alert-danger d-none" role="alert"></div>
        <!-- Update Form -->
        <form id="update-form" action="{{ route('companies.update', $company) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="company_name">Company Name</label>
                <input type="text" name="company_name" id="company_name" class="form-control" value="{{ $company->company_name }}" required>
                <p class="text-danger error-company_name mt-1"></p>
            </div>
            <div class="form-group">
                <label for="logo">Logo (Optional)</label>
                <input type="file" name="logo" id="logo" class="form-control">
                @if ($company->logo)
                    <img src="{{ Storage::url($company->logo) }}" alt="Logo" class="img-fluid mt-2" style="max-height: 100px;">
                @endif
            </div>
            <div class="form-group">
                <label for="description">Description (Optional)</label>
                <textarea name="description" id="description" class="form-control" rows="3">{{ $company->description }}</textarea>
                <p class="text-danger error-description mt-1"></p>
            </div>
            <div class="form-group">
                <label for="province_id">Province</label>
                <select name="province_id" id="province_id" class="form-control" required>
                    <option value="">Select Province</option>
                    @foreach ($provinces as $province)
                        <option value="{{ $province->id }}" {{ $company->province_id == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
                    @endforeach
                </select>
                <p class="text-danger error-province_id mt-1"></p>
            </div>
            <div class="form-group">
                <label for="district_id">District</label>
                <select name="district_id" id="district_id" class="form-control" required>
                    <option value="">Select District</option>
                    <!-- Populated via AJAX -->
                </select>
                <p class="text-danger error-district_id mt-1"></p>
            </div>
            <div class="form-group">
                <label for="sector_id">Sector</label>
                <select name="sector_id" id="sector_id" class="form-control" required>
                    <option value="">Select Sector</option>
                    <!-- Populated via AJAX -->
                </select>
                <p class="text-danger error-sector_id mt-1"></p>
            </div>
            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" name="location" id="location" class="form-control" value="{{ $company->location }}" readonly>
                <p class="text-danger error-location mt-1"></p>
            </div>
            <button type="submit" class="btn btn-primary">Update Company</button>
        </form>

        <!-- Delete Button -->
        <form id="delete-form" action="{{ route('companies.destroy', $company) }}" method="POST" class="mt-3">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete Company</button>
        </form>
    </div>
</div>

<script>
$(document).ready(function() {
    // Populate districts on page load
    var initialProvinceId = $('#province_id').val();
    if (initialProvinceId) {
        $.ajax({
            url: '/api/districts/' + initialProvinceId,
            type: 'GET',
            success: function(data) {
                var html = '<option value="">Select District</option>';
                $.each(data, function(key, value) {
                    html += '<option value="' + value.id + '" ' + (value.id == '{{ $company->district_id }}' ? 'selected' : '') + '>' + value.name + '</option>';
                });
                $('#district_id').html(html);

                // Populate sectors after districts
                var initialDistrictId = '{{ $company->district_id }}';
                if (initialDistrictId) {
                    $.ajax({
                        url: '/api/sectors/' + initialDistrictId,
                        type: 'GET',
                        success: function(data) {
                            var html = '<option value="">Select Sector</option>';
                            $.each(data, function(key, value) {
                                html += '<option value="' + value.id + '" ' + (value.id == '{{ $company->sector_id }}' ? 'selected' : '') + '>' + value.name + '</option>';
                            });
                            $('#sector_id').html(html);
                        }
                    });
                }
            }
        });
    }

    // Fetch districts based on province
    $('#province_id').on('change', function() {
        var provinceId = $(this).val();
        if (provinceId) {
            $.ajax({
                url: '/api/districts/' + provinceId,
                type: 'GET',
                success: function(data) {
                    var html = '<option value="">Select District</option>';
                    $.each(data, function(key, value) {
                        html += '<option value="' + value.id + '">' + value.name + '</option>';
                    });
                    $('#district_id').html(html);
                    $('#sector_id').html('<option value="">Select Sector</option>');
                    $('#location').val('');
                }
            });
        } else {
            $('#district_id').html('<option value="">Select District</option>');
            $('#sector_id').html('<option value="">Select Sector</option>');
            $('#location').val('');
        }
    });

    // Fetch sectors based on district
    $('#district_id').on('change', function() {
        var districtId = $(this).val();
        if (districtId) {
            $.ajax({
                url: '/api/sectors/' + districtId,
                type: 'GET',
                success: function(data) {
                    var html = '<option value="">Select Sector</option>';
                    $.each(data, function(key, value) {
                        html += '<option value="' + value.id + '">' + value.name + '</option>';
                    });
                    $('#sector_id').html(html);
                    $('#location').val('');
                }
            });
        } else {
            $('#sector_id').html('<option value="">Select Sector</option>');
            $('#location').val('');
        }
    });

    // Auto-populate location based on sector
    $('#sector_id').on('change', function() {
        var sectorId = $(this).val();
        if (sectorId) {
            $.ajax({
                url: '/api/sector/' + sectorId,
                type: 'GET',
                success: function(data) {
                    if (data.length > 0) {
                        $('#location').val(data[0].location || 'Auto-generated');
                    }
                }
            });
        } else {
            $('#location').val('');
        }
    });

    // Update form submission
    $('#update-form').on('submit', function(e) {
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
                setTimeout(() => {
                    window.location.href = '{{ route("dashboard") }}';
                }, 1500);
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

    // Delete form submission
    $('#delete-form').on('submit', function(e) {
        e.preventDefault();
        if (confirm('Are you sure you want to delete this company?')) {
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    _method: 'DELETE'
                },
                success: function(response) {
                    $('#success-message').removeClass('d-none').text(response.message);
                    setTimeout(() => {
                        window.location.href = '{{ route("dashboard") }}';
                    }, 1500);
                },
                error: function() {
                    $('#error-message').removeClass('d-none').text('Error deleting company.');
                }
            });
        }
    });
});
</script>
@endsection
