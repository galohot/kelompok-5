<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    
    protected function getGeoChartData()
    {
        $data = DB::table('gdp-data')
            ->where('Year', 2020)
            ->where('Series', 'GDP real rates of growth (percent)')
            ->select('CountryCode', 'Country', DB::raw('FORMAT(Value, 0) AS Value')) 
            ->get();

        return $data->pluck('Value', 'CountryCode')->toArray();
    }
    public function AdminDashboard()
    {
        $data = $this->getGeoChartData();
        return view('admin.index', compact('data'));
    }

    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    } //end method

    
    public function AdminLogin(){

        return view('admin.admin_login');

    }//end method

    public function AdminProfile(){

        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.body.admin_profile_view',compact('profileData'));

    }//end method
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

        return view('admin.geochart', compact('data', 'dataTableOptions'));
    }
    
    
    
    public function CountryProfile(){

        return view('admin.countryprofile');

    }//end method


}
