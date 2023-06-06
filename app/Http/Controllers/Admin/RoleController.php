<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('dashboard/roles/index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();

        return view('dashboard/roles/create', compact('permissions'));
    }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     $role = Role::create(['name' => $request->name]);
    //     $role->syncPermissions($request->input('permissions', []));

    //     return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    // }


    public function store(Request $request)
    {
        $role = Role::create(['name' => $request->name]);

        $permissions = Permission::whereIn('id', $request->input('permissions', []))->get();
        $role->syncPermissions($permissions);

        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    public function show(string $id)
    {
        $role = Role::findById($id);
        $users = User::all();

        return view('dashboard.roles.show', compact('role', 'users'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();

        return view('dashboard/roles/edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $role->name = $request->name;
        $role->save();

        $role->syncPermissions($request->input('permissions', []));

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }

    /**
     * Assign a role to a user.
     */
    public function assignRole(Request $request, User $user)
    {
        $role = Role::find($request->role_id);

        if ($role) {
            $user->assignRole($role);
            return redirect()->route('roles.index')->with('success', 'Role assigned successfully.');
        }

        return redirect()->back()->with('error', 'Role not found.');
    }

    /**
     * Remove a role from a user.
     */

    public function removeRole(Request $request, User $user)
    {
        $role = Role::find($request->role_id);

        if ($role) {
            $user->removeRole($role);
            return redirect()->route('roles.index')->with('success', 'Role removed successfully.');
        }

        return redirect()->back()->with('error', 'Role not found.');
    }
}
