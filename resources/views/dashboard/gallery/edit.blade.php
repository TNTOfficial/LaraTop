@extends('layouts.admin.master')

@section('css')

@endsection

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" />
@endsection

@section('breadcrumb-title')
<h3>Update Gallery</h3>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="form theme-form">
                        <form method="POST" action="{{ route('gallery.update',$item->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label>Name</label>
                                        <input class="form-control" name="name" id="name" type="text" value="{{ $item->name }}">
                                        @error('name')
                                        <div class="invalid-tooltip">Please enter name of the gallery.</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        @if($item->image)
                                        <img id="preview-image" src="{{ asset('storage/gallery/' . $item->image) }}" alt="preview image" style="max-height: 250px;">
                                        @endif

                                    </div>
                                </div>
                                <input type="hidden" id="croppedImage" name="croppedImage" />
                                <div class="row">
                                    <div class="col d-flex align-items-center">
                                        <div>
                                            <button class="btn btn-primary me-2" id="crop1">Crop</button>
                                            <button type="submit" class="btn btn-success me-2">Update</button>
                                        </div>
                                        <a class="btn btn-danger" href="{{route('gallery.index')}}">Cancel</a>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="img-container">
                    <div class="row justify-content-center g-0">
                        <div class="col-md-12">
                            <img id="image" class="w-100" src="https://avatars0.githubusercontent.com/u/3456749">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer p-md-2 p-1">
                <button type="button" class="btn btn-secondary" id="modalCancel">Cancel</button>
                <button type="button" class="btn btn-primary" id="crop">Crop</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script src="{{ asset('assets/js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
<script>
    var image = document.getElementById('image');
    $modal = $("#modal");
    var cropper;
    $(document).ready(function(e) {
        $('#crop1').click(function(e) {
            e.preventDefault();
            $('#image').attr('src', $('#preview-image').attr('src'));
            $modal.modal('show');
        });

        $modal.on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                aspectRatio: 2 / 1,
                viewMode: 3,
                preview: '.preview'
            });
        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });

        $("#modalCancel").click(function() {
            $('#image-file').val('');
            $modal.modal('hide');
        });

        $("#crop").click(function() {
            canvas = cropper.getCroppedCanvas();

            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    $('#preview-image').attr('src', reader.result);
                    $('#croppedImage').val(reader.result);
                    $modal.modal('hide');
                }
            });
        });

    });
</script>
@endsection