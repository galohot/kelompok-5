@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<div class="container">
    <div class="row">
        <div class="col-12 col-md-9 mx-auto">
            <form method="POST" action="{{ route('admin.profile.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="mb-4">My Account</h2>
                        <h3 class="card-title">Profile Details</h3>
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <img class="avatar avatar-xl" src="{{ (!empty($profileData->photo)) ? url('upload/admin_images/'.$profileData->photo) : url('upload/no_image.jpg')}}" alt="Avatar">
                            </div>                        
                        </div>
                        <h3 class="card-title mt-4">Business Profile</h3>
                        <div class="row g-3">
                            <div class="mb-3">
                                <div class="form-label">Change Profile Picture</div>
                                <input id="ProfileImage" type="file" name="photo" class="form-control"/>
                            </div>
                            <div class="mb-3">
                                <div class="form-label"></div>
                                <img id="ShowProfileImage" class="avatar avatar-xl" src="{{ (!empty($profileData->photo)) ? url('upload/admin_images/'.$profileData->photo) : url('upload/no_image.jpg')}}" alt="Avatar">
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="businessName" class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" id="businessName" value="{{ $profileData->name }}">
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="businessID" class="form-label">Username</label>
                                    <input type="text" name="username" class="form-control" id="businessID" value="{{ $profileData->username }}">
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="location" class="form-label">Role</label>
                                    <input type="text" name="role" class="form-control" id="location" value="{{ $profileData->role }}">
                                </div>
                            </div>
                        </div>
                        <h3 class="card-title mt-4">Email</h3>
                        <p class="card-subtitle">This contact will be shown to others publicly, so choose it carefully.</p>
                        <div class="row g-2 align-items-center">
                            <div class="col-auto">
                                <input type="email" name="email" class="form-control" value="{{ $profileData->email }}">
                            </div>
                        </div>
                        <h3 class="card-title mt-4">Password</h3>
                        <p class="card-subtitle">You can set a permanent password if you don't want to use temporary login codes.</p>
                        <div>
                            <a href="#" class="btn btn-link">Set new password</a>
                        </div>
                        
                    </div>
                    <div class="card-footer bg-transparent">
                        <div class="btn-list justify-content-end">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>                    
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#ProfileImage').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#ShowProfileImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

@endsection