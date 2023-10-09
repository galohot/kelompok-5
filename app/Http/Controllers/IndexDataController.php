<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
use App\Models\WorldBankWorld;

class IndexDataController extends Controller
{
    protected function getTradeChartData() {
        $desiredSeries = [
            'Imports of goods and services (% of GDP)',
            'Exports of goods and services (% of GDP)',
            'Fuel exports (% of merchandise exports)',
            'Fuel imports (% of merchandise imports)'
        ];
    
        $tradeData = WorldBankWorld::whereIn('Series', $desiredSeries)
                                    ->select('Series', '2018', '2019', '2020', '2021', '2022')
                                    ->get();
    
        $formattedData = [];
        foreach ($tradeData as $data) {
            $formattedData[] = [
                'name' => $data->Series,
                'data' => [$data->{'2018'}, $data->{'2019'}, $data->{'2020'}, $data->{'2021'}, $data->{'2022'}]
            ];
        }
    
        return [
            'series' => $formattedData,
            'labels' => ['2018', '2019', '2020', '2021', '2022']
        ];
    }

    protected function getGeoChartData()
    {
        $geoChartData = DB::table('gdp-data')
            ->where('Year', 2020)
            ->where('Series', 'GDP real rates of growth (percent)')
            ->select('CountryCode', 'Country', DB::raw('FORMAT(Value, 0) AS Value')) 
            ->get();

        return $geoChartData->pluck('Value', 'CountryCode')->toArray();
    }

    public function getIndexDashboardData()
    {
        $geoChartData = $this->getGeoChartData();
        $perwakilanData = PerwakilanMaster::all();
        $uniqueRegionsCount = PerwakilanMaster::distinct('Country')->count();
        $worldData = WorldBankWorld::all();
        
        


        $tradeChartData = $this->getTradeChartData();

        

        return array_merge(compact('geoChartData', 'perwakilanData', 'uniqueRegionsCount', 'worldData'), $tradeChartData);
    }
    
    
    public function getIndex()
    {
        $data = $this->getIndexDashboardData();
        return view('index', $data);
    }

    
    
}
