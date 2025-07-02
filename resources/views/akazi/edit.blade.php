@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Akazi</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('akazi.update', $akazi->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $akazi->title) }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" required>{{ old('description', $akazi->description) }}</textarea>
            </div>
            <div class="form-group">
                <label for="qualification">Qualification</label>
                <textarea name="qualification" class="form-control" required>{{ old('qualification', $akazi->qualification) }}</textarea>
            </div>
            <div class="form-group">
                <label for="company_id">Company</label>
                <select name="company_id" class="form-control" required>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}" {{ $akazi->company_id == $company->id ? 'selected' : '' }}>{{ $company->company_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="department_id">Department</label>
                <select name="department_id" class="form-control" required>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}" {{ $akazi->department_id == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="deadline">Deadline</label>
                <input type="date" name="deadline" class="form-control" value="{{ old('deadline', $akazi->deadline) }}" required>
            </div>
            <div class="form-group">
                <label for="province_id">Province</label>
                <select name="province_id" class="form-control" required>
                    @foreach ($provinces as $province)
                        <option value="{{ $province->id }}" {{ $akazi->province_id == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="district_id">District</label>
                <select name="district_id" class="form-control" required>
                    @foreach ($districts as $district)
                        <option value="{{ $district->id }}" {{ $akazi->district_id == $district->id ? 'selected' : '' }}>{{ $district->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="sector_id">Sector</label>
                <select name="sector_id" class="form-control" required>
                    @foreach ($sectors as $sector)
                        <option value="{{ $sector->id }}" {{ $akazi->sector_id == $sector->id ? 'selected' : '' }}>{{ $sector->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="location">Location (Derived)</label>
                <input type="text" name="location" class="form-control" value="{{ $akazi->location }}" disabled>
            </div>
            <button type="submit" class="btn btn-primary">Update Akazi</button>
            <a href="{{ route('akazi.index') }}" class="btn btn-secondary">Back to List</a>
        </form>
    </div>
@endsection