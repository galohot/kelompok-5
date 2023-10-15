@extends('dashboard')
@section('content')
<div class="container">
    <!-- Country Dropdown -->
{{-- Add this at the top of your file --}}
@csrf

<div class="card mt-4">
    <a href="{{ route('admin.countryprofile', ['countryCode' => $countryCode]) }}" class="btn btn-primary col-6 m-auto">{{ $perwakilanData[0]['Country'] }} PROFILE</a>
    <div class="card-header">
        <h3 class="card-title">Select Country</h3>
    </div>
    <div class="card-body">
        <select class="form-select" id="countryDropdown" onchange="location = this.value;">
            @foreach ($countries as $country)
            <option value="{{ route('admin.datamanagement', $country->CountryCode) }}" 
                    {{ $countryCode == $country->CountryCode ? 'selected' : '' }}>
                {{ $country->Country }}
            </option>
            @endforeach
        </select>
    </div>
    
</div>

{{-- Add Create Button for Perwakilan Data Table --}}
<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">Add Perwakilan Data</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.add_perwakilan', $countryCode) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="Office">Country</label>
                <input type="text" name="Country" class="form-control" value="{{ $perwakilanData[0]['Country'] }}" readonly>
            </div>
            <div class="mb-3">
                <label for="Office">Office</label>
                <input type="text" name="Office" class="form-control">
            </div>
            <div class="mb-3">
                <label for="Region">Region</label>
                <input type="text" name="Region" class="form-control" value="{{ $perwakilanData[0]['Region'] }}" readonly>
            </div>            
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>
</div>

{{-- Add Create Button for Belanja Pengadaan Data Table --}}
{{-- <div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">Add Belanja Pengadaan Data</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.add_belanja', $countryCode) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="ePurchasing">ePurchasing</label>
                <input type="text" name="ePurchasing" class="form-control">
            </div>
            <div class="mb-3">
                <label for="PengadaanLangsung">Pengadaan Langsung</label>
                <input type="text" name="PengadaanLangsung" class="form-control">
            </div>
            <div class="mb-3">
                <label for="TenderKonstruksi">Tender Konstruksi</label>
                <input type="text" name="TenderKonstruksi" class="form-control">
            </div>
            <div class="mb-3">
                <label for="Seleksi">Seleksi</label>
                <input type="text" name="Seleksi" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>
</div> --}}

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
                            <a href="{{ route('admin.edit_perwakilan', ['countryCode' => $countryCode, 'id' => $data->id]) }}" class="btn btn-info btn-sm">Edit</a>
                            <form action="{{ route('admin.destroy_perwakilan', ['countryCode' => $countryCode, 'id' => $data->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
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
                        <td>USD {{ number_format($belanjaPengadaanData->ePurchasing) }}</td>
                        <td>USD {{ number_format($belanjaPengadaanData->PengadaanLangsung) }}</td>
                        <td>USD {{ number_format($belanjaPengadaanData->TenderKonstruksi) }}</td>
                        <td>USD {{ number_format($belanjaPengadaanData->Seleksi) }}</td>                        
                        <td>
                            <a href="{{ route('admin.edit_belanja', ['countryCode' => $countryCode, 'id' => $belanjaPengadaanData->id]) }}" class="btn btn-info btn-sm">Edit</a>
                            <form action="{{ route('admin.destroy_belanja', ['countryCode' => $countryCode, 'id' => $belanjaPengadaanData->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
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
