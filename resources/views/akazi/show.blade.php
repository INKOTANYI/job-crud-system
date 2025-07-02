@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Akazi Details</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $akazi->title }}</h5>
                <p class="card-text"><strong>Description:</strong> {{ $akazi->description }}</p>
                <p class="card-text"><strong>Qualification:</strong> {{ $akazi->qualification }}</p>
                <p class="card-text"><strong>Company:</strong> {{ $akazi->company->company_name ?? 'N/A' }}</p>
                <p class="card-text"><strong>Department:</strong> {{ $akazi->department->name ?? 'N/A' }}</p>
                <p class="card-text"><strong>Deadline:</strong> {{ $akazi->deadline }}</p>
                <p class="card-text"><strong>Location:</strong> {{ $akazi->location }}</p>
                <a href="{{ route('akazi.edit', $akazi->id) }}" class="btn btn-info">Edit</a>
                <a href="{{ route('akazi.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>
@endsection