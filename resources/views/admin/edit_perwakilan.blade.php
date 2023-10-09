@extends('admin.admin_dashboard')

@section('admin')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('admin.update_perwakilan', ['countryCode' => $countryCode, 'id' => $data->id]) }}" method="POST">
                    @csrf
                    <div class="form-group my-4">
                        <label for="Office">Office:</label>
                        <input type="text" name="Office" value="{{ $data->Office }}" class="form-control">
                    </div>
                    <div class="form-group my-4">
                        <label for="Region">Region:</label>
                        <input type="text" name="Region" value="{{ $data->Region }}" class="form-control" readonly>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
