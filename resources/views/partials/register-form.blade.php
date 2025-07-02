<form id="register-form" action="{{ route('registrations.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="register-email">Email <span class="text-danger">*</span></label>
        <input type="email" class="form-control" id="register-email" name="email" required>
        <span class="text-danger error" id="register-email-error"></span>
    </div>
    <div class="form-group">
        <label for="register-names">Full Names <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="register-names" name="names" required>
        <span class="text-danger error" id="register-names-error"></span>
    </div>
    <div class="form-group">
        <label for="register-phone">Phone <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="register-phone" name="phone" required placeholder="+250XXXXXXXX">
        <span class="text-danger error" id="register-phone-error"></span>
    </div>
    <div class="form-group">
        <label for="register-id_number">ID Number <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="register-id_number" name="id_number" required>
        <span class="text-danger error" id="register-id_number-error"></span>
    </div>
    <div class="form-group">
        <label for="register-department_id">Department <span class="text-danger">*</span></label>
        <select class="form-control" id="register-department_id" name="department_id" required>
            <option value="">Select Department</option>
            @foreach($departments as $department)
                <option value="{{ $department->id }}">{{ $department->name }}</option>
            @endforeach
        </select>
        <span class="text-danger error" id="register-department_id-error"></span>
    </div>
    <div class="form-group">
        <label for="register-province_id">Province <span class="text-danger">*</span></label>
        <select class="form-control" id="register-province_id" name="province_id" required>
            <option value="">Select Province</option>
            @foreach($provinces as $province)
                <option value="{{ $province->id }}">{{ $province->name }}</option>
            @endforeach
        </select>
        <span class="text-danger error" id="register-province_id-error"></span>
    </div>
    <div class="form-group">
        <label for="register-district_id">District <span class="text-danger">*</span></label>
        <select class="form-control" id="register-district_id" name="district_id" required>
            <option value="">Select District</option>
        </select>
        <span class="text-danger error" id="register-district_id-error"></span>
    </div>
    <div class="form-group">
        <label for="register-sector_id">Sector <span class="text-danger">*</span></label>
        <select class="form-control" id="register-sector_id" name="sector_id" required>
            <option value="">Select Sector</option>
        </select>
        <span class="text-danger error" id="register-sector_id-error"></span>
    </div>
    <div class="form-group">
        <label for="register-cv">CV</label>
        <input type="file" class="form-control-file" id="register-cv" name="cv">
        <span class="text-danger error" id="register-cv-error"></span>
    </div>
    <div class="form-group">
        <label for="register-degree">Degree</label>
        <input type="file" class="form-control-file" id="register-degree" name="degree">
        <span class="text-danger error" id="register-degree-error"></span>
    </div>
    <div class="form-group">
        <label for="register-id_doc">ID Document</label>
        <input type="file" class="form-control-file" id="register-id_doc" name="id_doc">
        <span class="text-danger error" id="register-id_doc-error"></span>
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
    <div id="register-success" class="alert alert-success mt-2" style="display: none;"></div>
</form>

<script>
    // Dynamic district and sector loading
    $('#register-province_id').on('change', function() {
        var provinceId = $(this).val();
        if (provinceId) {
            $.get('/districts/' + provinceId, function(data) {
                var $districtSelect = $('#register-district_id');
                $districtSelect.empty().append('<option value="">Select District</option>');
                $.each(data, function(index, district) {
                    $districtSelect.append('<option value="' + district.id + '">' + district.name + '</option>');
                });
                $('#register-sector_id').empty().append('<option value="">Select Sector</option>');
            });
        } else {
            $('#register-district_id').empty().append('<option value="">Select District</option>');
            $('#register-sector_id').empty().append('<option value="">Select Sector</option>');
        }
    });

    $('#register-district_id').on('change', function() {
        var districtId = $(this).val();
        if (districtId) {
            $.get('/sectors/' + districtId, function(data) {
                var $sectorSelect = $('#register-sector_id');
                $sectorSelect.empty().append('<option value="">Select Sector</option>');
                $.each(data, function(index, sector) {
                    $sectorSelect.append('<option value="' + sector.id + '">' + sector.name + '</option>');
                });
            });
        } else {
            $('#register-sector_id').empty().append('<option value="">Select Sector</option>');
        }
    });
</script>