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
                                                        <div class="media-body">
                                                            <h6>{{ $email->name }} </h6>
                                                            <p>{{ $email->subject }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12 xl-100">
                                                    <div class="float-end d-flex">
                                                        <p class="user-emailid">{{ $email->email }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="email-wrapper">
                                            <p>{{ $email->message }}</p>
                                        </div>
                                        <button class="mark-as-read-btn btn btn-primary" data-email-id="{{ $email->id }}">{{ $email->mark_as_read == 0 ? "Mark as read" : "Mark as unread"}}</button>
                                        <button class="btn btn-primary">
                                            <a href="{{route('emails.index')}}" class="text-white"><i class="fa-solid fa-circle-left"></i> Back</a>
                                        </button>

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
<script>
    $(document).ready(function() {
        $('.mark-as-read-btn').click(function(e) {
            e.preventDefault();

            var emailId = $(this).data('email-id');
            var currentElement= $(this);
            $.ajax({
                url: '/admin/emails/' + emailId + '/mark-as-read',
                type: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.result) {
                        currentElement.html("Mark as unread");
                    }else{
                         currentElement.html("Mark as read");
                    }

                },
                error: function(xhr) {
                    console.log(xhr.responseText);

                }
            });
        });
    });
</script>

@endsection