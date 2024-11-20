<?php

namespace App\Http\Controllers;
use App\Models\Role;
use Illuminate\Http\Request;

class AdminRolesController extends Controller
{
    public function index(Request $request){
        $roles = Role::all();
        return view('adminRoles', compact('roles'));
    }
    public function store(Request $request){
        $request->validate([
            'role' => 'required|string|max:255',
            'access_level' => 'required|string|max:255',
        ]);

        Role::create([
            'role' => $request->role,
            'access_level' => $request->access_level,
        ]);
        return redirect()->route('adminRoles')->with('success', 'Role added successfully');
    }
    public function edit(Request $request){
        $shift = Shift::findOrFail($id);

        $request->validate([
            'role' => 'required|string|max:255',
            'access_level' => 'required|string|max:255',
        ]);
        $roles->update([
            'role' => $request->role,
            'access_level' => $request->access_level,
        ]);

        return redirect()->route('adminRoles')->with('success', 'Role updated successfully');
    }
    public function delete(Request $request){
        $role = Role::findOrFail($id);
        $role->delete();
        
        return redirect()->route('adminRoles')->with('success', 'Role deleted successfully');
    }

}
