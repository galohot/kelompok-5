<h1>Country Profile</h1>
@extends('admin.admin_dashboard')
@section('admin')
@if($countryData->count() > 0)
    <table>
        <thead>
            <tr>
                <th>Year</th>
                <th>Series</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
            @foreach($countryData as $data)
                <tr>
                    <td>{{ $data->Year }}</td>
                    <td>{{ $data->Series }}</td>
                    <td>{{ $data->Value }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No data available for this country.</p>
@endif
@endsection