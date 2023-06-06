@extends('layouts.admin.master')
@section('content')
<section>
    <div class="bg-white rounded my-5">
        <div class="profile_page">
            <div class="row justify-content-center align-items-center w-100">
                <div class="col-lg-4 mx-auto">
                    <div class="user_profile text-center">
                        <img src="{{asset('assets/images/faces/face1.jpg')}}" alt="" class="rounded-circle mb-3" />
                        <h4>{{$user->name}}</h4>
                    </div>
                </div>
                <div class="col-lg-8">
                    <form class="py-5">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <lable for="fname"><b>Email</b></lable>
                                    <input type="text" name="fname" id="fname" class="form-control rounded my-2" readOnly="" value="test@gmail.com" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <lable for="fname"><b>Date of birth</b></lable>
                                    <input type="text" name="fname" id="fname" class="form-control rounded my-2" readOnly="" value="07/07/1995" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <lable for="fname"><b>Location</b></lable>
                                    <input type="text" name="fname" id="fname" class="form-control rounded my-2" readOnly="" value="383 Bukit Timah Road #01-02 Alocassia" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <lable for="fname"><b>Contact us</b></lable>
                                    <input type="text" name="fname" id="" class="form-control rounded my-2" readOnly="" value="+91 0987654321" />
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <hr>
        <div class="d-flex justify-content-around align-items-center">
            <p> 25869
                Follower</p>
            <p>
                659887
                Following
            </p>

        </div>
    </div>
</section>
@endsection