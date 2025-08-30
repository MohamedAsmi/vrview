@extends('agent.layouts.app')
@section('content')

    <div class="card-box">
 
        <form class="form-horizontal" method="POST" action="{{route('property.store')}}">
            @csrf
      
            <div class="modal-body">
                <div id="message-area"></div>
             
                <div class="form-group row">
                    <div class="col">
                        <label class="col col col-form-label">Property Name</label>
                        <div class="col col-md-10">
                            <input type="text" class="form-control" name="name" id="name" >
                        </div>
                    </div>
                    <div class="col">
                        <label class="col col col-form-label">Price</label>
                        <div class="col col-md-10">
                            <input type="number" class="form-control" name="price" id="price" >
                        </div>
                    </div>
                   
                </div>
               <div class="form-group row">
                    <div class="col">
                        <label class="col col col-form-label">Rooms</label>
                        <div class="col col-md-10">
                            <input type="number" class="form-control" name="room_count" id="room_count" >
                        </div>
                    </div>
                    <div class="col">
                        <label class="col col col-form-label">Bathrooms</label>
                        <div class="col col-md-10">
                            <input type="number" class="form-control" name="bath_count" id="bath_count" >
                        </div>
                    </div>
                   
                </div>
                <div class="form-group row">
                    <div class="col">
                        <label class="col col col-form-label">Address</label>
                        <div class="col col-md-10">
                            <input type="text" class="form-control" name="address" id="address" >
                        </div>
                    </div>
                    <div class="col">
                        <label class="col col col-form-label">Address 1</label>
                        <div class="col col-md-10">
                            <input type="text" class="form-control" name="address1" id="address1" >
                        </div>
                    </div>
                   
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-dark" data-loading-text="Please Wait...">Save And Add Image</button>
            </div>
        </form>
    </div>

@endsection
