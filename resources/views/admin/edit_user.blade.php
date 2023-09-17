@extends('admin.admin_dashboard')
@section('admin')

<div class="container mt-4">
    <h2>Edit User</h2>

    <form action="{{ route('admin.usermanagement.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Rest of the form fields would be similar to 'create_user.blade.php' but with value attribute -->
        <!-- Example: -->
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required value="{{ $user->name }}">
        </div>

        <!-- Repeat for other fields, don't forget to add the 'value' attribute to pre-fill existing data -->
        
        <button type="submit" class="btn btn-primary">Update User</button>
    </form>
</div>

@endsection
