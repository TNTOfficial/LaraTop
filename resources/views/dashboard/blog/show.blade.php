@extends('layouts.admin.master')
@section('title', 'Email Application')

@section('content')
<div class="container-fluid">
    <div class="email-wrap">
        <div class="row justify-content-around">
            <div class="col-lg-8 pl-0">
                <div class="email-right-aside">
                    <div class="email-body radius-left">
                        <div class="ps-0">
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="pills-darkprofile" role="tabpanel" aria-labelledby="pills-darkprofile-tab">
                                    <div class="email-content">
                                        <div class="email-top">
                                            <div class="row">
                                                <div class="col-md-6 xl-100 col-sm-12">
                                                    <div class="media"><img class="me-3 rounded-circle" src="{{ asset('assets/images/user/user.png') }}" alt="">
                                                        <div class="media-body ">
                                                            <h6 class="fw-bold fs-4">{{ $blog->title }} </h6>
                                                            <div class="ms-auto">
                                                                <img src="{{ asset('/storage/' . $blog->img) }}" alt="profile" class="rounded w-100 my-3">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 xl-100 col-sm-12">
                                                    <div class="d-flex justify-content-end align-items-center mt-4">
                                                        <button class="btn btn-primary">
                                                            <a href="{{route('blogs.index')}}" class="text-white text-decoration-none"><i class="fa-solid fa-circle-left"></i> Back</a>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="email-wrapper">
                                            <p>{{ $blog->content }}</p>
                                        </div>
                                    </div>
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