@extends('layouts.app')

@section('title', 'Edit Company')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Company</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('companies.update', $company) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $company->name) }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $company->email) }}">
                </div>
                <div class="form-group">
                    <label for="logo">Logo</label>
                    <input type="file" name="logo" class="form-control-file">
                </div>
                <div class="form-group">
                    <label for="website">Website</label>
                    <input type="url" name="website" class="form-control" value="{{ old('website', $company->website) }}">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
