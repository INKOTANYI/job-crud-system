@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create New Akazi</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('akazi.store') }}" method="POST" id="akaziForm">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
            </div>
            <div class="form-group">
                <label for="province_id">Province</label>
                <select name="province_id" class="form-control" id="province_id" required>
                    @foreach ($provinces as $province)
                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="district_id">District</label>
                <select name="district_id" class="form-control" id="district_id" required>
                    <option value="">Select a Province first</option>
                </select>
            </div>
            <div class="form-group">
                <label for="location">Location (Derived)</label>
                <input type="text" name="location" class="form-control" id="location" value="" disabled>
            </div>
            <button type="submit" class="btn btn-primary">Create Akazi</button>
        </form>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const provinceSelect = document.getElementById('province_id');
                const districtSelect = document.getElementById('district_id');
                const locationInput = document.getElementById('location');

                // Populate districts based on province using pre-loaded province data
                provinceSelect.addEventListener('change', function() {
                    const provinceId = this.value;
                    districtSelect.innerHTML = '<option value="">Select a District</option>';
                    const provincesData = <?= json_encode($provinces) ?>;
                    console.log('Provinces Data:', provincesData); // Debug: Check the full data
                    const selectedProvince = provincesData.find(p => p.id == provinceId);
                    console.log('Selected Province:', selectedProvince); // Debug: Check the matched province
                    if (selectedProvince && selectedProvince.districts) {
                        selectedProvince.districts.forEach(district => {
                            const option = document.createElement('option');
                            option.value = district.id;
                            option.text = district.name;
                            districtSelect.appendChild(option);
                        });
                    } else {
                        console.log('No districts found for province ID:', provinceId); // Debug: Log if no districts
                    }
                    updateLocation();
                });

                function updateLocation() {
                    const province = provinceSelect.options[provinceSelect.selectedIndex].text;
                    const district = districtSelect.options[districtSelect.selectedIndex].text;
                    locationInput.value = province && district ? `${province}, ${district}` : '';
                }

                // Initial update
                updateLocation();
            });
        </script>
    @endpush
@endsection