@extends('layouts.admin.master')
@section('title', 'Add new slide')

@section('css')

@endsection

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" />
@endsection

@section('breadcrumb-title')
<h3>Add New Sponsor</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Sponsor</li>
<li class="breadcrumb-item active">Add New Sponsor</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="form theme-form">
                        <form method="POST" id="sponsorForm" action="{{ route('sponsors.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label>Name</label>
                                        <input class="form-control" name="name" id="name" type="text">
                                        @error('name')
                                        <div class="invalid-tooltip">Please enter the name of Sponsor</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label>Upload Sponsor file</label>
                                        <input class="form-control" id="image-file" name="image" type="file" aria-label="file example" required="">
                                    </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <img id="preview-image" class="rounded-3" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif" alt="preview image" style="max-height: 250px;">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="switch">
                                            <input type="checkbox" name="status" checked=""><span class="switch-state"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="croppedImage" name="croppedImage" />
                            <div class="row">
                                <div class="col d-flex justify-content-start align-items-start">
                                    <div><button type="submit" class="btn btn-success me-3">Add</a>
                                    </div>
                                    <a class="btn btn-danger me-3" href="{{route('sponsors.index')}}">Cancel</a>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('components.cropper', ['imageId' => 'image', 'aspect_ratio' => '1'])

@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
@stack('scripts')
<script>
    $(document).ready(function() {
        $("#sponsorForm").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 2,
                    maxlength: 50,
                }
            }
        });
    });
</script>
@endsection