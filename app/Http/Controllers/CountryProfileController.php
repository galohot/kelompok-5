<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CountryProfileController extends Controller
{
    public function show($countryCode)
{
    // Retrieve all data for the clicked country
    $countryData = DB::table('gdp-data')
        ->where('CountryCode', $countryCode)
        ->get();

    return view('admin.countryprofile', compact('countryData'));
}
}
