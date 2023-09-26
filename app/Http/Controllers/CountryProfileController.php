<?php

namespace App\Http\Controllers;

use App\Models\BelanjaPengadaanMaster;
use Illuminate\Support\Facades\DB;
use App\Models\GdpData;
use App\Models\EducationPublicExpenditure;
use App\Models\StudentEnrollment;
use App\Models\TeachingStaff;
use App\Models\Crime;
use App\Models\CountryMaster;
use App\Models\PerwakilanMaster;
use App\Models\PopulationDensity;
use App\Models\Tourism;
use App\Models\WorldBankMacro;
use App\Models\WorldBankEdu;
use App\Models\WorldBankTrade;


class CountryProfileController extends Controller
{
    public function show($countryCode)
    {
        $countries = CountryMaster::all();
        $countryName = CountryMaster::where('CountryCode', $countryCode)->value('Country');
        $perwakilanData = PerwakilanMaster::where('CountryCode', $countryCode)->get(['Office', 'Region']);

        // Safely get the Region
        $region = ($perwakilanData && $perwakilanData->first()) ? $perwakilanData->first()->Region : null;
        
        // Fetch the data from BelanjaPengadaanMaster based on the region, if it exists
        if ($region) {
            $belanjaPengadaanData = BelanjaPengadaanMaster::where('CountryCode', $countryCode)
                                                ->where('Region', $region)
                                                ->first(['ePurchasing','PengadaanLangsung','TenderKonstruksi','Seleksi']);
        } else {
            $belanjaPengadaanData = null;
        }
        $gdpData = GdpData::where('CountryCode', $countryCode)->get();
        $gdpCurrentPricesData = $gdpData->where('Series', 'GDP in current prices (millions of US dollars)')->all();
        $gdpConstantPricesData = $gdpData->where('Series', 'GDP in constant 2010 prices (millions of US dollars)')->all();
        $gdpPerCapitaData = $gdpData->where('Series', 'GDP per capita (US dollars)')->all();
        $crimeData = Crime::where('CountryCode', $countryCode)->get();
        $educationData = EducationPublicExpenditure::where('CountryCode', $countryCode)->get();
        $gdpRealGrowth = $gdpData->where('Series', 'GDP real rates of growth (percent)')->pluck('Value', 'Year')->toArray();
        $latestGdpPerCapitaValue = $gdpData
            ->where('Series', 'GDP per capita (US dollars)')
            ->sortByDesc('Year')
            ->first()['Value'];
    
        $intentionalHomicide = $crimeData->where('Series', 'Intentional homicide rates per 100,000')->pluck('Value', 'Year')->toArray();
        $publicEduExpenditure = $educationData->where('Series', 'Public expenditure on education (% of GDP)')->pluck('Value', 'Year')->toArray();
        $enrollmentData = StudentEnrollment::where('CountryCode', $countryCode)->get();
        $staffData = TeachingStaff::where('CountryCode', $countryCode)->get();
        $populationData = PopulationDensity::where('CountryCode', $countryCode)->get();
        $latestPopulationDensity = $populationData->where('Series', 'Population density')->sortByDesc('Year')->first();
        $latestSurfaceArea = $populationData->where('Series', 'Surface area (thousand km2)')->sortByDesc('Year')->first();
        $latestSexRatio = $populationData->where('Series', 'Sex ratio (males per 100 females)')->sortByDesc('Year')->first();
        // Initialize variables for male and female percentages
        $malePercentage = null;
        $femalePercentage = null;
    
        if ($latestSexRatio) {
            // Get the value from the latest Sex ratio data
            $sexRatioValue = $latestSexRatio->Value;
    
            // Calculate male and female percentages
            $malePercentage = ($sexRatioValue / ($sexRatioValue + 100)) * 100;
            $femalePercentage = 100 - $malePercentage;
        }

        // Retrieve the values for the young and old age groups
        $youngPopulationPercentage = $populationData->where('Series', 'Population aged 0 to 14 years old (percentage)')->sortByDesc('Year')->first();
        $oldPopulationPercentage = $populationData->where('Series', 'Population aged 60+ years old (percentage)')->sortByDesc('Year')->first();

        // Calculate the middle age group
        $midPopulationPercentage = 100;
        if ($youngPopulationPercentage) {
            $midPopulationPercentage -= $youngPopulationPercentage->Value;
        }
        if ($oldPopulationPercentage) {
            $midPopulationPercentage -= $oldPopulationPercentage->Value;
        }

        $youngPercentage = $youngPopulationPercentage ? $youngPopulationPercentage->Value : 0;
        $oldPercentage = $oldPopulationPercentage ? $oldPopulationPercentage->Value : 0;
        $tourismData = Tourism::where('CountryCode', $countryCode)->get();
        $tourismExpenditureData = $tourismData->where('Series', 'Tourism expenditure (millions of US dollars)')->all();
        $tourismArrivalData = $tourismData->where('Series', 'Tourist/visitor arrivals (thousands)')->all();

        function categorizeIncome($value) {
            if ($value < 1085) {
                return "Low income";
            } elseif ($value >= 1086 && $value <= 4255) {
                return "Lower-middle income";
            } elseif ($value >= 4256 && $value <= 13205) {
                return "Upper-middle income";
            } else {
                return "High income";
            }
        }

        $incomeCategory = categorizeIncome($latestGdpPerCapitaValue);
        $worldBankAll = WorldBankMacro::where('CountryCode', $countryCode)->get();

        $worldBankMacroData = [];
        
        foreach ($worldBankAll as $data) {
            $series = $data->Series;
            $value = null;
        
            for ($year = 2022; $year >= 2018; $year--) {
                $column = (string)$year;
                if (!empty($data->$column)) {
                    $value = $data->$column;
                    break;
                }
            }
        
            $worldBankMacroData[$series] = $value;
        }

        $worldBankTrade = WorldBankTrade::where('CountryCode', $countryCode)->get();
        return view('countryprofile', compact(
            'countryName', 
            'gdpData', 
            'crimeData', 
            'educationData', 
            'enrollmentData', 
            'staffData', 
            'countries', 
            'countryCode', 
            'gdpCurrentPricesData', 
            'gdpConstantPricesData', 
            'gdpPerCapitaData', 
            'perwakilanData', 
            'belanjaPengadaanData', 
            'populationData', 
            'tourismData', 
            'tourismExpenditureData', 
            'tourismArrivalData', 
            'latestPopulationDensity', 
            'latestSurfaceArea', 
            'malePercentage', 
            'femalePercentage', 
            'youngPercentage', 
            'midPopulationPercentage', 
            'oldPercentage',
            'gdpRealGrowth',
            'intentionalHomicide',
            'publicEduExpenditure',
            'latestGdpPerCapitaValue',
            'incomeCategory',
            'worldBankMacroData'
        ));
        
    }

    
}
