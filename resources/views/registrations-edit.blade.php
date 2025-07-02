<div class="modal fade" id="editRegistrationModal-{{ $registration->id }}" tabindex="-1" role="dialog" aria-labelledby="editRegistrationModalLabel-{{ $registration->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRegistrationModalLabel-{{ $registration->id }}">Edit Registration</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="edit-success-message-{{ $registration->id }}" class="alert alert-success d-none" role="alert"></div>
                <div id="edit-error-message-{{ $registration->id }}" class="alert alert-danger d-none" role="alert"></div>
                <form id="edit-registration-form-{{ $registration->id }}" action="{{ route('registrations.update', $registration->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="names-{{ $registration->id }}">Names</label>
                        <input type="text" name="names" id="names-{{ $registration->id }}" class="form-control" value="{{ $registration->names }}" required>
                        <p class="text-danger error-names mt-1"></p>
                    </div>
                    <div class="form-group">
                        <label for="phone-{{ $registration->id }}">Phone</label>
                        <input type="text" name="phone" id="phone-{{ $registration->id }}" class="form-control" value="{{ $registration->phone }}" required>
                        <p class="text-danger error-phone mt-1"></p>
                    </div>
                    <div class="form-group">
                        <label for="email-{{ $registration->id }}">Email</label>
                        <input type="email" name="email" id="email-{{ $registration->id }}" class="form-control" value="{{ $registration->email }}" required>
                        <p class="text-danger error-email mt-1"></p>
                    </div>
                    <div class="form-group">
                        <label for="id_number-{{ $registration->id }}">ID Number (Rwandan National ID)</label>
                        <input type="text" name="id_number" id="id_number-{{ $registration->id }}" class="form-control" value="{{ $registration->id_number }}" required pattern="[A-Z0-9]{16}" title="Must be 16 characters (letters or numbers)">
                        <p class="text-danger error-id_number mt-1"></p>
                    </div>
                    <div class="form-group">
                        <label for="department_id-{{ $registration->id }}">Department</label>
                        <select name="department_id" id="department_id-{{ $registration->id }}" class="form-control" required>
                            <option value="">Select Department</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}" {{ $registration->department_id == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                            @endforeach
                        </select>
                        <p class="text-danger error-department_id mt-1"></p>
                    </div>
                    <div class="form-group">
                        <label for="cv-{{ $registration->id }}">Upload CV</label>
                        <input type="file" name="cv" id="cv-{{ $registration->id }}" class="form-control">
                        @if ($registration->cv)
                            <small>Current CV: <a href="{{ Storage::url($registration->cv) }}" target="_blank">View</a></small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="degree-{{ $registration->id }}">Upload Degree</label>
                        <input type="file" name="degree" id="degree-{{ $registration->id }}" class="form-control">
                        @if ($registration->degree)
                            <small>Current Degree: <a href="{{ Storage::url($registration->degree) }}" target="_blank">View</a></small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="id_doc-{{ $registration->id }}">Upload ID</label>
                        <input type="file" name="id_doc" id="id_doc-{{ $registration->id }}" class="form-control">
                        @if ($registration->id_doc)
                            <small>Current ID: <a href="{{ Storage::url($registration->id_doc) }}" target="_blank">View</a></small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="province_id-{{ $registration->id }}">Province</label>
                        <select name="province_id" id="province_id-{{ $registration->id }}" class="form-control" required>
                            <option value="">Select Province</option>
                            @foreach ($provinces as $province)
                                <option value="{{ $province->id }}" {{ $registration->province_id == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
                            @endforeach
                        </select>
                        <p class="text-danger error-province_id mt-1"></p>
                    </div>
                    <div class="form-group">
                        <label for="district_id-{{ $registration->id }}">District</label>
                        <select name="district_id" id="district_id-{{ $registration->id }}" class="form-control" required>
                            <option value="">Select District</option>
                        </select>
                        <p class="text-danger error-district_id mt-1"></p>
                    </div>
                    <div class="form-group">
                        <label for="sector_id-{{ $registration->id }}">Sector</label>
                        <select name="sector_id" id="sector_id-{{ $registration->id }}" class="form-control" required>
                            <option value="">Select Sector</option>
                        </select>
                        <p class="text-danger error-sector_id mt-1"></p>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Registration</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        console.log('Editing Registration ID: {{ $registration->id }}');
        console.log('Initial Province ID: {{ $registration->province_id ?? "null" }}');
        console.log('Initial District ID: {{ $registration->district_id ?? "null" }}');
        console.log('Initial Sector ID: {{ $registration->sector_id ?? "null" }}');

        $('#editRegistrationModal-{{ $registration->id }}').on('show.bs.modal', function () {
            var provinceId = $('#province_id-{{ $registration->id }}').val();
            console.log('Province ID selected on modal show:', provinceId);

            if (!provinceId) {
                console.warn('No province ID selected. Cannot fetch districts.');
                $('#district_id-{{ $registration->id }}').html('<option value="">Select District</option>');
                $('#sector_id-{{ $registration->id }}').html('<option value="">Select Sector</option>');
                return;
            }

            $.ajax({
                url: '/api/districts/' + provinceId,
                type: 'GET',
                success: function(data) {
                    console.log('Districts fetched for province ' + provinceId + ':', data);
                    if (data && data.length > 0) {
                        var districtHtml = '<option value="">Select District</option>';
                        $.each(data, function(key, value) {
                            districtHtml += '<option value="' + value.id + '" ' + (value.id == {{ $registration->district_id ?? "null" }} ? 'selected' : '') + '>' + value.name + '</option>';
                        });
                        $('#district_id-{{ $registration->id }}').html(districtHtml);
                    } else {
                        console.warn('No districts found for province ' + provinceId);
                        $('#district_id-{{ $registration->id }}').html('<option value="">No Districts Available</option>');
                    }

                    var districtId = {{ $registration->district_id ?? "null" }};
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
                                        sectorHtml += '<option value="' + value.id + '" ' + (value.id == {{ $registration->sector_id ?? "null" }} ? 'selected' : '') + '>' + value.name + '</option>';
                                    });
                                    $('#sector_id-{{ $registration->id }}').html(sectorHtml);
                                } else {
                                    console.warn('No sectors found for district ' + districtId);
                                    $('#sector_id-{{ $registration->id }}').html('<option value="">No Sectors Available</option>');
                                }
                            },
                            error: function(xhr) {
                                console.error('Error fetching sectors for district ' + districtId + ':', xhr.status, xhr.responseText);
                                $('#sector_id-{{ $registration->id }}').html('<option value="">Error Fetching Sectors</option>');
                            }
                        });
                    } else {
                        console.log('No district ID available to fetch sectors.');
                        $('#sector_id-{{ $registration->id }}').html('<option value="">Select District First</option>');
                    }
                },
                error: function(xhr) {
                    console.error('Error fetching districts for province ' + provinceId + ':', xhr.status, xhr.responseText);
                    $('#district_id-{{ $registration->id }}').html('<option value="">Error Fetching Districts</option>');
                    $('#sector_id-{{ $registration->id }}').html('<option value="">Select District First</option>');
                }
            });
        });

        $('#province_id-{{ $registration->id }}').on('change', function() {
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
                        $('#district_id-{{ $registration->id }}').html(html);
                        $('#sector_id-{{ $registration->id }}').html('<option value="">Select Sector</option>');
                    },
                    error: function(xhr) {
                        console.error('Error fetching districts on province change:', xhr.status, xhr.responseText);
                        $('#district_id-{{ $registration->id }}').html('<option value="">Error Fetching Districts</option>');
                        $('#sector_id-{{ $registration->id }}').html('<option value="">Select District First</option>');
                    }
                });
            } else {
                $('#district_id-{{ $registration->id }}').html('<option value="">Select District</option>');
                $('#sector_id-{{ $registration->id }}').html('<option value="">Select Sector</option>');
            }
        });

        $('#district_id-{{ $registration->id }}').on('change', function() {
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
                        $('#sector_id-{{ $registration->id }}').html(html);
                    },
                    error: function(xhr) {
                        console.error('Error fetching sectors on district change:', xhr.status, xhr.responseText);
                        $('#sector_id-{{ $registration->id }}').html('<option value="">Error Fetching Sectors</option>');
                    }
                });
            } else {
                $('#sector_id-{{ $registration->id }}').html('<option value="">Select Sector</option>');
            }
        });

        $('#edit-registration-form-{{ $registration->id }}').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            var registrationId = form.attr('id').split('-').pop();
            $('.error').text('');
            $('#edit-success-message-' + registrationId + ', #edit-error-message-' + registrationId).addClass('d-none');

            var formData = new FormData(this);

            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    var row = table.row($('tr[data-id="' + registrationId + '"]'));
                    row.data([
                        response.registration.id,
                        response.registration.names,
                        response.registration.phone,
                        response.registration.email,
                        response.registration.id_number,
                        response.registration.department?.name ?? 'N/A',
                        response.registration.province?.name + ' ' + response.registration.district?.name + ' ' + response.registration.sector?.name,
                        `
                            <button class="btn btn-info btn-sm edit-btn" data-id="${response.registration.id}" data-toggle="modal" data-target="#editRegistrationModal-${response.registration.id}">Edit</button>
                            <button class="btn btn-danger btn-sm delete-btn" data-id="${response.registration.id}" data-toggle="modal" data-target="#deleteConfirmModal">Delete</button>
                        `
                    ]).draw(false);

                    activeModalId = '#editRegistrationModal-' + registrationId;
                    $('#successPopupMessage').text('Successfully updated registration!');
                    $('#successPopup').modal('show');
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            form.find('.error-' + key).text(value[0]);
                        });
                    } else {
                        $('#edit-error-message-' + registrationId).removeClass('d-none').text('An error occurred: ' + xhr.responseText);
                    }
                }
            });
        });
    });
</script>
