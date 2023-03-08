<div class="modal fade" id="addFamily" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Family Member</h5>
                <button type="button" class="close" data-dismiss="modal" onclick="familyForm.reset();"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="familyForm">
                    <div class="form-group">
                        <label>Name (Husband / Wife) <span class="text-danger"><strong>*</strong></span></label>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="First name" name="first_name"
                                    required>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Last name" name="last_name"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Date of Birth <span class="text-danger"><strong>*</strong></span></label>
                        <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                        <input type="date" class="form-control" name="date_of_birth" required>
                    </div>
                    <div class="form-group">
                        <label>Job <span class="text-danger"><strong>*</strong></span></label>
                        <input type="text" class="form-control" name="job" required>
                    </div>
                    <div class="form-group">
                        <label>Address <span class="text-danger"><strong>*</strong></span></label>
                        <textarea type="text" class="form-control" placeholder="Jl Dukuh Kupang Brt 31, Jawa Timur" name="address" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Number of children <span class="text-danger"><strong>*</strong></span></label>
                        <input type="number" class="form-control" name="number_of_children" required>
                    </div>
                    <div class="form-group">
                        <label>Phone Number <span class="text-danger"><strong>*</strong></span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-phone"></i>
                                </div>
                            </div>
                            <input type="number" class="form-control phone-number" name="phone" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="familyForm.reset();"
                    data-dismiss="modal">Close</button>
                <button type="button" id="btnSubmitFamily" class="btn btn-primary">Submit Family</button>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        $("#btnAddFamily").click(function() {
            $('#addFamily').modal({
                backdrop: 'static',
                keyboard: false
            });
        });

        $("#btnSubmitFamily").click(function() {
            var formArray = $('#familyForm :not(.not_included)').serializeArray();
            dataObj = {};

            $(formArray).each(function(i, field) {
                dataObj[field.name] = field.value;
            });

            $.ajax({
                method: 'POST',
                url: "{{ route('ajax.families.store') }}",
                data: formArray,
                beforeSend: function() {
                    $('#btnSubmitFamily').prop('disabled', true);
                    $('#btnSubmitFamily').addClass('btn-progress');
                },
                success: function(response) {
                    swal({
                        title: "Success!",
                        text: response.message,
                        icon: "success",
                    }).then(() => {
                        $('#btnSubmitFamily').removeClass('btn-progress');
                        $('#btnSubmitFamily').prop('disabled', false);

                        const date = new Date(dataObj['date_of_birth']);
                        const day = String(date.getDate()).padStart(2, '0');
                        const month = date.toLocaleString('default', {
                            month: 'long'
                        });
                        const year = date.getFullYear();

                        $('#headName').html(dataObj['first_name'] + ' ' + dataObj['last_name']);
                        $('#headJob').html(dataObj['job']);
                        $('#first_name').val(dataObj['first_name']);
                        $('#last_name').val(dataObj['last_name']);
                        $('#date_of_birth').val(day + ' ' + month + ' ' + year);
                        $('#job').val(dataObj['job']);
                        $('#address').val(dataObj['address']);
                        $('#number_of_children').val(dataObj['number_of_children']);
                        $('#phone').val(dataObj['phone']);
                        $('#contact_name').html(dataObj['first_name'] + ' ' + dataObj['last_name']);
                        $('#whatsapp').attr('href', 'https://wa.me/+62' + parseInt(dataObj['phone']))
                        $('#newFamily').show();
                        $('#noFamily').hide();
                        $('#addFamily').modal('hide');

                        familyForm.reset();
                    });
                },
                error: function(xhr) {
                    $('#btnSubmitFamily').removeClass('btn-progress');
                    $('#btnSubmitFamily').prop('disabled', false);

                    ResponseHelper.handle(xhr);
                }
            });
        });
    </script>
@endpush
