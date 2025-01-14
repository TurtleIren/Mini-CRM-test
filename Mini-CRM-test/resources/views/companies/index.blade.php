@extends('layouts.app')

@section('title', 'Companies')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Companies</h3>
            <a href="{{ route('companies.create') }}" class="btn btn-primary float-right">Add Company</a>
        </div>
        <div class="card-body">
            <table id="companiesTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Logo</th>
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
                        <td>
                            @if($company->logo)
                                <img src="{{ $company->logoUrl }}" alt="Company Logo" width="50">
                            @endif
                        </td>
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
            {{-- $companies->links() --}}
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#companiesTable').DataTable();
        });

        $('#companiesTable').DataTable({
            "pagingType": "full_numbers", // Відображення пагінації з номерами
            "lengthMenu": [5, 10, 25, 50], // Кількість записів на сторінку
            "language": {
                "paginate": {
                    "first": "First",
                    "last": "Last",
                    "next": "Next",
                    "previous": "Previous"
                },
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "lengthMenu": "Show _MENU_ entries"
            }
        });

    </script>


@stop
