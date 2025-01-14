@extends('layouts.app')

@section('title', 'Edit Employee')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Employee</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('employees.update', $employee) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $employee->first_name) }}" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $employee->last_name) }}" required>
                </div>
                <div class="form-group">
                    <label for="company_id">Company</label>
                    <select name="company_id" class="form-control">
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}" {{ $employee->company_id == $company->id ? 'selected' : '' }}>
                                {{ $company->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $employee->email) }}">
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $employee->phone) }}">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection

