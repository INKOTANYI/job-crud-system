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
                        <p class="text-danger error-email mt-1" id="emailFeedback-{{ $registration->id }}"></p>
                    </div>
                    <div class="form-group">
                        <label for="id_number-{{ $registration->id }}">ID Number</label>
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
                            <p>Current CV: <a href="{{ asset('storage/' . $registration->cv) }}" target="_blank">View</a></p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="degree-{{ $registration->id }}">Upload Degree</label>
                        <input type="file" name="degree" id="degree-{{ $registration->id }}" class="form-control">
                        @if ($registration->degree)
                            <p>Current Degree: <a href="{{ asset('storage/' . $registration->degree) }}" target="_blank">View</a></p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="id_doc-{{ $registration->id }}">Upload ID</label>
                        <input type="file" name="id_doc" id="id_doc-{{ $registration->id }}" class="form-control">
                        @if ($registration->id_doc)
                            <p>Current ID: <a href="{{ asset('storage/' . $registration->id_doc) }}" target="_blank">View</a></p>
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
                            @foreach ($districts as $district)
                                <option value="{{ $district->id }}" {{ $registration->district_id == $district->id ? 'selected' : '' }}>{{ $district->name }}</option>
                            @endforeach
                        </select>
                        <p class="text-danger error-district_id mt-1"></p>
                    </div>
                    <div class="form-group">
                        <label for="sector_id-{{ $registration->id }}">Sector</label>
                        <select name="sector_id" id="sector_id-{{ $registration->id }}" class="form-control" required>
                            <option value="">Select Sector</option>
                            @foreach ($sectors as $sector)
                                <option value="{{ $sector->id }}" {{ $registration->sector_id == $sector->id ? 'selected' : '' }}>{{ $sector->name }}</option>
                            @endforeach
                        </select>
                        <p class="text-danger error-sector_id mt-1"></p>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Registration</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            @foreach ($registrations as $registration)
                $('#email-{{ $registration->id }}').on('input', function() {
                    var email = $(this).val();
                    if (email) {
                        $.ajax({
                            url: '{{ route("registrations.check-email") }}',
                            type: 'GET',
                            data: { email: email, ignore_id: {{ $registration->id }} },
                            success: function(response) {
                                if (response.exists) {
                                    $('#emailFeedback-{{ $registration->id }}').text('This email is already registered by another entry.');
                                } else {
                                    $('#emailFeedback-{{ $registration->id }}').text('');
                                }
                            },
                            error: function(xhr) {
                                $('#emailFeedback-{{ $registration->id }}').text('Error checking email.');
                            }
                        });
                    } else {
                        $('#emailFeedback-{{ $registration->id }}').text('');
                    }
                });

                $('#edit-registration-form-{{ $registration->id }}').on('submit', function(e) {
                    e.preventDefault();
                    $('.error').text('');
                    $('#edit-success-message-{{ $registration->id }}, #edit-error-message-{{ $registration->id }}').addClass('d-none');

                    var formData = new FormData(this);

                    $.ajax({
                        url: $(this).attr('action'),
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            $('#editRegistrationModal-{{ $registration->id }}').modal('hide');
                            table.row($('tr[data-id="{{ $registration->id }}"]')).data([
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
                            $('#successPopupMessage').text('Successfully updated registration!');
                            $('#successPopup').modal('show');
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) {
                                var errors = xhr.responseJSON.errors;
                                $.each(errors, function(key, value) {
                                    $('.error-' + key).text(value[0]);
                                });
                            } else {
                                $('#edit-error-message-{{ $registration->id }}').removeClass('d-none').text('An error occurred: ' + xhr.responseText);
                            }
                        }
                    });
                });
            @endforeach
        });
    </script>