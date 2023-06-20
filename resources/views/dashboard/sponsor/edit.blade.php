@extends('layouts.admin.master')
@section('title', 'Update Sponsor')

@section('css')

@endsection

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" />
@endsection

@section('breadcrumb-title')
<h3>Update Sponsor</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Sponsors</li>
<li class="breadcrumb-item active">Update Sponsor</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="form theme-form">
                        <form method="POST" id="editSponsorForm" action="{{ route('sponsors.update',$item->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="pb-2 fw-medium">Name</label>
                                        <input class="form-control" name="name" id="name" type="text" value="{{ $item->name }}">
                                        @error('name')
                                        <div class="invalid-tooltip">Please enter name of the sponsor.</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="pb-2 fw-medium">Upload Sponsor File</label>
                                        <input class="form-control" name="image" id="image-file" type="file" aria-label="file example" >
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
                                            <input type="checkbox" id="status" name="status" {{ $item->status == 1 ? 'checked' : '' }}><span class="switch-state"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" value="" id="croppedImage" name="croppedImage" />

                            <div class="row">
                                <div class="col d-flex align-items-center">
                                    <div><button type="submit" class="btn btn-success me-2">Update</a>
                                    </div>
                                    <a class="btn btn-danger" href="{{ route('sponsors.index') }}">Cancel</a>
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
    var redirectURL = "{{route('sponsors.index')}}";
    $(document).ready(function() {
        $("#editSponsorForm").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 10,
                    maxlength: 50,
                }
            },
            submitHandler: function(form) {
                var formData = {
                    _token: "{{ csrf_token() }}",
                    name: $("#name").val(),
                    status: $("#status").val(),
                    croppedImage: $("#croppedImage").val(),
                };

                $.ajax({
                    type: "PUT",
                    url: "{{ route('sponsors.update', $item->id) }}",
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