<div class="modal fade" id="modal"></div>

<div class="modal fade p-4" id="delete-modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="anticon anticon-close"></i>
                </button>
            </div>
            <form class="form-horizontal" id="ajax-form" method="DELETE">
                <div class="modal-body">
                    @csrf
                    Are you sure want to delete?
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>

                <button type="submit" class="btn btn-danger" data-loading-text="Deleting...">Delete</button>
                </div>

        </form>
    </div>
</div>
