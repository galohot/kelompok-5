<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use App\Models\GdpData;
use App\Models\EducationPublicExpenditure;
use App\Models\StudentEnrollment;
use App\Models\TeachingStaff;
use App\Models\Crime;
use App\Models\CountryMaster;

class CountryProfileController extends Controller
{
    public function show($countryCode)
    {
        // Retrieve the country name from the CountryMaster model
        $countryName = CountryMaster::where('CountryCode', $countryCode)->value('Country');
    
        // Retrieve data for the clicked country from different tables
        $gdpData = GdpData::where('CountryCode', $countryCode)->get();
        $crimeData = Crime::where('CountryCode', $countryCode)->get();
        $educationData = EducationPublicExpenditure::where('CountryCode', $countryCode)->get();
        $enrollmentData = StudentEnrollment::where('CountryCode', $countryCode)->get();
        $staffData = TeachingStaff::where('CountryCode', $countryCode)->get();
    
        // Format the numeric values in $gdpData and $crimeData arrays
        foreach ($gdpData as &$data) {
            $data->Value = number_format($data->Value, 2); // 2 decimal places
        }
    
        foreach ($crimeData as &$data) {
            $data->Value = number_format($data->Value, 2); // 2 decimal places
        }
        foreach ($educationData as &$data) {
            $data->Value = number_format($data->Value, 2); // 2 decimal places
        }
        foreach ($enrollmentData as &$data) {
            $data->Value = number_format($data->Value, 2); // 2 decimal places
        }
        foreach ($staffData as &$data) {
            $data->Value = number_format($data->Value, 2); // 2 decimal places
        }
    
        // Pass the formatted data to the view
        return view('admin.countryprofile', compact('countryName', 'gdpData', 'crimeData', 'educationData', 'enrollmentData', 'staffData'));
    }
    
    
}
