<div class="modal fade" id="createLeaveCategoryModal" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Title: <span id="title"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formLeaveCategory">
                    <div class="form-group">
                        <label>Category Name<span class="text-danger"></span></label>
                        <input type="text" id="category_name" class="form-control" name="name">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="btnSubmit" class="btn btn-primary">Create</button>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        jQuery(function() {
            //
        })
    </script>
@endpush
