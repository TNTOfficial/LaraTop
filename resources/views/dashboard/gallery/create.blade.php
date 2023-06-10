@extends('layouts.admin.master')

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css">
@endsection

@section('breadcrumb-title')
<h3> Add Gallery Images</h3>
@endsection

@section('content')
<div class="container">
    <div class="d-flex justify-content-end">
        <a href="{{ route('gallery.index') }}" class="btn btn-primary mb-3" type="button">Back</a>
    </div>
    <form action="{{ route('uploadImage') }}" method="POST" enctype="multipart/form-data" class="dropzone" style="border-radius: 10px; border:none; box-shadow:0px 0px 10px #878787;" id="dropzone">
        @csrf
        <div class="dz-default dz-message">
            <button class="dz-button" type="button" data-bs-original-title="" title="">
                <div class="border border-2 rounded-3 mx-auto d-flex justify-content-center align-items-center" type="button" data-bs-original-title style="width: 150px; aspect-ratio:1/1;">
                    <i class="fa-solid fa-plus fs-1"></i>
                </div>
                <p class="mt-3 pbtn">
                    Drop files here to upload
                </p>
            </button>
        </div>
        <input type="hidden" class="form-control" id="id" required>

    </form>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>

<script>
    Dropzone.options.dropzone = {
        maxFiles: 10,
        maxFilesize: 4,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: false,
        timeout: 50000,
        init: function() {
            var myDropzone = this;


            $.ajax({
                url: "{{ route('gallery.images') }}",
                type: 'POST',
                dataType: 'json',
                success: function(data) {
                    $.each(data, function(key, value) {
                        var file = {
                            name: value.name,
                            size: value.size,
                            alt: value.name
                        };
                        myDropzone.options.addedfile.call(myDropzone, file);
                        myDropzone.options.thumbnail.call(myDropzone, file, value.path);
                        myDropzone.emit("complete", file);
                    });
                }
            });

            myDropzone.on("addedfile", function(file) {
                var nameInput = document.createElement("input");
                nameInput.type = "text";
                nameInput.name = "image_names[]";
                nameInput.placeholder = "Enter image name";
                file.previewElement.appendChild(nameInput);

                nameInput.addEventListener("input", function(event) {
                    file.alt = event.target.value;
                });
            });

            myDropzone.on("sending", function(file, xhr, formData) {
                var nameInput = file.previewElement.querySelector("input[type='text']");
                var imageName = nameInput.value.trim();

                if (imageName !== "") {
                    formData.append("image_names[]", imageName);
                }
            });

            myDropzone.on("success", function(file, response) {
                var nameInput = file.previewElement.querySelector("input[type='text']");
                var newImageName = response.success;

                if (newImageName !== "") {
                    nameInput.value = newImageName;
                    file.alt = newImageName;
                    var olddatadzname = file.previewElement.querySelector("[data-dz-name]");
                    olddatadzname.innerHTML = newImageName;
                }
            });
        }
    };
</script>
@endsection