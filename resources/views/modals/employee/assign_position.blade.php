<div class="modal fade" id="assignPosition" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Assign Position to {{ $employee->full_name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formAssignPosition">
                    <div class="form-group">
                        <label>Division</label>
                        <select class="form-control select2" id="division">
                            @foreach ($divisions as $division)
                                <option value="{{ $division->id }}">{{ $division->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Position</label>
                        <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                        <select class="form-control select2" name="position_id" id="position">
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="btnAssignPosition" class="btn btn-primary">Assign</button>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        let text = '';

        $(document).ready(function() {
            const initSelect2Position = (uri) => {
                $("#position").select2({
                    placeholder: 'Position...',
                    // width: '350px',
                    allowClear: true,
                    ajax: {
                        url: uri ??
                            "{{ route('ajax.positions.getPositionByDivision', ['divisionId' => '1']) }}",
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                term: params.term || '',
                                page: params.page || 1
                            }
                        },
                        cache: true
                    }
                }).on('select2:select', function(e) {
                    text = e.params.data.text;
                });
            }

            initSelect2Position();

            $('#division').select2().on('select2:select', function(e) {
                var uri = "{{ route('ajax.positions.getPositionByDivision', ['divisionId' => 'id']) }}";
                uri = uri.replace('id', e.params.data.id);

                initSelect2Position(uri);
            });
        });

        $(".btnAssign").click(function() {
            $('#assignPosition').modal({
                backdrop: 'static',
                keyboard: false
            });
        });

        $("#btnAssignPosition").click(function() {
            var formArray = $('#formAssignPosition :not(.not_included)').serializeArray();
            $.ajax({
                method: 'POST',
                url: "{{ route('ajax.structurals.store') }}",
                data: formArray,
                beforeSend: function() {
                    $('#btnAssignPosition').prop('disabled', true);
                    $('#btnAssignPosition').addClass('btn-progress');
                },
                success: function(response) {
                    swal({
                        title: "Success!",
                        text: response.message,
                        icon: "success",
                    }).then(() => {
                        $('#btnAssignPosition').removeClass('btn-progress');
                        $('#btnAssignPosition').prop('disabled', false);

                        location.reload();
                    });
                },
                error: function(xhr) {
                    $('#btnAssignPosition').removeClass('btn-progress');
                    $('#btnAssignPosition').prop('disabled', false);

                    ResponseHelper.handle(xhr);
                }
            });
        });
    </script>
@endpush
