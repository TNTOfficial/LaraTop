@extends('layouts.admin.master')

@section('content')
<div class="content-wrapper">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ $role->name }}</h4>
                <h5>Permissions:</h5>
                <ul>
                    @foreach($role->permissions as $permission)
                    <li>{{ $permission->name }}</li>
                    @endforeach
                </ul>
                <div>
                    <h5>Assign Role to User:</h5>
                    <form action="{{ route('roles.assign', ['role' => $role->id]) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <select name="user_id" class="form-control">
                                <option selected disabled>Select User</option>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Assign Role</button>
                    </form>
                </div>
                <div>
                    <h5>Remove Role from User:</h5>
                    <form action="{{ route('roles.remove', ['role' => $role->id]) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <select name="user_id" class="form-control">
                                <option selected disabled>Select User</option>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-danger">Remove Role</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection