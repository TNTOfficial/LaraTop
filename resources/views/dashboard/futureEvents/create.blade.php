@extends('layouts.admin.master')
@section('css')

@endsection

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" />
@endsection

@section('breadcrumb-title')
<h3>Add New Event</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">future Events</li>
<li class="breadcrumb-item active">Add new Event</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="form theme-form">
                        <form method="POST" id="liteForm" action="{{ route('futureEvents.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="pb-2 fw-medium">Title</label>
                                        <input class="form-control" name="title" type="text" id="title">
                                        @error('title')
                                        <div class="invalid-tooltip">Please enter the name of the Event.</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="pb-2 fw-medium">Sub Title</label>
                                        <input class="form-control" name="sub_title" type="text" id="sub_title">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="pb-2 fw-medium">Description</label>
                                        <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="pb-2 fw-medium">Upload Event file</label>
                                        <input class="form-control" id="image-file" name="image" type="file" aria-label="file example" required="">
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <img id="preview-image" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif" alt="preview image" style="max-height: 250px;">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row g-3">
                                <div class="d-flex align-items-center">
                                    <label class="col-form-label text-sm-end pe-3 pb-2 fw-medium">Event Date</label>
                                </div>
                                <input class="datepicker-here form-control w-25" type="date" data-language="en" id="event_date" name="event_date"> <br>
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
                                <div class="col d-flex align-items-center">
                                    <div><button type="submit" class="btn btn-success me-2">Add</a>
                                    </div>
                                    <a class="btn btn-danger" href="{{route('futureEvents.index')}}">Cancel</a>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('components.cropper', ['imageId' => 'image','aspect_ratio'=>'2/1'])

@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>

@stack('scripts')
<script>
    $(document).ready(function() {
        $("#liteForm").validate({
            rules: {
                title: {
                    required: true,
                    maxlength: 100
                },
                sub_title: {
                    required: true,
                    maxlength: 100
                },
                description: {
                    required: true,
                },
                event_date: {
                    required: true
                }
            }
        });
    });
</script>
@endsection