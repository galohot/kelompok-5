@extends('dashboard')
@section('content')

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
    <h2>Edit User: {{ $user->name }}</h2>

    <form action="{{ route('admin.usermanagement.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
        </div>
        
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" value="{{ $user->username }}">
        </div>
        
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password (Fill this only if you want to change the password)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select name="role" class="form-control">
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="agent" {{ $user->role == 'agent' ? 'selected' : '' }}>Agent</option>
                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-control">
                <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $user->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

@endsection
