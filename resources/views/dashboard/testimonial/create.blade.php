@extends('layouts.admin.master')
@section('title', 'Add new Testimonial')


@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" />
@endsection

@section('breadcrumb-title')
<h3>Add New Testimonial</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Testimonial</li>
<li class="breadcrumb-item active">Add new Testimonial</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="form theme-form">
                        <form method="POST" id="testForm" action="{{ route('testimonials.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label>Name</label>
                                        <input class="form-control" name="name" type="text" id="name">
                                        @error('name')
                                        <div class="invalid-tooltip">Please enter the name of the Testimonial.</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label>Designation</label>
                                        <input class="form-control" name="designation" type="text" id="designation">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label>Message</label>
                                        <textarea class="form-control" name="message" id="message" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label>Upload Testimonial file</label>
                                        <input class="form-control" id="image-file" name="image" type="file" aria-label="file example" required="">
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <img id="preview-image" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif" alt="preview image" style="max-height: 250px;">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="switch">
                                            <input type="checkbox" id="status" name="status" checked=""><span class="switch-state"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="croppedImage" name="croppedImage" />
                            <div class="row">
                                <div class="col d-flex">
                                    <div><button type="submit" class="btn btn-success me-2">Add</a>
                                    </div>
                                    <a class="btn btn-danger" href="{{route('testimonials.index')}}">Cancel</a>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- modal -->

@include('components.cropper', ['imageId' => 'image', 'aspect_ratio' => '1/2'])

@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
@stack('scripts')
<script>
    var redirectURL = "{{route('testimonials.index')}}";
    $(document).ready(function() {
        $("#testForm").validate({
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
            },
            submitHandler: function(form) {
                var formData = {
                    _token: "{{ csrf_token() }}",
                    name: $("#name").val(),
                    designation: $("#designation").val(),
                    message: $("#message").val(),
                    status: $("#status").val(),
                    croppedImage: $("#croppedImage").val(),
                };

                $.ajax({
                    type: "POST",
                    url: "{{ route('testimonials.store') }}",
                    data: formData,
                    dataType: "json",
                    encode: true,
                }).done(function(data) {
                    if (data.result == 'success') {
                        window.location = redirectURL;
                    }
                });

                event.preventDefault();
            }
        });
    });
</script>
@endsection