@extends('admin.admin_dashboard')
@section('admin')

<div class="container">
    <div class="row">
        <div class="col-12 col-md-9 mx-auto">
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="mb-4">My Account</h2>
                    <h3 class="card-title">Profile Details</h3>
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="avatar avatar-xl" style="background-image: url(./static/avatars/000m.jpg)"></div>
                        </div>
                        <div class="col-auto">
                            <a href="#" class="btn btn-link">Change avatar</a>
                        </div>
                        <div class="col-auto">
                            <a href="#" class="btn btn-ghost-danger">Delete avatar</a>
                        </div>
                    </div>
                    <h3 class="card-title mt-4">Business Profile</h3>
                    <div class="row g-3">
                        <div class="col-md">
                            <div class="form-group">
                                <label for="businessName" class="form-label">Business Name</label>
                                <input type="text" class="form-control" id="businessName" value="Tabler">
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                                <label for="businessID" class="form-label">Business ID</label>
                                <input type="text" class="form-control" id="businessID" value="560afc32">
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" class="form-control" id="location" value="Peimei, China">
                            </div>
                        </div>
                    </div>
                    <h3 class="card-title mt-4">Email</h3>
                    <p class="card-subtitle">This contact will be shown to others publicly, so choose it carefully.</p>
                    <div class="row g-2 align-items-center">
                        <div class="col-auto">
                            <input type="text" class="form-control" value="paweluna@howstuffworks.com">
                        </div>
                        <div class="col-auto">
                            <a href="#" class="btn btn-link">Change</a>
                        </div>
                    </div>
                    <h3 class="card-title mt-4">Password</h3>
                    <p class="card-subtitle">You can set a permanent password if you don't want to use temporary login codes.</p>
                    <div>
                        <a href="#" class="btn btn-link">Set new password</a>
                    </div>
                    <h3 class="card-title mt-4">Public profile</h3>
                    <p class="card-subtitle">Making your profile public means that anyone on the Dashkit network will be able to find you.</p>
                    <div class="form-check form-switch form-switch-lg mb-4">
                        <input class="form-check-input" type="checkbox" id="publicProfile">
                        <label class="form-check-label" for="publicProfile">You're currently visible</label>
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <div class="btn-list justify-content-end">
                        <a href="#" class="btn btn-secondary">Cancel</a>
                        <a href="#" class="btn btn-primary">Submit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection