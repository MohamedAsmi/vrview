<div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header modal-colored-header">
            <h4 class="modal-title" id="primary-header-modalLabel">User Details</h4>
            <button type="button" class="btn-close" data-dismiss="modal" aria-hidden="true">
                <i class="fa fa-close"></i>
            </button>
        </div>
        <form class="form-horizontal" id="ajax-form" method="POST"
              action=""
              data-table="team-table" data-file="true">
            <div class="modal-body">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="row mb-3 client_type">
                            <div class="col-md-12"></div>
                        </div>
                    </div>

                   
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-dark" data-loading-text="Saving...">Save</button>
            </div>
        </form>
    </div>
</div>