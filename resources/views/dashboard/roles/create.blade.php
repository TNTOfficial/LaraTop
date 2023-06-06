<!-- dashboard/roles/create.blade.php -->

@extends('layouts.admin.master')

@section('content')
<div class="content-wrapper">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('roles.store') }}">
                    @csrf
                    <div class="form-group">
                        <label class="fw-medium" for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label class="fw-medium pb-3" for="permissions">Permissions</label>
                        <div class="checkbox justify-content-start d-flex flex-wrap">
                            <div class="row">
                                @foreach($permissions as $permission)
                                <div class="col-lg-4 col-md-6">
                                    <label class="checkbox-inline mx-2 fw-medium fs-6 py-1">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"> {{ $permission->name }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="{{route('roles.index')}}" class="btn btn-danger" type="button">Back</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection