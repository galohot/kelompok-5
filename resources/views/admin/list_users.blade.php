@extends('admin.admin_dashboard')
@section('admin')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<div class="container mt-4">
    <h2>All Users</h2>
    <div class="my-3">
        <form action="{{ route('admin.usermanagement.index') }}" method="GET">
            <input type="text" name="search" class="form-control" placeholder="Search by name or email">
            <button type="submit" class="btn btn-primary mt-2">Search</button>
        </form>
    </div>
    <a href="{{ route('admin.usermanagement.create') }}" class="btn btn-success my-4">Create User</a>

    @foreach($users as $user)
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $user->name }}</h5>
            <p class="card-text">{{ $user->email }}</p>
            <a href="{{ route('admin.usermanagement.edit', $user->id) }}" class="btn btn-primary">Edit</a>

            <form action="{{ route('admin.usermanagement.destroy', $user->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
            </form>
        </div>
    </div>
    @endforeach
</div>
{{ $users->links() }}
@endsection
