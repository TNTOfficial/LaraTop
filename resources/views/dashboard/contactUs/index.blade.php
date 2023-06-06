@extends('layouts.admin.master')
@section('title', 'Email Messages')



@section('breadcrumb-title')
<h3>Email Messages</h3>
@endsection

@section('content')
<div class="container-fluid">
    <div class="email-wrap">
        <div class="row">
            <div class="box-col-12">
                <div class="email-right-aside">
                    <div class="card email-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="pe-0 b-r-light"></div>
                                <div class="email-top">
                                    <div class="row">
                                        <div class="col ps-2 ps-md-4 text-center text-md-start">
                                            <h5>Inbox</h5>
                                        </div>
                                    </div>
                                </div>
                                <table class="w-100">
                                    <thead>
                                        <tr class="border-bottom-primary text-center">
                                            <th class="py-3">Sr.No.</th>
                                            <th class="py-3">Name</th>
                                            <th class="py-3">Email</th>
                                            <th class="py-3">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($emails as $email)
                                        <tr class="border-bottom-secondary text-center">
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td class="py-3">{{$email->name }}</td>
                                            <td class="py-3">{{ $email->email }}</td>
                                            <td class="py-3">
                                                <ul class="action d-flex align-items-center justify-content-center list-unstyled">
                                                    <button class="btn btn-primary text-white rounded">
                                                        <a href="{{ route('emails.show', ['id' => $email->id]) }}" class="text-white">View</a>
                                                    </button>
                                                    <form action="{{ route('emails.delete',$email->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger text-white rounded mx-2">
                                                            <a href="#" class="text-white">Delete</a>
                                                        </button>
                                                    </form>
                                                </ul>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/js/email-app.js')}}"></script>
@endsection