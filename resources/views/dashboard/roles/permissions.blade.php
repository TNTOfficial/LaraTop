@extends('layouts.admin.master')

@section('content')
<div class="content-wrapper">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create Permission</h4>
                <form method="POST" action="{{ route('permissions.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="{{ route('permissions.index') }}" class="btn btn-danger" type="button">Back</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection