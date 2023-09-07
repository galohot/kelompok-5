<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use App\Models\GdpData;
use App\Models\EducationPublicExpenditure;
use App\Models\StudentEnrollment;
use App\Models\TeachingStaff;
use App\Models\Crime;
use App\Models\CountryMaster;
use App\Models\PerwakilanMaster;

class CountryProfileController extends Controller
{
    public function show($countryCode)
    {
        $countries = CountryMaster::all();
        $countryName = CountryMaster::where('CountryCode', $countryCode)->value('Country');
        $perwakilanData = PerwakilanMaster::where('CountryCode', $countryCode)->get(['Office', 'Region']);
        $gdpData = GdpData::where('CountryCode', $countryCode)->get();
        $gdpCurrentPricesData = $gdpData->where('Series', 'GDP in current prices (millions of US dollars)')->all();
        $gdpConstantPricesData = $gdpData->where('Series', 'GDP in constant 2010 prices (millions of US dollars)')->all();
        $gdpPerCapitaData = $gdpData->where('Series', 'GDP per capita (US dollars)')->all();
        $crimeData = Crime::where('CountryCode', $countryCode)->get();
        $educationData = EducationPublicExpenditure::where('CountryCode', $countryCode)->get();
        $enrollmentData = StudentEnrollment::where('CountryCode', $countryCode)->get();
        $staffData = TeachingStaff::where('CountryCode', $countryCode)->get();
    
        // Removed the number_format
    
        return view('admin.countryprofile', compact('countryName', 'gdpData', 'crimeData', 'educationData', 'enrollmentData', 'staffData', 'countries', 'countryCode', 'gdpCurrentPricesData', 'gdpConstantPricesData','gdpPerCapitaData', 'perwakilanData'));
    }
    
    
    
    
    
}
