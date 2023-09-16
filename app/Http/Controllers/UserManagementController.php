<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function UserManagement(){

        return view('admin.user_management');

    }//end method
    
}