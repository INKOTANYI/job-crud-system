<div class="modal fade" id="editCompanyModal-{{ $company->id }}" tabindex="-1" role="dialog" aria-labelledby="editCompanyModalLabel-{{ $company->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCompanyModalLabel-{{ $company->id }}">Edit Company</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="edit-success-message-{{ $company->id }}" class="alert alert-success d-none" role="alert"></div>
                <div id="edit-error-message-{{ $company->id }}" class="alert alert-danger d-none" role="alert"></div>
                <form id="edit-company-form-{{ $company->id }}" action="{{ route('companies.update', $company->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="company_name-{{ $company->id }}">Company Name</label>
                        <input type="text" name="company_name" id="company_name-{{ $company->id }}" class="form-control" value="{{ $company->company_name }}" required>
                        <p class="text-danger error-company_name mt-1"></p>
                    </div>
                    <div class="form-group">
                        <label for="logo-{{ $company->id }}">Logo (Optional)</label>
                        <input type="file" name="logo" id="logo-{{ $company->id }}" class="form-control">
                        @if ($company->logo)
                            <small>Current Logo: <a href="{{ Storage::url($company->logo) }}" target="_blank">View</a></small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="description-{{ $company->id }}">Description (Optional)</label>
                        <textarea name="description" id="description-{{ $company->id }}" class="form-control" rows="3">{{ $company->description }}</textarea>
                        <p class="text-danger error-description mt-1"></p>
                    </div>
                    <div class="form-group">
                        <label for="category_id-{{ $company->id }}">Category</label>
                        <select name="category_id" id="category_id-{{ $company->id }}" class="form-control" required>
                            <option value="">Select Category</option>
                            @foreach ($jobCategories as $category)
                                <option value="{{ $category->id }}" {{ $company->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <p class="text-danger error-category_id mt-1"></p>
                    </div>
                    <div class="form-group">
                        <label for="province_id-{{ $company->id }}">Province</label>
                        <select name="province_id" id="province_id-{{ $company->id }}" class="form-control" required>
                            <option value="">Select Province</option>
                            @foreach ($provinces as $province)
                                <option value="{{ $province->id }}" {{ $company->province_id == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
                            @endforeach
                        </select>
                        <p class="text-danger error-province_id mt-1"></p>
                    </div>
                    <div class="form-group">
                        <label for="district_id-{{ $company->id }}">District</label>
                        <select name="district_id" id="district_id-{{ $company->id }}" class="form-control" required>
                            <option value="">Select District</option>
                        </select>
                        <p class="text-danger error-district_id mt-1"></p>
                    </div>
                    <div class="form-group">
                        <label for="sector_id-{{ $company->id }}">Sector</label>
                        <select name="sector_id" id="sector_id-{{ $company->id }}" class="form-control" required>
                            <option value="">Select Sector</option>
                        </select>
                        <p class="text-danger error-sector_id mt-1"></p>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Company</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Log initial values for debugging
        console.log('Editing Company ID: {{ $company->id }}');
        console.log('Initial Province ID: {{ $company->province_id ?? "null" }}');
        console.log('Initial District ID: {{ $company->district_id ?? "null" }}');
        console.log('Initial Sector ID: {{ $company->sector_id ?? "null" }}');

        // Pre-populate districts and sectors when the modal is shown
        $('#editCompanyModal-{{ $company->id }}').on('show.bs.modal', function () {
            var provinceId = $('#province_id-{{ $company->id }}').val();
            console.log('Province ID selected on modal show:', provinceId);

            if (!provinceId) {
                console.warn('No province ID selected. Cannot fetch districts.');
                $('#district_id-{{ $company->id }}').html('<option value="">Select District</option>');
                $('#sector_id-{{ $company->id }}').html('<option value="">Select Sector</option>');
                return;
            }

            // Fetch districts
            $.ajax({
                url: '/api/districts/' + provinceId,
                type: 'GET',
                success: function(data) {
                    console.log('Districts fetched for province ' + provinceId + ':', data);
                    if (data && data.length > 0) {
                        var districtHtml = '<option value="">Select District</option>';
                        $.each(data, function(key, value) {
                            districtHtml += '<option value="' + value.id + '" ' + (value.id == {{ $company->district_id ?? "null" }} ? 'selected' : '') + '>' + value.name + '</option>';
                        });
                        $('#district_id-{{ $company->id }}').html(districtHtml);
                    } else {
                        console.warn('No districts found for province ' + provinceId);
                        $('#district_id-{{ $company->id }}').html('<option value="">No Districts Available</option>');
                    }

                    // Fetch sectors only if district_id exists
                    var districtId = {{ $company->district_id ?? "null" }};
                    console.log('District ID for fetching sectors:', districtId);
                    if (districtId) {
                        $.ajax({
                            url: '/api/sectors/' + districtId,
                            type: 'GET',
                            success: function(data) {
                                console.log('Sectors fetched for district ' + districtId + ':', data);
                                if (data && data.length > 0) {
                                    var sectorHtml = '<option value="">Select Sector</option>';
                                    $.each(data, function(key, value) {
                                        sectorHtml += '<option value="' + value.id + '" ' + (value.id == {{ $company->sector_id ?? "null" }} ? 'selected' : '') + '>' + value.name + '</option>';
                                    });
                                    $('#sector_id-{{ $company->id }}').html(sectorHtml);
                                } else {
                                    console.warn('No sectors found for district ' + districtId);
                                    $('#sector_id-{{ $company->id }}').html('<option value="">No Sectors Available</option>');
                                }
                            },
                            error: function(xhr) {
                                console.error('Error fetching sectors for district ' + districtId + ':', xhr.status, xhr.responseText);
                                $('#sector_id-{{ $company->id }}').html('<option value="">Error Fetching Sectors</option>');
                            }
                        });
                    } else {
                        console.log('No district ID available to fetch sectors.');
                        $('#sector_id-{{ $company->id }}').html('<option value="">Select District First</option>');
                    }
                },
                error: function(xhr) {
                    console.error('Error fetching districts for province ' + provinceId + ':', xhr.status, xhr.responseText);
                    $('#district_id-{{ $company->id }}').html('<option value="">Error Fetching Districts</option>');
                    $('#sector_id-{{ $company->id }}').html('<option value="">Select District First</option>');
                }
            });
        });

        // Fetch districts based on province change
        $('#province_id-{{ $company->id }}').on('change', function() {
            var provinceId = $(this).val();
            console.log('Province changed to:', provinceId);
            if (provinceId) {
                $.ajax({
                    url: '/api/districts/' + provinceId,
                    type: 'GET',
                    success: function(data) {
                        console.log('Districts fetched on province change:', data);
                        var html = '<option value="">Select District</option>';
                        if (data && data.length > 0) {
                            $.each(data, function(key, value) {
                                html += '<option value="' + value.id + '">' + value.name + '</option>';
                            });
                        } else {
                            html = '<option value="">No Districts Available</option>';
                        }
                        $('#district_id-{{ $company->id }}').html(html);
                        $('#sector_id-{{ $company->id }}').html('<option value="">Select Sector</option>');
                    },
                    error: function(xhr) {
                        console.error('Error fetching districts on province change:', xhr.status, xhr.responseText);
                        $('#district_id-{{ $company->id }}').html('<option value="">Error Fetching Districts</option>');
                        $('#sector_id-{{ $company->id }}').html('<option value="">Select District First</option>');
                    }
                });
            } else {
                $('#district_id-{{ $company->id }}').html('<option value="">Select District</option>');
                $('#sector_id-{{ $company->id }}').html('<option value="">Select Sector</option>');
            }
        });

        // Fetch sectors based on district change
        $('#district_id-{{ $company->id }}').on('change', function() {
            var districtId = $(this).val();
            console.log('District changed to:', districtId);
            if (districtId) {
                $.ajax({
                    url: '/api/sectors/' + districtId,
                    type: 'GET',
                    success: function(data) {
                        console.log('Sectors fetched on district change:', data);
                        var html = '<option value="">Select Sector</option>';
                        if (data && data.length > 0) {
                            $.each(data, function(key, value) {
                                html += '<option value="' + value.id + '">' + value.name + '</option>';
                            });
                        } else {
                            html = '<option value="">No Sectors Available</option>';
                        }
                        $('#sector_id-{{ $company->id }}').html(html);
                    },
                    error: function(xhr) {
                        console.error('Error fetching sectors on district change:', xhr.status, xhr.responseText);
                        $('#sector_id-{{ $company->id }}').html('<option value="">Error Fetching Sectors</option>');
                    }
                });
            } else {
                $('#sector_id-{{ $company->id }}').html('<option value="">Select Sector</option>');
            }
        });
    });
</script>