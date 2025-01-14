@extends('layouts.app')

@section('title', 'Companies')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Companies</h3>
            <a href="{{ route('companies.create') }}" class="btn btn-primary float-right">Add Company</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Website</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($companies as $company)
                    <tr>
                        <td>{{ $company->id }}</td>
                        <td>{{ $company->name }}</td>
                        <td>{{ $company->email }}</td>
                        <td>{{ $company->website }}</td>
                        <td>
                            <a href="{{ route('companies.show', $company) }}" class="btn btn-info">View</a>
                            <a href="{{ route('companies.edit', $company) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('companies.destroy', $company) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $companies->links() }}
        </div>
    </div>
@endsection
