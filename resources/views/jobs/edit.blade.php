@extends('layouts.adminlte')

@section('title', 'Edit Job')
@section('header', 'Edit Job')

@section('content')
<style>
    .card {
        border-radius: 10px;
        overflow: hidden;
    }
    .card-header {
        background: linear-gradient(135deg, #28a745, #34ce57);
        color: #fff;
        font-weight: 500;
    }
    .form-group label { font-weight: bold; }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Job</h3>
                </div>
                <div class="card-body">
                    <form id="editJobForm">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="job_title">Title</label>
                            <input type="text" name="job_title" id="job_title" class="form-control" value="{{ old('job_title', $job->job_title) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="job_description">Description</label>
                            <textarea name="job_description" id="job_description" class="form-control" required>{{ old('job_description', $job->job_description) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="job_qualification">Qualification</label>
                            <textarea name="job_qualification" id="job_qualification" class="form-control" required>{{ old('job_qualification', $job->job_qualification) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="company_id">Company</label>
                            <select name="company_id" id="company_id" class="form-control" required>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}" {{ old('company_id', $job->company_id) == $company->id ? 'selected' : '' }}>{{ $company->company_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="province_id">Province</label>
                            <select name="province_id" id="province_id" class="form-control" required>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->id }}" {{ old('province_id', $job->province_id) == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="district_id">District</label>
                            <select name="district_id" id="district_id" class="form-control" required>
                                <option value="">Select District</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sector_id">Sector</label>
                            <select name="sector_id" id="sector_id" class="form-control" required>
                                <option value="">Select Sector</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="department_id">Department</label>
                            <select name="department_id" id="department_id" class="form-control" required>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}" {{ old('department_id', $job->department_id) == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jobcategory_id">Category</label>
                            <select name="jobcategory_id" id="jobcategory_id" class="form-control" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('jobcategory_id', $job->jobcategory_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="job_deadline">Deadline</label>
                            <input type="date" name="job_deadline" id="job_deadline" class="form-control" value="{{ old('job_deadline', $job->job_deadline) }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Job</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {
    $('#province_id').change(function() {
        var provinceId = $(this).val();
        if (provinceId) {
            $.get('/districts/' + provinceId, function(data) {
                var districtSelect = $('#district_id');
                districtSelect.empty().append('<option value="">Select District</option>');
                if (data.length > 0) {
                    $.each(data, function(index, district) {
                        districtSelect.append('<option value="' + district.id + '">' + district.name + '</option>');
                    });
                }
                $('#sector_id').empty().append('<option value="">Select Sector</option>');
            });
        } else {
            $('#district_id').empty().append('<option value="">Select District</option>');
            $('#sector_id').empty().append('<option value="">Select Sector</option>');
        }
    });

    $('#district_id').change(function() {
        var districtId = $(this).val();
        if (districtId) {
            $.get('/sectors/' + districtId, function(data) {
                var sectorSelect = $('#sector_id');
                sectorSelect.empty().append('<option value="">Select Sector</option>');
                if (data.length > 0) {
                    $.each(data, function(index, sector) {
                        sectorSelect.append('<option value="' + sector.id + '">' + sector.name + '</option>');
                    });
                }
            });
        } else {
            $('#sector_id').empty().append('<option value="">Select Sector</option>');
        }
    });

    $('#editJobForm').submit(function(e) {
        e.preventDefault();
        var jobId = '{{ $job->job_id }}';
        $.ajax({
            url: '{{ route('jobs.update', $job->job_id) }}',
            type: 'PUT',
            data: $(this).serialize(),
            success: function(response) {
                if (response.success) {
                    $('#editJobForm')[0].reset();
                    $('#jobsTable').DataTable().ajax.reload();
                    alert('Job updated successfully!');
                }
            },
            error: function(xhr) {
                alert('Error updating job: ' + xhr.responseJSON.message);
            }
        });
    });

    // Preload initial values
    var initialProvinceId = '{{ old('province_id', $job->province_id ?? '') }}';
    if (initialProvinceId) {
        $('#province_id').val(initialProvinceId).trigger('change');
    }
});
</script>

<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection