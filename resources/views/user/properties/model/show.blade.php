<div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header modal-colored-header">
            <h4 class="modal-title" id="primary-header-modalLabel">Property Details</h4>
            <button type="button" class="btn-close" data-dismiss="modal" aria-hidden="true">
                <i class="fa fa-close"></i>
            </button>
        </div>
        <form class="form-horizontal" id="ajax-form" method="POST" enctype="multipart/form-data" data-file="true"
            data-notification="div" action="{{route('property.store')}}" data-reload="true">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">New Delivery Challans</h4>
            </div>
            <div class="modal-body">
                <div id="message-area"></div>
               
                 <div class="form-group row">
                    <div class="col-6">
                        <label class="col">Property Name</label>
                        <div class="col">
                            <input type="text" class="form-control" id="name" class="form-control" name="name">
                        </div>
                    </div>
                    <div class="col-6">
                        <label class="col">Price</label>
                        <div class="col">
                            <input type="text" class="form-control" id="price" class="form-control" name="price">
                        </div>
                    </div>
                   
                </div>
                <div class="form-group row">
                    <div class="col-6">
                        <label class="col">Rooms Count</label>
                        <div class="col">
                            <input type="number" class="form-control" id="room_count" class="form-control" name="room_count">
                        </div>
                    </div>
                    <div class="col-6">
                        <label class="col">Bath Rooms Count</label>
                        <div class="col">
                            <input type="number" class="form-control" id="bath_count" class="form-control" name="bath_count">
                        </div>
                    </div>
                   
                </div>
                <div class="form-group row">
                    <div class="col-6">
                        <label class="col">Address</label>
                        <div class="col">
                            <input type="text" class="form-control" id="address" class="form-control" name="address">
                        </div>
                    </div>
                    <div class="col-6">
                        <label class="col">Address 2</label>
                        <div class="col">
                            <input type="text" class="form-control" id="address2" class="form-control" name="address2">
                        </div>
                    </div>
                   
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-dark" data-loading-text="Please Wait...">Save And Add Images</button>
            </div>
        </form>
    </div>
</div>