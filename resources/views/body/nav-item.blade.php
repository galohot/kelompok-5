<div class="nav-item dropdown">
    <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
      <span class="avatar avatar-sm" style="background-image: url({{ (!empty($profileData->photo)) ? url('upload/admin_images/'.$profileData->photo) : url('upload/no_image.jpg')}})"></span>
      <div class="d-none d-xl-block ps-2">
        <div>{{ $profileData->username }}</div>
        <div class="mt-1 small text-secondary">{{ $profileData->role }}</div>
      </div>
    </a>
    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
      @if (Auth::user()->role === 'admin' || Auth::user()->role === 'agent')
      <a href="{{ route('admin.datamanagement', ['countryCode' => 'AF']) }}" class="dropdown-item">Data Management</a>
      @endif
      @if (Auth::user()->role === 'admin')
      <a href="{{ route('admin.usermanagement.index') }}" class="dropdown-item">User Management</a>
      @endif
      <a href="{{ route('admin.profile') }}" class="dropdown-item">Profile</a>
      <div class="dropdown-divider"></div>
      <a href="{{ route('admin.logout') }}" class="dropdown-item">Logout</a>

    </div>
  </div>