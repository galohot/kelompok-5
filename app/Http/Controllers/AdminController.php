<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\PerwakilanMaster;
use App\Models\WorldBankWorld;
use App\Models\WorldBankEdu;
use App\Models\WorldBankTrade;


class AdminController extends Controller
{

    protected function getGeoChartData()
    {
        $geoChartData = DB::table('gdp-data')
            ->where('Year', 2020)
            ->where('Series', 'GDP real rates of growth (percent)')
            ->select('CountryCode', 'Country', DB::raw('FORMAT(Value, 0) AS Value')) 
            ->get();

        return $geoChartData->pluck('Value', 'CountryCode')->toArray();
    }

    public function getDataForAdminDashboard()
    {
        $geoChartData = $this->getGeoChartData();
        $perwakilanData = PerwakilanMaster::all();
        $uniqueRegionsCount = PerwakilanMaster::distinct('Country')->count();
        $worldData = WorldBankWorld::all();
    
        return compact('geoChartData', 'perwakilanData', 'uniqueRegionsCount', 'worldData');
    }
    
    public function AdminDashboard()
    {
        $data = $this->getDataForAdminDashboard();
        return view('admin.index', $data);
    }
    
    public function getIndex()
    {
        $data = $this->getDataForAdminDashboard();
        return view('index', $data);
    }
    

    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    } //end method
    public function GeneralLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    } //end method

    
    public function AdminLogin(){

        return view('admin.admin_login');

    }//end method

    public function AdminProfile(){

        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_profile_view',compact('profileData'));

    }//end method

    public function AdminProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->username = $request->username;
        $data->role = $request->role;
        $data->email = $request->email;
    
        if ($request->file('photo')) {
            $file = $request->file('photo');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);
            $data['photo'] = $filename;
        }
    
        // Check if a new password was provided
        if ($request->has('password')) {
            $data->password = bcrypt($request->password);
        }
    
        $data->save();
        return redirect()->back()->with('success', 'Profile updated successfully');;
    }
    

    public function GeoChart()
    {
        $data = $this->getGeoChartData();
        
        $dataTableOptions = [
            "paging" => true,
            "lengthChange" => true,
            "searching" => true,
            "info" => true,
            "autoWidth" => false,
        ];

        return view('geochart', compact('data', 'dataTableOptions'));
    }
    
    
    
    public function CountryProfile(){

        return view('admin.countryprofile');

    }//end method

    public function DataStudioGDP(){

        return view('admin.datastudio_gdp');

    }//end method

    public function DataStudioEDU(){

        return view('admin.datastudio_edu');

    }//end method
    public function DataStudioCRIME(){

        return view('admin.datastudio_crime');

    }//end method



}
