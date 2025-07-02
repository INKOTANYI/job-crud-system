<!DOCTYPE html>
<html>
<head>
    <title>Job</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-plus-circle mr-2"></i>Add New Job</h3>
                    </div>
                    <div class="card-body text-center">
                        <p>Create a new Job posting.</p>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addAkaziModal">Add Job</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            @forelse ($akazi as $akazi_item)
                <div class="col-md-4">
                    <div class="card card-primary" data-toggle="modal" data-target="#manageAkaziModal{{ $akazi_item->id }}">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-briefcase mr-2"></i>{{ $akazi_item->title }}</h3>
                        </div>
                        <div class="card-body">
                            <p><strong>Location:</strong> {{ $akazi_item->location }}</p>
                            <p><strong>Deadline:</strong> {{ $akazi_item->deadline }}</p>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="manageAkaziModal{{ $akazi_item->id }}" tabindex="-1" role="dialog" aria-labelledby="manageAkaziModalLabel{{ $akazi_item->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="manageAkaziModalLabel{{ $akazi_item->id }}">Manage {{ $akazi_item->title }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('akazi.update', $akazi_item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="title_{{ $akazi_item->id }}">Title</label>
                                        <input type="text" name="title" id="title_{{ $akazi_item->id }}" class="form-control" value="{{ $akazi_item->title }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description_{{ $akazi_item->id }}">Description</label>
                                        <textarea name="description" id="description_{{ $akazi_item->id }}" class="form-control" rows="3" required>{{ $akazi_item->description }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="qualification_{{ $akazi_item->id }}">Qualification</label>
                                        <textarea name="qualification" id="qualification_{{ $akazi_item->id }}" class="form-control" rows="3" required>{{ $akazi_item->qualification }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="company_id_{{ $akazi_item->id }}">Company</label>
                                        <select name="company_id" id="company_id_{{ $akazi_item->id }}" class="form-control" required>
                                            <option value="">Select Company</option>
                                            @foreach ($companies as $company)
                                                <option value="{{ $company->id }}" {{ $akazi_item->company_id == $company->id ? 'selected' : '' }}>{{ $company->company_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="department_id_{{ $akazi_item->id }}">Department</label>
                                        <select name="department_id" id="department_id_{{ $akazi_item->id }}" class="form-control" required>
                                            <option value="">Select Department</option>
                                            @foreach ($departments as $dept)
                                                <option value="{{ $dept->id }}" {{ $akazi_item->department_id == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="deadline_{{ $akazi_item->id }}">Deadline</label>
                                        <input type="date" name="deadline" id="deadline_{{ $akazi_item->id }}" class="form-control" value="{{ $akazi_item->deadline }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="province_id_{{ $akazi_item->id }}">Province</label>
                                        <select name="province_id" id="province_id_{{ $akazi_item->id }}" class="form-control" required>
                                            <option value="">Select Province</option>
                                            @foreach ($provinces as $province)
                                                <option value="{{ $province->id }}" {{ $akazi_item->province_id == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="district_id_{{ $akazi_item->id }}">District</label>
                                        <select name="district_id" id="district_id_{{ $akazi_item->id }}" class="form-control" required>
                                            <option value="">Select District</option>
                                            @if ($akazi_item->district_id)
                                                @foreach (\App\Models\District::where('province_id', $akazi_item->province_id)->get() as $district)
                                                    <option value="{{ $district->id }}" {{ $akazi_item->district_id == $district->id ? 'selected' : '' }}>{{ $district->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="sector_id_{{ $akazi_item->id }}">Sector</label>
                                        <select name="sector_id" id="sector_id_{{ $akazi_item->id }}" class="form-control" required>
                                            <option value="">Select Sector</option>
                                            @if ($akazi_item->sector_id)
                                                @foreach (\App\Models\Sector::where('district_id', $akazi_item->district_id)->get() as $sector)
                                                    <option value="{{ $sector->id }}" {{ $akazi_item->sector_id == $sector->id ? 'selected' : '' }}>{{ $sector->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="location_{{ $akazi_item->id }}">Location</label>
                                        <input type="text" name="location" id="location_{{ $akazi_item->id }}" class="form-control" value="{{ $akazi_item->location }}" readonly>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Akazi</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">No akazi found. Use the "Add New Akazi" card to create one!</div>
                </div>
            @endforelse
        </div>

        <!-- Add Akazi Modal -->
        <div class="modal fade" id="addAkaziModal" tabindex="-1" role="dialog" aria-labelledby="addAkaziModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAkaziModalLabel">Add New Akazi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('akazi.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="qualification">Qualification</label>
                                <textarea name="qualification" id="qualification" class="form-control" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="company_id">Company</label>
                                <select name="company_id" id="company_id" class="form-control" required>
                                    <option value="">Select Company</option>
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="department_id">Department</label>
                                <select name="department_id" id="department_id" class="form-control" required>
                                    <option value="">Select Department</option>
                                    @foreach ($departments as $dept)
                                        <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="deadline">Deadline</label>
                                <input type="date" name="deadline" id="deadline" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="province_id">Province</label>
                                <select name="province_id" id="province_id" class="form-control" required>
                                    <option value="">Select Province</option>
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province->id }}">{{ $province->name }}</option>
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
                                <label for="location">Location</label>
                                <input type="text" name="location" id="location" class="form-control" readonly>
                            </div>
                            <button type="submit" class="btn btn-primary">Create Akazi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            console.log('akazi.blade.php loaded at 07:08 AM CAT, June 19, 2025');

            // Province Change Handler
            $('#province_id').on('change', function() {
                var provinceId = $(this).val();
                console.log('Province changed to:', provinceId);
                fetchDistricts(provinceId);
                $('#sector_id').html('<option value="">Select Sector</option>');
                $('#location').val('');
            });

            // District Change Handler
            $('#district_id').on('change', function() {
                var districtId = $(this).val();
                console.log('District changed to:', districtId);
                fetchSectors(districtId);
                updateLocation();
            });

            // Sector Change Handler
            $('#sector_id').on('change', function() {
                updateLocation();
            });

            // Fetch Districts
            function fetchDistricts(provinceId) {
                if (provinceId && !isNaN(provinceId)) {
                    console.log('Fetching districts for provinceId:', provinceId);
                    $.ajax({
                        url: '/api/districts/' + provinceId,
                        type: 'GET',
                        success: function(data) {
                            console.log('Districts data:', data);
                            var $districtSelect = $('#district_id');
                            $districtSelect.html('<option value="">Select District</option>');
                            if (data && Array.isArray(data)) {
                                $.each(data, function(key, value) {
                                    $districtSelect.append('<option value="' + value.id + '">' + value.name + '</option>');
                                });
                            } else {
                                $districtSelect.html('<option value="">No districts available</option>');
                            }
                        },
                        error: function(xhr) {
                            console.error('Error fetching districts:', xhr.status, xhr.responseText);
                            $('#district_id').html('<option value="">Error fetching districts</option>');
                        }
                    });
                } else {
                    $('#district_id').html('<option value="">Select a Province</option>');
                }
            }

            // Fetch Sectors
            function fetchSectors(districtId) {
                if (districtId && !isNaN(districtId)) {
                    console.log('Fetching sectors for districtId:', districtId);
                    $.ajax({
                        url: '/api/sectors/' + districtId,
                        type: 'GET',
                        success: function(data) {
                            console.log('Sectors data:', data);
                            var $sectorSelect = $('#sector_id');
                            $sectorSelect.html('<option value="">Select Sector</option>');
                            if (data && Array.isArray(data)) {
                                $.each(data, function(key, value) {
                                    $sectorSelect.append('<option value="' + value.id + '">' + value.name + '</option>');
                                });
                            } else {
                                $sectorSelect.html('<option value="">No sectors available</option>');
                            }
                        },
                        error: function(xhr) {
                            console.error('Error fetching sectors:', xhr.status, xhr.responseText);
                            $('#sector_id').html('<option value="">Error fetching sectors</option>');
                        }
                    });
                } else {
                    $('#sector_id').html('<option value="">Select a District</option>');
                }
            }

            // Update Location
            function updateLocation() {
                var provinceName = $('#province_id option:selected').text();
                var districtName = $('#district_id option:selected').text();
                var sectorName = $('#sector_id option:selected').text();
                if (provinceName !== 'Select Province' && districtName !== 'Select District' && sectorName !== 'Select Sector') {
                    $('#location').val(sectorName + ', ' + districtName + ', ' + provinceName);
                } else {
                    $('#location').val('');
                }
            }
        });
    </script>
</body>
</html>