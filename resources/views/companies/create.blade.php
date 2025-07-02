@extends('layouts.adminlte')

@section('title', 'Add Company')
@section('header', 'Add New Company')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Create Company</h3>
    </div>
    <div class="card-body">
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
            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" name="location" id="location" class="form-control" readonly>
                <p class="text-danger error-location mt-1"></p>
            </div>
            <button type="submit" class="btn btn-primary">Create Company</button>
        </form>
    </div>
</div>

<script>
$(document).ready(function() {
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

    // Form submission
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
});
</script>
@endsection
