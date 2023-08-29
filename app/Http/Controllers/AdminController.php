<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function AdminDashboard(){

        return view('admin.index');

    } //end method

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
        // Fetch data from the database, including the "Country" column, with "Value" formatted
        $data = DB::table('gdp-data')
            ->where('Year', 2020)
            ->where('Series', 'GDP real rates of growth (percent)')
            ->select('CountryCode', 'Country', DB::raw('FORMAT(Value, 0) AS Value')) // Format "Value" with thousands separator
            ->get(); // Get the data as a collection
    
        // Convert the collection to an associative array
        $data = $data->pluck('Value', 'CountryCode')->toArray();
    
        // Define DataTable options
        $dataTableOptions = [
            "paging" => true,
            "lengthChange" => true,
            "searching" => true,
            "info" => true,
            "autoWidth" => false,
        ];
    
        // Pass the data and DataTable options to the view
        return view('admin.geochart', compact('data', 'dataTableOptions'));
    }
    
    
    
    public function CountryProfile(){

        return view('admin.countryprofile');

    }//end method


}
