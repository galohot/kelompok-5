@extends('admin.admin_dashboard')

@section('admin')
<div class="container">
    <!-- Country Dropdown -->
    <div class="card mt-4">
        <div class="card-header">
            <h3 class="card-title">Select Country</h3>
        </div>
        <div class="card-body">
            <select class="form-select" id="countryDropdown" onchange="location = this.value;">
                @foreach ($countries as $country)
                <option value="{{ route('admin.countrydata', $country->CountryCode) }}" 
                        {{ $countryCode == $country->CountryCode ? 'selected' : '' }}>
                    {{ $country->Country }}
                </option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Perwakilan Data Table -->
    <div class="card mt-4">
        <div class="card-header">
            <h3 class="card-title">Perwakilan Data</h3>
        </div>
        <div class="table-responsive">
            <table class="table card-table table-vcenter">
                <thead>
                    <tr>
                        <th>Office</th>
                        <th>Region</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($perwakilanData as $data)
                    <tr>
                        <td>{{ $data->Office }}</td>
                        <td>{{ $data->Region }}</td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm">Edit</a>
                            <a href="#" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Belanja Pengadaan Data Table -->
    @if($belanjaPengadaanData)
    <div class="card mt-4">
        <div class="card-header">
            <h3 class="card-title">Belanja Pengadaan Data</h3>
        </div>
        <div class="table-responsive">
            <table class="table card-table table-vcenter">
                <thead>
                    <tr>
                        <th>ePurchasing</th>
                        <th>PengadaanLangsung</th>
                        <th>TenderKonstruksi</th>
                        <th>Seleksi</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $belanjaPengadaanData->ePurchasing }}</td>
                        <td>{{ $belanjaPengadaanData->PengadaanLangsung }}</td>
                        <td>{{ $belanjaPengadaanData->TenderKonstruksi }}</td>
                        <td>{{ $belanjaPengadaanData->Seleksi }}</td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm">Edit</a>
                            <a href="#" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>

<script>
    document.getElementById("countryDropdown").addEventListener('change', function() {
        window.location.href = this.value;
    });
</script>

@endsection
