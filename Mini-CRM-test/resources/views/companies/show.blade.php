@extends('layouts.app')

@section('title', 'View Company')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $company->name }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Email:</strong> {{ $company->email }}</p>
            <p><strong>Website:</strong> <a href="{{ $company->website }}" target="_blank">{{ $company->website }}</a></p>
            <p><strong>Logo:</strong></p>
            @if ($company->logo)
                <img src="{{ asset('storage/' . $company->logo) }}" alt="Logo" style="max-height: 100px;">
            @else
                <p>No logo available.</p>
            @endif
        </div>
    </div>
@endsection
