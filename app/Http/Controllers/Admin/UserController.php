<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Barryvdh\DomPDF\Facade\Pdf;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::get();
        return view('dashboard/user/users', ['Users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        return view('dashboard/user/view', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    public function userRoles($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('dashboard/user/roles', ['roles' => $roles, 'id' => $id, 'user' => $user]);
    }

    public function saveRole(Request $request)
    {
        $user = User::findOrFail($request->input('user_id'));
        $selectedRoles = $request->input('roles') ?? [];

        $existingRoles = $user->roles->pluck('id')->toArray();

        $rolesToRemove = array_diff($existingRoles, $selectedRoles);
        foreach ($rolesToRemove as $roleId) {
            $role = Role::findOrFail($roleId);
            $user->removeRole($role);
        }

        foreach ($selectedRoles as $roleId) {
            $role = Role::findOrFail($roleId);
            if (!$user->hasRole($role)) {
                $user->assignRole($role);
            }
        }

        return redirect()->route('users.roles', $user->id);
    }


    public function pdf()
    {
        $users = User::all();
        $pdf = Pdf::loadView('dashboard.user.pdf_view', compact('users'));
        return $pdf->setPaper('a4', 'landscape')->download('users.pdf');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        if ($user) {
            $user->delete();
        }
        return redirect()->route('users');
    }
}
