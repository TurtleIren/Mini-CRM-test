@extends('layouts.app')

@section('title', 'View Employee')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $employee->first_name }} {{ $employee->last_name }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Company:</strong> {{ $employee->company->name ?? '-' }}</p>
            <p><strong>Email:</strong> {{ $employee->email }}</p>
            <p><strong>Phone:</strong> {{ $employee->phone }}</p>
        </div>
    </div>
@endsection
