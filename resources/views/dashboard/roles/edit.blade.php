@extends('layouts.admin.master')

@section('content')
<div class="content-wrapper">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Role</h4>
                <form method="POST" action="{{ route('roles.update', $role->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $role->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="permissions">Permissions</label>
                        <div class="checkbox">
                            @foreach($permissions as $permission)
                            <label class="checkbox-inline">
                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}> {{ $permission->name }}
                            </label>
                            @endforeach
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{route('roles.index')}}" class="btn btn-danger" type="button">Back</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection