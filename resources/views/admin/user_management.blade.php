@extends('dashboard')
@section('content')

<div class="container mt-4">
    <h2>User Management</h2>
    <a href="{{ route('admin.usermanagement.create') }}" class="btn btn-success mb-2">Add New User</a>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>{{ $user->status }}</td>
                <td>
                    <a href="{{ route('admin.usermanagement.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('admin.usermanagement.destroy', $user->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
