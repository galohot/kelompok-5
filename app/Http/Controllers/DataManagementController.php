<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BelanjaPengadaanMaster;
use App\Models\CountryMaster;
use App\Models\PerwakilanMaster;
use App\Models\PopulationDensity;
use App\Models\Tourism;

class DataManagementController extends Controller
{
    public function show($countryCode)
    {
        $countries = CountryMaster::all();
        $countryName = CountryMaster::where('CountryCode', $countryCode)->value('Country');
        $perwakilanData = PerwakilanMaster::where('CountryCode', $countryCode)->get(['Country','Office', 'Region', 'id','CountryCode']);
        $region = ($perwakilanData && $perwakilanData->first()) ? $perwakilanData->first()->Region : null;
        $belanjaPengadaanData = $region ? BelanjaPengadaanMaster::where('CountryCode', $countryCode)
                                          ->where('Region', $region)
                                          ->first(['ePurchasing','PengadaanLangsung','TenderKonstruksi','Seleksi','id']) 
                                      : null;
    
        return view('admin.data_management', compact('countries', 'countryCode', 'perwakilanData', 'belanjaPengadaanData'));
    }

    public function addPerwakilan(Request $request, $countryCode)
    {
        $data = $request->validate([
            'Country' => 'required',
            'Office' => 'required',
            'Region' => 'required',
        ]);
        $data['CountryCode'] = $countryCode;
        PerwakilanMaster::create($data);
        return redirect()->route('admin.datamanagement', $countryCode);
    }
    
    public function addBelanja(Request $request, $countryCode)
    {
        $data = $request->validate([
            'ePurchasing' => 'required',
            'PengadaanLangsung' => 'required',
            'TenderKonstruksi' => 'required',
            'Seleksi' => 'required',
        ]);
        $data['CountryCode'] = $countryCode;
        BelanjaPengadaanMaster::create($data);
        return redirect()->route('admin.datamanagement', $countryCode);
    }

    public function editPerwakilan($countryCode, $id)
    {
        $data = PerwakilanMaster::findOrFail($id);
        return view('admin.edit_perwakilan', compact('data', 'countryCode'));
    }
    
    public function updatePerwakilan(Request $request, $countryCode, $id)
    {
        $data = $request->all();
        PerwakilanMaster::where('id', $id)->update($data);
        return redirect()->route('admin.datamanagement', $countryCode);
    }
    
    public function editBelanja($countryCode, $id)
    {
        $data = BelanjaPengadaanMaster::findOrFail($id);
        return view('admin.edit_belanja', compact('data', 'countryCode'));
    }
    
    public function updateBelanja(Request $request, $countryCode, $id)
    {
        $data = $request->all();
        BelanjaPengadaanMaster::where('id', $id)->update($data);
        return redirect()->route('admin.datamanagement', $countryCode);
    }

    public function destroyPerwakilan($countryCode, $id)
    {
        PerwakilanMaster::where('id', $id)->delete();
        return redirect()->route('admin.datamanagement', $countryCode);
    }
    
    public function destroyBelanja($countryCode, $id)
    {
        BelanjaPengadaanMaster::where('id', $id)->delete();
        return redirect()->route('admin.datamanagement', $countryCode);
    }
    
    
}
