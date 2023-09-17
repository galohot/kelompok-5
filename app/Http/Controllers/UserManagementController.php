<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();
    
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('name', 'like', "%$search%")->orWhere('email', 'like', "%$search%");
        }
    
        $users = $query->paginate(10);
        return view('admin.list_users', ['users' => $users]);
    }
      
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit_user', ['user' => $user]);
    }
    
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role' => 'required|string|max:50',
            'status' => 'required|string|max:50',
            // Add any other fields to be validated here
        ]);
    
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        }
    
        $user->update($validated);
    
        return redirect()->route('admin.usermanagement.index')->with('success', 'User updated successfully');
    }
    
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.usermanagement.index')->with('success', 'User deleted successfully');
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