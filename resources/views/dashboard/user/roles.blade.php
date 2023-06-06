@extends('layouts.admin.master')

@section('content')
<div class="content-wrapper">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title fs-3 fw-bold">Roles</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th class=" py-3 fw-bold w-100">Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form method="POST" action="{{ route('userRoles.save') }}" enctype="multipart/form-data">
                            @csrf
                            @foreach($roles as $role)
                            <tr>
                                <td class="py-3 fw-bold">{{ $role->name }}</td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="role{{ $role->id }}" name="roles[]" value="{{ $role->id }}" {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="role{{ $role->id }}"></label>
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                            <input type="hidden" name="user_id" value="{{ $id }}">
                           <div class="text-end">
                           <button type="submit" class="btn btn-primary mx-2">Submit</button>
                            <a class="btn btn-danger me-3" href="{{ route('users') }}">Cancel</a>
                           </div>
                        </form>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection