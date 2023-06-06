@props(['imageId','aspect_ratio'])

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
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
<script>
    var image = document.getElementById('{{ $imageId }}');
    var $modal = $("#modal");
    var cropper;

    $(document).ready(function(e) {
        $('#image-file').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                if (cropper != null) {
                    cropper.destroy();
                    cropper = null;
                }
                $(image).attr('src', e.target.result);
                $modal.modal('show');
            }

            reader.readAsDataURL(this.files[0]);
        });

        $modal.on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                aspectRatio: '{{$aspect_ratio}}',
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
            cropper.getCroppedCanvas().toBlob((blob) => {
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
@endpush