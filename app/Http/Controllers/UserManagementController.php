<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user_management', compact('users'));
    }
    
    public function edit(User $user)
    {
        return view('admin.edit_user', compact('user'));
    }
    
    public function update(Request $request, User $user)
    {
        // Validate and update the user's data here
    
        $user->update($request->all());
        return redirect()->route('admin.usermanagement');
    }
    
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.usermanagement');
    }
    public function create()
    {
        return view('admin.create_user');
    }
    
    public function store(Request $request)
    {
        $validated = [
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role'),
            'status' => $request->input('status'),
            // Add any other fields here
        ];
    
        User::create($validated);
    
        return redirect()->route('admin.usermanagement.index');
    }
        
}