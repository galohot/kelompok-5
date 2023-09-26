@extends('admin.admin_dashboard')

@section('admin')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('admin.update_belanja', ['countryCode' => $countryCode, 'id' => $data->id]) }}" method="POST">
                    @csrf
                    <div class="form-group my-4">
                        <label for="ePurchasing">ePurchasing:</label>
                        <input type="text" name="ePurchasing" value="{{ $data->ePurchasing }}" class="form-control">
                    </div>
                    <div class="form-group my-4">
                        <label for="PengadaanLangsung">Pengadaan Langsung:</label>
                        <input type="text" name="PengadaanLangsung" value="{{ $data->PengadaanLangsung }}" class="form-control">
                    </div>
                    <div class="form-group my-4">
                        <label for="TenderKonstruksi">Tender Konstruksi:</label>
                        <input type="text" name="TenderKonstruksi" value="{{ $data->TenderKonstruksi }}" class="form-control">
                    </div>
                    <div class="form-group my-4">
                        <label for="Seleksi">Seleksi:</label>
                        <input type="text" name="Seleksi" value="{{ $data->Seleksi }}" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
