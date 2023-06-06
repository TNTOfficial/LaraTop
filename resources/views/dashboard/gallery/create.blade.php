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
        <a href="{{route('gallery.index')}}" class="btn btn-primary mb-3" type="button">Back</a>
    </div>
    <form action="uploadImage" method="POST" enctype="multipart/form-data" class="dropzone" style="border-radius: 10px; border:none; box-shadow:0px 0px 10px #878787;" id="dropzone">
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
        @csrf
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
            // Get images
            var myDropzone = this;
            $.ajax({
                url: gallery,
                type: 'POST',
                dataType: 'json',
                success: function(data) {
                    $.each(data, function(key, value) {
                        var file = {
                            name: value.name,
                            size: value.size
                        };
                        myDropzone.options.addedfile.call(myDropzone, file);
                        myDropzone.options.thumbnail.call(myDropzone, file, value.path);
                        myDropzone.emit("complete", file);
                    });
                }
            });
        },
        removedfile: function(file) {
            if (this.options.dictRemoveFile) {
                return Dropzone.confirm("Are You Sure to " + this.options.dictRemoveFile, function() {
                    if (file.previewElement.id != "") {
                        var name = file.previewElement.id;
                    } else {
                        var name = file.name;
                    }
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST',
                        url: delete_url,
                        data: {
                            filename: name
                        },
                        success: function(data) {
                            alert(data.success + " File has been successfully removed!");
                        },
                        error: function(e) {
                            console.log(e);
                        }
                    });
                    var fileRef;
                    return (fileRef = file.previewElement) != null ?
                        fileRef.parentNode.removeChild(file.previewElement) : void 0;
                });
            }
        },
        success: function(file, response) {
            file.previewElement.id = response.success;
            var olddatadzname = file.previewElement.querySelector("[data-dz-name]");
            file.previewElement.querySelector("img").alt = response.success;
            olddatadzname.innerHTML = response.success;
        },
        error: function(file, response) {
            if ($.type(response) === "string")
                var message = response;
            else
                var message = response.message;
            file.previewElement.classList.add("dz-error");
            _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
            _results = [];
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                node = _ref[_i];
                _results.push(node.textContent = message);
            }
            return _results;
        }
    };
</script>
<style>
    .pbtn {
        padding: 10px;
        border-radius: 5px;
        background-color: #7366ff;
        color: white;
    }
</style>
@endsection