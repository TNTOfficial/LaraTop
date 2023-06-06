@extends('layouts.admin.master')
@section('title', 'Add new slide')


@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" />
@endsection

@section('breadcrumb-title')
<h3>Update Slide</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Slider</li>
<li class="breadcrumb-item active">Update slide</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="form theme-form">
                        <form method="POST" id="editSlideForm" action="{{ route('slides.update',$item->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="pb-2 fw-medium">Title</label>
                                        <input class="form-control" name="title" id="title" type="text" value="{{ $item->title }}">
                                        @error('title')
                                        <div class="invalid-tooltip">Please enter title of the slide.</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="pb-2 fw-medium">Sub title</label>
                                        <input class="form-control" name="sub_title" id="sub_title" type="text" value="{{ $item->sub_title }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="pb-2 fw-medium">Upload slide file</label>
                                        <input class="form-control" name="image" id="image-file" type="file" aria-label="file example" required="">
                                    </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <img id="preview-image" class="rounded-3" src="{{ asset('/storage/' . $item->img) }}" alt="preview image" style="max-height: 250px;">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="switch">
                                            <input type="checkbox" name="status" {{ $item->status == 1 ? 'checked' : '' }}><span class="switch-state"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" value="" id="croppedImage" name="croppedImage" />

                            <div class="row">
                                <div class="col d-flex align-items-center">
                                    <div><button type="submit" class="btn btn-success me-2">Update</a>
                                    </div>
                                    <a class="btn btn-danger" href="{{ route('slides.index') }}">Cancel</a>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('components.cropper', ['imageId' => 'image', 'aspect_ratio' => '2/1'])

@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
@stack('scripts')
<script>
    $(document).ready(function() {
        $("#editSlideForm").validate({
            rules: {
                title: {
                    required: true,
                    minlength: 10,
                    maxlength: 50,
                },
                sub_title: {
                    required: true
                },
                image: {
                    required: true
                }
            }
        });
    });
</script>
@endsection