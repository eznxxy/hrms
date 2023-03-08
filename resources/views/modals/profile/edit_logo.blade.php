<div class="modal fade" id="imageCropperModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <img src="" class="img" id="srcImage" style="max-width: 100%;">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="btnClose" data-dismiss="modal">Close</button>
                <button type="button" id="btnSave" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
    jQuery(function() {
        var imageCropper = null;
        var formData = new FormData();

        $('#btnClose').click(() => {
            $('#selectLogo').val('');
        });

        var updateLogo = function(blob) {
            var urlCreator = window.URL || window.webkitURL;
            var imageUrl = urlCreator.createObjectURL(blob);
            $('#previewLogo').attr('src', imageUrl);

            formData.set('logo', blob, 'image.jpg');

            $.ajax({
                method: 'POST',
                url: "{{ route('ajax.profiles.update_logo', 1) }}",
                processData: false,
                contentType: false,
                data: formData,
                beforeSend: function() {
                    $('#btnSave').prop('disabled', true);
                    $('#btnSave').addClass('btn-progress');
                },
                success: function(response) {
                    swal({
                        title: "Success!",
                        text: response.message,
                        icon: "success",
                    }).then(() => {
                        $('#btnSave').removeClass('btn-progress');
                        $('#btnSave').prop('disabled', false);

                        $('#imageCropperModal').modal('hide');
                        location.reload();
                    });
                },
                error: function(xhr) {
                    $('#btnSave').removeClass('btn-progress');
                    $('#btnSave').prop('disabled', false);

                    ResponseHelper.handle(xhr);
                }
            });
        }

        $('#selectLogo').on('change', function() {
            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = e => {
                    $('#srcImage').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);

            }

            $('#imageCropperModal').modal({
                backdrop: 'static',
                keyboard: false
            });

            $('#imageCropperModal').on('shown.bs.modal', function() {
                $('#srcImage').ready(function() {
                    imageCropper && imageCropper.destroy();
                    imageCropper = new Cropper($('#srcImage')[0], {
                        viewMode: 0,
                        zoomable: false,
                        minCropBoxHeight: 100,
                        aspectRatio: 1 / 1
                    });
                });
            })

            $('#btnSave').on('click', function() {
                swal({
                        title: 'Update Logo',
                        text: 'Are you sure want to update this logo?',
                        icon: 'warning',
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((update) => {
                        if (update) {
                            if (imageCropper) {
                                imageCropper.getCroppedCanvas({
                                    minWidth: 100,
                                    minHeight: 100,
                                    maxWidth: 4096,
                                    maxHeight: 4096,
                                    imageSmoothingEnabled: false,
                                    imageSmoothingQuality: 'high'
                                }).toBlob(blob => {
                                    updateLogo(blob);
                                }, 'image/jpeg');
                            }
                        }
                    });
            });
        });
    });
</script>
@endpush