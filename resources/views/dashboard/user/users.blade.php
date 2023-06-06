@extends('layouts.admin.master')

@section('content')
<div class="content-wrapper">
    <div class="col-lg-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center ">
                    <h4 class="card-title fw-bold fs-5">Users</h4>
                    <div class="ms-auto">
                        <a href="{{ route('users.pdf') }}" class="btn btn-primary mb-3">Download PDF</a>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center ">
                            <th class="py-3 fw-bold fs-6"> Sr .no</th>
                            <th class="py-3 fw-bold fs-6"> Name </th>
                            <th class="py-3 fw-bold fs-6">Email </th>
                            <th class="py-3 fw-bold fs-6"> Position </th>
                            <th class="py-3 fw-bold fs-6"> Amount </th>
                            <th class="py-3 fw-bold fs-6"> Deadline </th>
                            <th class="py-3 fw-bold fs-6">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @can('User access')
                        @foreach($Users as $user)
                        <tr class="text-center">
                            <td> {{$loop->iteration}}</td>
                            <td> {{$user->name}} </td>
                            <td>{{$user->email}}</td>
                            <td> Photoshop </td>
                            <td> $ 77.99 </td>
                            <td> May 15, 2015 </td>
                            <td>
                                <ul class="action d-flex align-items-center list-unstyled justify-content-center">
                                    @can('User edit')
                                    <li class="edit"> <a href="{{ route('users.view', $user->id)}}">
                                            <i class="fa-solid fa-user fs-4 pe-2 mt-1"></i></a></li>
                                    @endcan
                                    <li class="edit">
                                        <a href="{{ route('users.roles', $user->id)}}">
                                            <i class="fa-solid fa-eye fs-4 pe-2 mt-1"></i>
                                        </a>
                                    </li>
                                    @can('User delete')
                                    <form action="{{route('users.delete', $user->id)}}" onsubmit="confirmDelete(e)" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="border-0 bg-transparent">
                                            <i class="fa-solid fa-trash-can fs-4" style="color:#54ba4a"></i></button>
                                    </form>
                                    @endcan
                                </ul>
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