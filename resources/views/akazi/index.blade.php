@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Akazi List</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <a href="{{ route('akazi.create') }}" class="btn btn-primary mb-3">Create New Akazi</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Qualification</th>
                    <th>Company</th>
                    <th>Department</th>
                    <th>Deadline</th>
                    <th>Location</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($akazis as $akazi)
                    <tr>
                        <td>{{ $akazi->title }}</td>
                        <td>{{ Str::limit($akazi->description, 50) }}</td>
                        <td>{{ Str::limit($akazi->qualification, 50) }}</td>
                        <td>{{ $akazi->company->company_name ?? 'N/A' }}</td>
                        <td>{{ $akazi->department->name ?? 'N/A' }}</td>
                        <td>{{ $akazi->deadline }}</td>
                        <td>{{ $akazi->location }}</td>
                        <td>
                            <a href="{{ route('akazi.edit', $akazi->id) }}" class="btn btn-info btn-sm">Edit</a>
                            <form action="{{ route('akazi.destroy', $akazi->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection