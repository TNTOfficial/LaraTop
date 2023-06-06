@extends('layouts.admin.master')
@section('title', 'Update Testimonial')


@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" />
@endsection

@section('breadcrumb-title')
<h3>Update Testimonial</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Testimonial</li>
<li class="breadcrumb-item active">Update Testimonial</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="form theme-form">
                        <form method="POST" id="editTestForm" action="{{ route('testimonials.update', $item->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label>Name</label>
                                        <input class="form-control" name="name" id="name" type="text" value="{{ $item->name }}">
                                        @error('title')
                                        <div class="invalid-tooltip">Please enter name of the testimonial.</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label>Designation</label>
                                        <input class="form-control" name="designation" id="designation" type="text" value="{{ $item->designation }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label>Message</label>
                                        <textarea class="form-control" name="message" id="message" rows="3">{{ $item->message }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label>Upload Testimonial file</label>
                                        <input class="form-control" name="image" id="image-file" type="file" aria-label="file example" required="">

                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <img id="preview-image" src="{{ asset('/storage/' . $item->img) }}" alt="preview image" style="max-height: 250px;">
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" id="croppedImage" name="croppedImage" />
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="switch">
                                            <input type="checkbox" name="status" {{ $item->status == 1 ? 'checked' : '' }}><span class="switch-state"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col d-flex">
                                    <div><button type="submit" class="btn btn-success me-2">Add</a>
                                    </div>
                                    <a class="btn btn-danger" href="{{ route('testimonials.index') }}">Cancel</a>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('components.cropper', ['imageId' => 'image'])
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
@stack('scripts')
<script>
    $(document).ready(function() {
        $("#editTestForm").validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 100
                },
                designation: {
                    required: true,
                },
                message: {
                    required: true,
                    minlength: 20,
                }
            }
        });
    });
</script>
@endsection