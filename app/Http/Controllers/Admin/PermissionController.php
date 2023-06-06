<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Show the form for creating a new permission.
     */

    public function index()
    {
        $permissions = Permission::all();
        return view('dashboard/permissions/index', ['permissions' => $permissions]);
    }
    public function create()
    {
        return view('dashboard/roles/permissions');
    }

    public function edit(Permission $permission)
    {
        return view('dashboard/permissions/edit', ['permission' => $permission]);
    }


    public function update(Request $request, Permission $permission)
    {
        $permission->update(['name' => $request->name]);
        return redirect()->route('permissions.index');
    }

    public function store(Request $request)
    {
        $permission = Permission::create(['name' => $request->name]);

        return redirect()->route('permissions.index')->with('success', 'Permission created successfully.');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->back()->withSuccess('Permission deleted !!!');
    }
}
