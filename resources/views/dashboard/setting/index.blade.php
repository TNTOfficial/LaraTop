@extends('layouts.admin.master')
@section('title', 'Add new slide')

@section('css')

@endsection


@section('breadcrumb-title')
<h3>General Settings</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Settings</li>
<li class="breadcrumb-item active">General Settings</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="icon-tab" role="tablist">
                            <li class="nav-item"><a class="nav-link active" id="icon-home-tab" data-bs-toggle="tab" href="#icon-home" role="tab" aria-controls="icon-home" aria-selected="true"><i class="icofont icofont-ui-home"></i>General</a></li>
                            <li class="nav-item"><a class="nav-link" id="profile-icon-tab" data-bs-toggle="tab" href="#profile-icon" role="tab" aria-controls="profile-icon" aria-selected="false"><i class="icofont icofont-man-in-glasses"></i>Social</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" id="contact-icon-tab" data-bs-toggle="tab" href="#contact-icon" role="tab" aria-controls="contact-icon" aria-selected="false"><i class="icofont icofont-contacts"></i>SEO</a></li>
                        </ul>
                        <div class="tab-content" id="icon-tabContent">
                            <div class="tab-pane fade show active" id="icon-home" role="tabpanel" aria-labelledby="icon-home-tab">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form theme-form">
                                                    <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        @foreach($settings as $setting)
                                                        @switch($setting->key)
                                                        @case('about_us_short')
                                                        <div class="form-group">
                                                            <label style="padding-top:30px; padding-left:5px; font-size:20px;" for="about_us_short">About us short description</label>
                                                            <textarea class="form-control" name="about_us_short" id="about_us_short" rows="3">{{ old('about_us_short', $setting->value ?? '') }}</textarea>
                                                        </div>

                                                        @break
                                                        @case('footer_text')
                                                        <div class="form-group">
                                                            <label style="padding-top:30px; padding-left:5px; font-size:20px;" for="footer_text">Footer Text</label>
                                                            <textarea class="form-control" name="footer_text" id="footer_text" rows="3">{{ old('footer_text', $setting->value ?? '') }}</textarea>
                                                        </div>

                                                        @break
                                                        @case('membership_success_response')
                                                        <div class="form-group">
                                                            <label style="padding-top:30px; padding-left:5px; font-size:20px;" for="membership_success_response">Membership Response Text</label>
                                                            <textarea class="form-control" name="membership_success_response" id="membership_success_response" rows="3">{{ old('membership_success_response', $setting->value ?? '') }}</textarea>
                                                        </div>

                                                        @break
                                                        @case('contact_us_success_response')
                                                        <div class="form-group">
                                                            <label style="padding-top:30px; padding-left:5px; font-size:20px;" for="contact_us_success_response">Contact Us Response Text</label>
                                                            <textarea class="form-control" name="contact_us_success_response" id="contact_us_success_response" rows="3">{{ old('contact_us_success_response', $setting->value ?? '') }}</textarea>
                                                        </div>

                                                        @break
                                                        @case('address')
                                                        <div class="form-group">
                                                            <label style="padding-top:30px; padding-left:5px; font-size:20px;" for="address">Address</label>
                                                            <textarea class="form-control" name="address" id="address" rows="3">{{ old('address', $setting->value ?? '') }}</textarea>
                                                        </div>
                                                        @break
                                                        @case('phone1')
                                                        <div class="form-group">
                                                            <label style="padding-top:30px; padding-left:5px; font-size:20px;" for="phone1">Mobile 1</label>

                                                            <input type="number" id="phone1" class="form-control" name="phone1" value="{{ old('phone1', $setting->value ?? '') }}" />
                                                        </div>
                                                        @break
                                                        @case('phone2')
                                                        <div class="form-group">
                                                            <label style="padding-top:30px; padding-left:5px; font-size:20px;" for="phone2">Mobile 2</label>

                                                            <input type="number" id="phone2" class="form-control" name="phone2" value="{{ old('phone2', $setting->value ?? '') }}" />
                                                        </div>
                                                        @break
                                                        @case('about_us')
                                                        <div class="form-group">
                                                            <label style="padding-top:30px; padding-left:5px; font-size:20px;" for="about_us">About us</label>
                                                            <textarea class="form-control" name="about_us" id="about_us" rows="3">{{ old('about_us', $setting->value ?? '') }}</textarea>
                                                        </div>
                                                        @break


                                                        @case('site_name')
                                                        <div class="form-group">
                                                            <label style="padding-top:30px; padding-left:5px; font-size:20px;" for="site_name">Site Name</label>
                                                            <input type="text" class="form-control" id="site_name" name="site_name" value="{{ old('site_name', $setting->value ?? '') }}">
                                                        </div>
                                                        @break
                                                        @case('site_title')
                                                        <div class="form-group">
                                                            <label style="padding-top:30px; padding-left:5px; font-size:20px;" for="site_title">Site Title</label>
                                                            <input type="text" class="form-control" id="site_title" name="site_title" value="{{ old('site_title', $setting->value ?? '') }}">
                                                        </div>
                                                        @break
                                                        @case('admin_email')
                                                        <div class="form-group">
                                                            <label style="padding-top:30px; padding-left:5px; font-size:20px;" for="site_email">Admin Email</label>
                                                            <input type="email" class="form-control" id="admin_email" name="admin_email" value="{{ old('admin_email', $setting->value ?? '') }}">
                                                        </div>
                                                        @break
                                                        @case('foot_copyright_text')
                                                        <div class="form-group">
                                                            <label style="padding-top:30px; padding-left:5px; font-size:20px;" for="foot_copyright_text">Footer Copyright
                                                                Text</label>
                                                            <input type="text" class="form-control" id="foot_copyright_text" name="foot_copyright_text" value="{{ old('foot_copyright_text', $setting->value ?? '') }}">
                                                        </div>
                                                        @break
                                                        @endswitch
                                                        @endforeach
                                                        <button type="submit" class="btn btn-primary">Save
                                                            Settings</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile-icon" role="tabpanel" aria-labelledby="profile-icon-tab">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form theme-form">
                                                    <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        @foreach($settings as $setting)
                                                        @switch($setting->key)
                                                        @case('social_facebook')
                                                        <div class="form-group">
                                                            <label style="padding-top:30px; padding-left:5px; font-size:20px;" for="social_facebook">Facebook</label>
                                                            <input type="text" class="form-control" id="social_facebook" name="social_facebook" value="{{ old('social_facebook', $setting->value ?? '') }}">
                                                        </div>
                                                        @break
                                                        @case('social_twitter')
                                                        <div class="form-group">
                                                            <label style="padding-top:30px; padding-left:5px; font-size:20px;" for="social_twitter">Twitter</label>
                                                            <input type="text" class="form-control" id="social_twitter" name="social_twitter" value="{{ old('social_twitter', $setting->value ?? '') }}">
                                                        </div>
                                                        @break
                                                        @case('social_instagram')
                                                        <div class="form-group">
                                                            <label style="padding-top:30px; padding-left:5px; font-size:20px;" for="social_instagram">Instagram</label>
                                                            <input type="text" class="form-control" id="social_instagram" name="social_instagram" value="{{ old('social_instagram', $setting->value ?? '') }}">
                                                        </div>
                                                        @break
                                                        @case('social_linkdin')
                                                        <div class="form-group">
                                                            <label style="padding-top:30px; padding-left:5px; font-size:20px;" for="social_linkdin">LinkedIn</label>
                                                            <input type="text" class="form-control" id="social_linkdin" name="social_linkdin" value="{{ old('social_linkdin', $setting->value ?? '') }}">
                                                        </div>
                                                        @break
                                                        @endswitch
                                                        @endforeach
                                                        <button type="submit" class="btn btn-primary mt-3">Save
                                                            Settings</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="contact-icon" role="tabpanel" aria-labelledby="contact-icon-tab">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form theme-form">
                                                    <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        @foreach($settings as $setting)
                                                        @switch($setting->key)
                                                        @case('google_analytics')
                                                        <div class="form-group">
                                                            <label style="padding-top:30px; padding-left:5px; font-size:20px;" for="google_analytics">Google
                                                                Analytics</label>
                                                            <input type="text" class="form-control" id="google_analytics" name="google_analytics" value="{{ old('google_analytics', $setting->value ?? '') }}">
                                                        </div>
                                                        @break
                                                        @case('seo_meta_title')
                                                        <div class="form-group">
                                                            <label style="padding-top:30px; padding-left:5px; font-size:20px;" for="seo_meta_title">SEO Meta Title</label>
                                                            <input type="text" class="form-control" id="seo_meta_title" name="seo_meta_title" value="{{ old('seo_meta_title', $setting->value ?? '') }}">
                                                        </div>
                                                        @break
                                                        @case('seo_meta_description')
                                                        <div class="form-group">
                                                            <label style="padding-top:30px; padding-left:5px; font-size:20px;" for="seo_meta_description">SEO Meta
                                                                Description</label>
                                                            <input type="text" class="form-control" id="seo_meta_description" name="seo_meta_description" value="{{ old('seo_meta_description', $setting->value ?? '') }}">
                                                        </div>
                                                        @break
                                                        @endswitch
                                                        @endforeach
                                                        <button type="submit" class="btn btn-primary">Save
                                                            Settings</button>
                                                    </form>
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
    </div>

</div>

<!-- modal -->
@endsection
@section('script')
@section('script')
<script src="{{ asset('assets/js/dropzone/dropzone-script.js') }}"></script>
<script src="{{ asset('assets/js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#about_us_short'
    });

    tinymce.init({
        selector: '#about_us'
    });
</script>
@endsection