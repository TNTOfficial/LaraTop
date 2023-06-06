<!-- dashboard/roles/index.blade.php -->

@extends('layouts.admin.master')

@section('content')
<div class="content-wrapper">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <h4 class="card-title m-0 fw-bold fs-4">Roles</h4>
                    <a href="{{ route('roles.create') }}" class="btn btn-primary mb-3 ms-auto">Create Role</a>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr class="text-center">
                            <th class="fw-bold fs-5 py-2">Name</th>
                            <th class="fw-bold fs-5 py-2">Permissions</th>
                            <!-- <th>Users</th> -->
                            <th class="fw-bold fs-5 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @can('Role access')
                        @foreach($roles as $role)
                        <tr class="text-center">
                            <td>{{ $role->name }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn border-0 dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        Permissions
                                    </button>
                                    <ul class="dropdown-menu overflow-auto" style="height:400px" aria-labelledby="dropdownMenuButton1">
                                        @foreach($role->permissions as $permission)
                                        <li class="dropdown-item text-dark">{{ $permission->name }}</li><br>
                                        @endforeach

                                    </ul>
                                </div>
                            </td>
                            <!-- <td>
                                @foreach($role->users as $user)
                                {{ $user->name }}<br>
                                @endforeach
                            </td> -->
                            <td>
                                <!-- <a href="{{ route('roles.show', $role->id) }}" class="btn btn-info">View</a> -->
                                @can('Role edit')
                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary">Edit</a>
                                @endcan
                                @can('Role delete')
                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this role?')">Delete</button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                        @endcan
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection